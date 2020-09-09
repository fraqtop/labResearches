<template>
  <div>
    {{id}}
  </div>
</template>

<script>
export default {
  name: "Show",
  props: {
    id: {
      required: true,
    },
  },
  data() {
    return {
      research: null
    }
  },
  created() {
    window.axios(`${this.$config.routes.researches}/${this.id}`)
      .then(response => this.research = response.data)
      .catch(error => console.log(error.response))
  }
}
</script>