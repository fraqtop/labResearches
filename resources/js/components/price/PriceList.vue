<template>
  <b-container>
    <div class="mt-3">
      <h4>Список доступных анализов</h4>
      <price-table
        :items="analyses"
        v-on:filtersChanged="loadAnalyses"
      />
    </div>
    <b-row class="centered">
      <b-col class="w-50 p-0" style="max-width: 50%">
        <custom-pagination v-show="!isLastPage" @click.native="loadAnalyses"/>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
  import PriceTable from "./PriceTable"
  import Pagination from "../Pagination"

  export default {
    name: "PriceList",
    components: {
      'custom-pagination': Pagination,
      'price-table': PriceTable
    },
    data() {
      return {
        analyses: null,
        filters: '',
        pageNumber: 1,
        isLastPage: true
      }
    },
    created() {
      this.loadAnalyses()
    },
    methods: {
      loadAnalyses(payload) {
        if (payload && payload.query !== undefined) {
          this.filters = payload.query
          this.pageNumber = 1
        }
        axios(`${this.$config.routes.analyses}?page=${this.pageNumber}${this.filters}`)
          .then(response => {
            this.analyses = this.pageNumber === 1 ? response.data.items: this.analyses.concat(response.data.items)
            this.pageNumber += 1
            this.isLastPage = response.data.links.next === null
          })
          .catch(error => console.log(error))
      },
    }
  }
</script>

<style scoped>

</style>