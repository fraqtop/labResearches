<template>
  <b-container>
    <b-row>
      <b-col>
        <b-input placeholder="начните вводить код"/>
      </b-col>
    </b-row>
    <div class="mt-3">
      <h4>Список доступных анализов</h4>
      <price-table :items="analyses"/>
    </div>
  </b-container>
</template>

<script>
  import PriceTable from "./partial/PriceTable"

  export default {
    name: "PriceList",
    components: {
      'price-table': PriceTable
    },
    data() {
      return {
        analyses: null
      }
    },
    created() {
      window.axios(this.$config.analyses)
        .then(response => this.analyses = response.data.items)
        .catch(error => console.log(error))
    }
  }
</script>

<style scoped>

</style>