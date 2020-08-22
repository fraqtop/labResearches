<template>
  <div class="fade-in mx-5">
    <b-table :items="researches" :fields="fields"/>
  </div>
</template>

<script>
  import displayFields from "./displayFields";

  export default {
    name: "ResearchesList",
    data() {
      return {
        researches: [],
        fields: displayFields
      }
    },
    created() {
      window.axios(this.$config.routes.researches)
        .then(response => this.researches = response.data.items)
        .catch(error => console.log(error.response))
    }
  }
</script>