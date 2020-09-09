<template>
  <div class="fade-in mx-5">
    <b-table
        :items="colouredResearches"
        :fields="fields"
        :tbody-tr-class="getTextClass"
        class="table-clickable"
        @row-clicked="rowClickHandler"
    />
    <custom-pagination v-show="!page.isLast"/>
  </div>
</template>

<script>
  import displayFields from "./displayFields";
  import holidaysFetchModes from "../calendar/holidaysFetchModes";
  import Pagination from "../Pagination";

  export default {
    name: "ResearchesList",
    components: {
      'custom-pagination': Pagination
    },
    data() {
      return {
        researches: [],
        fields: displayFields,
        dateFormat: this.$config.datetimeFormat,
        page: {
          isLast: true,
          number: 1
        }
      }
    },
    computed: {
      colouredResearches: function() {
        return this.researches.map((research) => {
          return Object.assign({_rowVariant: this.getFillVariant(research)}, research);
        })
      }
    },
    created() {
      this.init();
    },
    methods: {
      async init() {
        let response = await window.axios(`${this.$config.routes.holidays}?filters[mode]=${holidaysFetchModes.flat}`);
        this.$moment.updateLocale('ru', {
          holidays: response.data,
          holidayFormat: 'MM-DD-YYYY'
        });
        window.axios(this.$config.routes.researches)
          .then(response => this.researches = response.data.items)
          .catch(error => console.log(error.response));
      },
      getFillVariant(research) {
        let result = '';
        if (this.$moment(research.issuePlanedAt, this.dateFormat).businessDiff(this.$moment(), true) < 2) {
          result = 'danger';
        }
        if (research.issuedAt) {
          result = 'success';
        }
        return result;
      },
      getTextClass(research) {
        if (!research.issuedAt) {
          return '';
        }
        return this.$moment(research.issuedAt, this.dateFormat)
            .isBefore(this.$moment(research.issuePlanedAt, this.dateFormat)) ? '' : 'text-danger';
      },
      rowClickHandler(research) {
        console.log(research.id)
        this.$router.push({name: 'ResearchShow', params: {id: research.id}});
      }
    }
  }
</script>

<style scoped>
.table-clickable {
  cursor: pointer;
}
</style>