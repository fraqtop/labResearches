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
                v-model="research.registeredAt"
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
                v-model="research.materialId"
                placeholder="Тип материала"
                link="materials"
            />
          </b-form-group>
          <b-form-group>
            <live-search
                v-model="research.payTypeId"
                placeholder="Способ оплаты"
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
                placeholder="Направившее подразделение"
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
                :is-addable="false"
                placeholder="Ответственный"
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
      <b-row>
        <b-col class="text-center">
          <p v-show="error" class="text-danger">{{error}}</p>
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
  import requiredFields from "./requiredFields";

  export default {
    name: "New",
    components: {CustomDatePicker, LiveSearch},
    data() {
      return {
        research: {},
        analysis: null,
        error: null,
        description: null,
        requiredFields: requiredFields
      }
    },
    computed: {
      dateStart: (vm) => vm.research.materialTakenAt,
    },
    watch: {
      analysis: function () {
        this.research.analysisId = this.analysis.id;
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
        if (!this.validate()) {
          return ;
        }
        window.axios.post(this.$config.routes.researches, this.research)
          .then(() => this.$router.push({name: 'ResearchesList'}))
          .catch(error => console.log(error.response))
      },
      validate() {
        this.error = null;
        for (let field of this.requiredFields) {
          if (!this.research[field.key]) {
            this.error = `Не заполнено обязательное поле "${field.label}"`
          }
        }
        let dates = [
          this.$moment(this.research.registeredAt, this.$config.datetimeFormat),
          this.$moment(this.research.materialTakenAt, this.$config.datetimeFormat),
        ]
        if (dates[1].isBefore(dates[0])) {
          this.error = 'Материал не может быть взят раньше даты поступления'
        }
        return this.error === null;
      }
    }
  }
</script>
