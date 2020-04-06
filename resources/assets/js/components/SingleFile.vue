<template>
    <div v-if="loading">
        <p class="text-sm text-gray-300 text-center">Loading...</p>
    </div>
    <div v-else>
      <div class="w-40">
        <vue-file-agent
          v-model="fileRecords"
          accept="video/*"
          :compact="true"
          maxSize="1GB"
          :meta="false"
          :multiple="false"
          uploadUrl="/api/filetinmel/youtube"
          @upload="onUpload($event)">
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
  data () {
    return {
      loading: true,
      fileRecords: []
    }
  },
  methods: {
    fetchData () {
      this.loading = false
    },
    onUpload (response) {
      console.log('response', response)
    }
  },
  mounted () {
    console.log('single-file component mounted.')
    this.fetchData()
  }
}
</script>

<style>

.foo {
    @apply text-gray-700;
}
</style>
