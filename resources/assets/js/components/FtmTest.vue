<template>
    <div v-if="loading">
        <p class="text-sm text-gray-300 text-center">Loading...</p>
    </div>
    <div v-else>
        <p class="foo mt-10">hello from test component</p>

        <vue-file-agent :uploadUrl="uploadUrl" v-model="fileRecords"></vue-file-agent>
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
      uploadUrl: '/api/filetinmel/s3'
    }
  },
  methods: {
    fetchData () {
      this.loading = false
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
