<template>
    <div v-if="loading">
        <p class="text-sm text-gray-300 text-center">Loading...</p>
    </div>
    <div v-else>
      <div class="w-40">
        <vue-file-agent
          ref="vueFileAgent"
          v-model="fileRecords"
          accept="video/*"
          :compact="true"
          maxSize="1GB"
          :meta="false"
          :multiple="false"
          @select="filesSelected($event)">
        </vue-file-agent>
      </div>
    </div>
</template>

<script>
import VueFileAgentPlugin from 'vue-file-agent'
import VueFileAgentStyles from 'vue-file-agent/dist/vue-file-agent.css'

export default {
  components: {
    'vue-file-agent': VueFileAgentPlugin.VueFileAgent
  },
  props: {
    title: String
  },
  data () {
    return {
      loading: true,
      fileRecords: [],
      uploadUrl: '/api/filetinmel/youtube',
      fileRecordsForUpload: []
    }
  },
  methods: {
    fetchData () {
      this.loading = false
    },
    filesSelected (fileRecordsNewlySelected) {
      const validFileRecords = fileRecordsNewlySelected.filter((fileRecord) => !fileRecord.error)
      this.fileRecordsForUpload = this.fileRecordsForUpload.concat(validFileRecords)

      this.uploadFiles()
    },
    async uploadFiles () {
      try {
      // axios upload
        const fileForUpload = this.fileRecordsForUpload[this.fileRecordsForUpload.length - 1]
        const formData = new FormData()
        formData.append('file', fileForUpload.file)
        formData.append('title', this.title)

        const filesResponse = await axios.post(this.uploadUrl, formData)
        const yt_id = filesResponse.data

        // use the uploaded youtube video ID as you wish here
        this.fileRecordsForUpload = []
      } catch (e) {
        console.error('error', e)
      }
    }
  },
  mounted () {
    console.log('ftm-test component mounted.')
    this.fetchData()
  }
}
</script>

<style>

.foo {
    @apply text-gray-700;
}
</style>
