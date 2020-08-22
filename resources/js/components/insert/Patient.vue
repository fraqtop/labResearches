<template>
  <div>
    <h2>Добавить пациента</h2>
    <b-form @submit.prevent="save">
      <b-form-group>
        <b-input v-model="saveData.name" placeholder="Имя" required/>
      </b-form-group>
      <b-form-group>
        <b-input type="email" v-model="saveData.mail" placeholder="Почта"/>
      </b-form-group>
      <b-form-group>
        <b-input type="number" v-model="saveData.phone" placeholder="Телефон"/>
      </b-form-group>
      <b-form-group>
        <custom-date-picker
            v-model="saveData.birthDate"
            placeholder="Дата рождения"
        />
      </b-form-group>
      <b-form-group>
        <b-button type="submit" variant="info">Сохранить</b-button>
      </b-form-group>
      <b-row>
        <b-col>
          <p v-show="errorMessage" class="text-danger">{{errorMessage}}</p>
        </b-col>
      </b-row>
    </b-form>
  </div>
</template>

<script>
  import save from "../../mixins/save"
  import CustomDatePicker from "../CustomDatePicker";

  export default {
    name: "Patient",
    components: {CustomDatePicker},
    mixins: [save],
    data() {
      return {
        saveLink: this.$config.routes.patients
      }
    },
  }
</script>
