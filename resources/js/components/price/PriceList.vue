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
        <custom-pagination :meta="meta" @click.native="loadAnalyses"/>
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
        meta: {}
      }
    },
    created() {
      this.loadAnalyses()
    },
    computed: {
      pageToLoad() {
        return this.meta.currentPage ? this.meta.currentPage + 1 : 1;
      }
    },
    methods: {
      loadAnalyses(payload) {
        if (payload && payload.query !== undefined) {
          this.filters = payload.query
          this.meta = {}
        }
        axios(`${this.$config.routes.analyses}?page=${this.pageToLoad}${this.filters}`)
          .then(response => {
            this.meta = response.data.meta;
            this.analyses = this.meta.currentPage === 1 ? response.data.items: this.analyses.concat(response.data.items)
          })
          .catch(error => console.log(error))
      },
    }
  }
</script>

<style scoped>

</style>