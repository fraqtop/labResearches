<template>
  <component v-bind:is="`${layoutType}-layout`"/>
</template>

<script>
  import RegularLayout from "./layouts/RegularLayout";
  import EmptyLayout from "./layouts/EmptyLayout";

  export default {
    name: "App",
    components: {
      RegularLayout,
      EmptyLayout
    },
    computed: {
      layoutType: function () {
        return this.$route.meta.layout || 'regular'
      }
    },
    created() {
      this.checkRequiredHeaders()
      window.axios.interceptors.response.use(null, (error) => {
        if (error.response.status === 401) {
          this.$router.push({name: 'Login'})
        } else {
          return Promise.reject(error)
        }
      })
    },
    methods: {
      checkRequiredHeaders() {
        let commonHeaders = window.axios.defaults.headers.common;
        if (!commonHeaders['X-XSRF-TOKEN']) {
          window.axios.get(this.$config.csrf)
            .then(response => commonHeaders['X-XSRF-TOKEN'] = response.config.headers['X-XSRF-TOKEN'])
        }
        if (!commonHeaders['Authorization'] && this.$route.path !== '/login') {
          if (this.$store.getters.isLoggedIn) {
            commonHeaders['Authorization'] = this.$store.getters.authHeader
          } else {
            this.$router.push({name: 'Login'})
          }
        }
      }
    }
  }
</script>