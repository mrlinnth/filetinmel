import Vue from 'vue'

window._ = require('lodash')

window.axios = require('axios')

window.axios.defaults.headers.common.Authorization = 'Bearer mHUeREPpQJXFjZnC3R5mbZhZeUFf9barjbcB7qqyVXVevf3uujz9aTdbQPAK'

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

const token = document.head.querySelector('meta[name="csrf-token"]')

if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token')
}

Vue.component('single-file', require('./components/SingleFile.vue').default)
Vue.component('multiple-files', require('./components/MultipleFiles.vue').default)

new Vue().$mount('#app')
