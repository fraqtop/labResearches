<template>
  <b-container>
    <b-row>
      <b-col class="border-bottom mb-3">
        <h1>Данные исследования</h1>
      </b-col>
    </b-row>
      <b-row>
        <b-col>
          <b-form-group>
            <date-picker
                :only-date="true"
                :no-button-now="true"
                :format="$config.datetimeFormat"
                locale="ru"
                v-model="research.issuedAt"
                label="Дата поступления"
            />
          </b-form-group>
          <b-form-group>
            <date-picker
                :only-date="true"
                :no-button-now="true"
                :format="$config.datetimeFormat"
                locale="ru"
                v-model="research.materialTakenAt"
                label="Дата взятия образца"
            />
          </b-form-group>
          <b-form-group>
            <live-search
                placeholder="Пациент"
                link="patients"
                v-on:chosen="setEntity"
            />
          </b-form-group>
          <b-form-group>
            <live-search
                placeholder="Тип материала"
                link="materials"
                v-on:chosen="setEntity"
            />
          </b-form-group>
          <b-form-group>
            <live-search
                placeholder="Тип оплаты"
                link="pay-types"
                v-on:chosen="setEntity"
            />
          </b-form-group>
        </b-col>
        <b-col>
          <b-form-group>
            <live-search
                placeholder="Исследование"
                link="analyses"
                v-on:chosen="setEntity"
                search-field="code"
            />
          </b-form-group>
          <b-form-group>
            <live-search
                placeholder="Направвившее подразделение"
                link="institutions"
                v-on:chosen="setEntity"
            />
          </b-form-group>
          <b-form-group>
            <live-search
                placeholder="Подразделение исполнитель"
                link="institutions"
                v-on:chosen="setEntity"
            />
          </b-form-group>
          <b-form-group>
            <live-search
                placeholder="Врач"
                link="users"
                v-on:chosen="setEntity"
            />
          </b-form-group>
          <b-form-group>
            <b-input placeholder="Внутренний номер"/>
          </b-form-group>
        </b-col>
      </b-row>
      <b-row class="m-3">
        <b-col class="centered">
          <b-button variant="success">Сохранить</b-button>
          <p v-show="error" class="text-danger">{{error}}</p>
        </b-col>
      </b-row>
    <b-jumbotron v-show="research.issuePlannedAt">
      Планируемая дата выдачи результатов исследования {{research.issuePlannedAt}}
    </b-jumbotron>
  </b-container>
</template>

<script>
  import LiveSearch from "../LiveSearch";
  import DatePicker from "vue-ctk-date-time-picker"


  export default {
    name: "New",
    components: {LiveSearch, DatePicker},
    data() {
      return {
        research: {
          innerNumber: null,
          patientId: null,
          initiatorId: null,
          userId: null,
          materialId: null,
          analysisId: null,
          payTypeId: null,
          issuePlannedAt: null,
          comment: null,
          issuedAt: null,
          materialTakenAt: null
        },
        error: null
      }
    },
    methods: {
      setEntity(entity) {
        console.log(entity)
      }
    }
  }
</script>

<style scoped>

</style>