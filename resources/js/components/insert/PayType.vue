<template>
  <div>
    <h2>Добавить тип оплаты</h2>
    <b-form @submit.prevent="save">
      <b-form-group>
        <b-input v-model="saveData.name" placeholder="Название" required/>
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
  import save from "../../mixins/save";

  export default {
    name: "PayType",
    mixins: [save],
    data() {
      return {
        saveLink: this.$config.routes.payTypes
      }
    }
  }
</script>