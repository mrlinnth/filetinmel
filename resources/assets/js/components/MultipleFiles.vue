<template>
    <div v-if="loading">
        <p class="text-sm text-gray-300 text-center">Loading...</p>
    </div>
    <div v-else>
        <vue-file-agent
          v-model="fileRecords"
          accept="image/*,.pdf,.doc,.docx"
          :linkable="true"
          maxSize="10MB"
          :meta="false"
          uploadUrl="/api/filetinmel/upload"
          @upload="onUpload($event)">
        </vue-file-agent>
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
      payload: {
        paths: [
          'dummy.txt',
          'dummy.png'
        ]
      }
    }
  },
  methods: {
    async fetchData () {
      this.loading = false
      try {
        /*
        * use the dummy data() or get api data for all the paths for fileRecords
        *
        const pathsResponse = await axios.get('/api/filetinmel/temp')
        this.payload.paths = pathsResponse.data
        */

        const filesResponse = await axios.post('/api/filetinmel/files', this.payload)
        this.fileRecords = filesResponse.data
        this.loading = false
      } catch (e) {
        console.error('error', e)
      }
    },
    onUpload (response) {
      console.log('response', response)
    }
  },
  mounted () {
    console.log('multiple-files component mounted.')
    this.fetchData()
  }
}
</script>

<style>

.foo {
    @apply text-gray-700;
}
</style>
