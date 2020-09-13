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
    <b-modal v-if="selectedResearch" v-model="isResultsShown" hide-footer>
      <h4>Результаты исследования №{{selectedResearch.id}}</h4>
      <b-row v-for="gene in genes" v-bind:key="gene.id">
        <b-col>
          <p>{{gene.name}}</p>
        </b-col>
        <b-col>
          <b-select
              v-show="!isCompleted"
              v-model="saveData.results[gene.id]"
              text-field="name"
              value-field="id"
              :options="gene.genotypes"
          />
        </b-col>
      </b-row>
      <b-row>
        <b-col>
          <p class="text-danger">{{errorMessage}}</p>
        </b-col>
      </b-row>
      <b-button @click="wrappedSave" variant="success">Сохранить</b-button>
    </b-modal>
  </div>
</template>

<script>
  import displayFields from "./displayFields";
  import holidaysFetchModes from "../calendar/holidaysFetchModes";
  import Pagination from "../Pagination";
  import save from "../../mixins/save";

  export default {
    name: "ResearchesList",
    mixins: [save],
    components: {
      'custom-pagination': Pagination,
    },
    data() {
      return {
        researches: [],
        genes: [],
        saveData: {
          results: {}
        },
        fields: displayFields,
        dateFormat: this.$config.datetimeFormat,
        page: {
          isLast: true,
          number: 1
        },
        selectedResearch: null,
        isResultsShown: false
      }
    },
    computed: {
      colouredResearches: function() {
        return this.researches.map((research) => {
          return Object.assign({_rowVariant: this.getFillVariant(research)}, research);
        })
      },
      saveLink: function () {
        return `${this.$config.routes.researches}/${this.selectedResearch}/results`
      },
      isCompleted: function () {
        return this.selectedResearch && this.selectedResearch.issuedAt
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
        this.selectedResearch = research;
        if (this.isCompleted) {
          this.print();
        } else {
          window.axios(`${this.$config.routes.genes}?filters[analysis_id]=${research.analysis.id}`)
              .then(response => {
                this.genes = response.data.items
                this.isResultsShown = true;
              })
              .catch(error => console.log(error.response))
        }
      },
      wrappedSave() {
        if (this.isValid()) {
          this.save();
        }
      },
      isValid() {
        this.errorMessage = null;
        for (let gene of this.genes) {
          if (Object.keys(this.saveData.results).indexOf(String(gene.id)) === -1) {
            this.errorMessage = `Для гена ${gene.name} не выбран генотип`;
            return false
          }
        }
        return true
      },
      print() {
        window.axios(`${this.$config.routes.researches}/${this.selectedResearch.id}/print`)
          .then(response => {
            window.location = 'data:application/vnd.openxmlformats-officedocument.wordprocessingml.document;base64,' + response.data.url;
          })
          .catch(error => console.log(error.response));
      }
    }
  }
</script>

<style scoped>
.table-clickable {
  cursor: pointer;
}
</style>