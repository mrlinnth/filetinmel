<template>
    <div v-if="loading">
        <p class="text-sm text-gray-300 text-center">Loading...</p>
    </div>
    <div v-else>
        <p class="foo">Hello World</p>
    </div>
</template>

<script>
export default {
  data () {
    return {
      loading: true
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
