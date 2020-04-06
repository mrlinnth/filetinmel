<template>
    <div v-if="loading">
        <p class="text-sm text-gray-300 text-center">Loading...</p>
    </div>
    <div v-else>
        <vue-file-agent
          v-model="fileRecords"
          accept="image/*,video/*,.pdf,.doc,.docx"
          :linkable="true"
          maxSize="10MB"
          :meta="false"
          uploadUrl="/api/filetinmel/s3"
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
      fileRecords: []
    }
  },
  methods: {
    fetchData () {
      this.loading = false
      axios.get('/api/filetinmel/files')
        .then((response) => {
          this.loading = false
          this.fileRecords = response.data
        })
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
