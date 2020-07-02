<template>
  <regular-layout/>
</template>

<script>
  import RegularLayout from "./Layouts/RegularLayout";

  export default {
    name: "App",
    components: {
      RegularLayout
    },
    created() {
      this.checkRequiredHeaders()
      window.axios.interceptors.response.use(undefined, (error) => {
        if (error.response.status === 401) {
          this.$router.push({name: 'Login'})
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
        if (!commonHeaders['Authorization']) {
          this.$router.push({name: 'Login'})
        }
      }
    }
  }
</script>