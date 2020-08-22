<template>
  <b-container class="fade-in">
    <b-row>
      <b-col class="border-bottom mb-3">
        <h1>Данные исследования</h1>
      </b-col>
    </b-row>
      <b-row>
        <b-col>
          <b-form-group>
            <custom-date-picker
                v-model="research.issuedAt"
                placeholder="Дата поступления"
            />
          </b-form-group>
          <b-form-group>
            <custom-date-picker
                v-model="research.materialTakenAt"
                placeholder="Дата взятия образца"
            />
          </b-form-group>
          <b-form-group>
            <live-search
                v-model="research.patientId"
                placeholder="Пациент"
                link="patients"
            />
          </b-form-group>
          <b-form-group>
            <live-search
                v-model="research.materialTypeId"
                placeholder="Тип материала"
                link="materials"
            />
          </b-form-group>
          <b-form-group>
            <live-search
                v-model="research.payTypeId"
                placeholder="Тип оплаты"
                link="pay-types"
            />
          </b-form-group>
        </b-col>
        <b-col>
          <b-form-group>
            <live-search
                v-model="analysis"
                :is-needs-details="true"
                placeholder="Исследование"
                link="analyses"
                search-field="code"
            />
          </b-form-group>
          <b-form-group>
            <live-search
                v-model="research.initiatorId"
                placeholder="Направвившее подразделение"
                link="institutions"
            />
          </b-form-group>
          <b-form-group>
            <live-search
                v-model="research.executorId"
                placeholder="Подразделение исполнитель"
                link="institutions"
            />
          </b-form-group>
          <b-form-group>
            <live-search
                v-model="research.userId"
                placeholder="Врач"
                link="users"
            />
          </b-form-group>
          <b-form-group>
            <b-input
                v-model="research.innerNumber"
                placeholder="Внутренний номер"
            />
          </b-form-group>
        </b-col>
      </b-row>
      <b-row class="m-3">
        <b-col class="centered">
          <b-button
              @click="save"
              variant="success"
          >
            Сохранить
          </b-button>
          <p v-show="error" class="text-danger">{{error}}</p>
        </b-col>
      </b-row>
    <b-jumbotron v-show="description">
      {{description}}
    </b-jumbotron>
  </b-container>
</template>

<script>
  import LiveSearch from "../LiveSearch";
  import CustomDatePicker from "../CustomDatePicker";

  export default {
    name: "New",
    components: {CustomDatePicker, LiveSearch},
    data() {
      return {
        research: {},
        analysis: null,
        error: null,
        description: null
      }
    },
    computed: {
      dateStart: (vm) => vm.research.materialTakenAt,
    },
    watch: {
      analysis: function () {
        this.getPlanDate(this.analysis.duration);
      },
      dateStart: function () {
        if (this.analysis) {
          this.getPlanDate(this.analysis.duration);
        }
      }
    },
    methods: {
      getPlanDate(daysNumber) {
        let date = this.research.materialTakenAt ?
            this.$moment(this.research.materialTakenAt, this.$config.datetimeFormat) :
            this.$moment();
        this.research.issuePlanedAt = date
            .businessAdd(daysNumber)
            .format(this.$config.datetimeFormat);
        this.description = this.setDescription();
      },
      setDescription() {
        return `Исследование ${this.analysis.description}. Планируемая дата выдачи ${this.research.issuePlanedAt}`
      },
      save() {
        if (this.analysis) {
          this.research.analysisId = this.analysis.id;
        }
        window.axios.post(this.$config.routes.researches, this.research)
          .then(response => {console.log('saved')})
          .catch(error => console.log(error.response))
      },
    }
  }
</script>
