<template>
    <div v-if="loading">
        <p class="text-sm text-gray-300 text-center">Loading...</p>
    </div>
    <div v-else>
        <vue-file-agent
        ref="vueFileAgent"
        v-model="fileRecords"
        accept="image/*,.pdf,.doc,.docx"
        :linkable="true"
        maxSize="10MB"
        :meta="false"
        @select="filesSelected($event)" />
    </div>
</template>

<script>
import VueFileAgentPlugin from 'vue-file-agent'
import VueFileAgentStyles from 'vue-file-agent/dist/vue-file-agent.css'

export default {
  components: {
    'vue-file-agent': VueFileAgentPlugin.VueFileAgent
  },
  data () {
    return {
      loading: true,
      fileRecords: [],
      uploadUrl: '/api/filetinmel/upload',
      fileRecordsForUpload: [],
      payload: {
        paths: [
          'dummy.txt',
          'dummy.png'
        ]
      },
      uploadHeader: {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
    }
  },
  mounted () {
    this.fetchData()
  },
  methods: {
    async fetchData () {
      this.loading = false
      try {
        /*
        * use the dummy data() or get api data for all the paths for fileRecords
        */
        // const pathsResponse = await axios.get('/api/filetinmel/temp')
        // this.payload.paths = pathsResponse.data

        const filesResponse = await axios.post('/api/filetinmel/files', this.payload)
        this.fileRecords = filesResponse.data
        this.loading = false
      } catch (e) {
        console.error('error', e)
      }
    },
    filesSelected (fileRecordsNewlySelected) {
      const validFileRecords = fileRecordsNewlySelected.filter((fileRecord) => !fileRecord.error)
      this.fileRecordsForUpload = this.fileRecordsForUpload.concat(validFileRecords)

      this.uploadFiles()
    },
    async uploadFiles () {
      try {
        // axios upload
        const filesForUpload = this.fileRecordsForUpload
        const formData = new FormData()
        for (var i = 0; i < filesForUpload.length; i++) {
          const file = filesForUpload[i].file

          formData.append('files[' + i + ']', file)
        }

        const filesResponse = await axios.post(this.uploadUrl, formData, this.uploadHeader)
        this.processFiles(filesResponse.data)

        this.fileRecordsForUpload = []
      } catch (e) {
        console.error('error', e)
      }
    },
    processFiles (files) {
      // do something with return uploaded files data
      console.log(files)
    }
  }
}
</script>

<style>

.foo {
    @apply text-gray-700;
}
</style>
