<template>
  <div>
    <h2>Добавить тип анализа</h2>
    <b-form @submit.prevent="save">
      <b-form-group>
        <b-input v-model="saveData.code" placeholder="Код" required/>
      </b-form-group>
      <b-form-group>
        <b-textarea v-model="saveData.description" placeholder="Описание" required/>
      </b-form-group>
      <b-form-group>
        <b-input type="number" v-model="saveData.price" placeholder="Цена" step="0.01" required/>
      </b-form-group>
      <b-form-group>
        <b-input type="number" v-model="saveData.duration" placeholder="Длительность (дней)" min="1" required/>
      </b-form-group>
      <b-form-group>
        <b-input v-model="saveData.executor" placeholder="Исполнитель"/>
      </b-form-group>
      <b-form-group>
        <b-select
            :options="categories"
            text-field="name"
            value-field="id"
            v-model="saveData.type_id"
            placeholder="Категория"
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
  import save from "../../mixins/save";

  export default {
    name: "Analysis",
    mixins: [save],
    data() {
      return {
        saveLink: this.$config.routes.analyses,
        categories: []
      }
    },
    created() {
      if (this.categories.length) {
        return;
      }
      window.axios(this.$config.routes.analysisTypes)
        .then(response => this.categories = response.data.items)
        .catch(error => this.errorMessage = error.response.data.message)
    }
  }
</script>