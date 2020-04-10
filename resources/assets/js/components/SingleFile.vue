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
            @select="filesSelected($event)" />
        </div>
        <p v-if="uploading">Uploading in progress. Do not close this browser tab.</p>
        <p v-if="youtube_id">Youtube URL : https://youtube.com/watch?v={{youtube_id}}</p>
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
      fileRecordsForUpload: [],
      uploading: false,
      youtube_id: null
    }
  },
  mounted () {
    this.fetchData()
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
        this.uploading = true
        // axios upload
        const fileForUpload = this.fileRecordsForUpload[this.fileRecordsForUpload.length - 1]
        const formData = new FormData()
        formData.append('file', fileForUpload.file)
        formData.append('title', this.title)

        const uploadResponse = await axios.post(this.uploadUrl, formData)
        this.afterUpload(uploadResponse.data)
        this.uploading = false

        this.fileRecordsForUpload = []
      } catch (e) {
        console.error('error', e)
      }
    },
    afterUpload (data) {
      // do something with return uploaded files data
      this.youtube_id = data
    }
  }
}
</script>

<style>

.foo {
    @apply text-gray-700;
}
</style>
