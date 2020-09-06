<template>
  <div>
    <div v-show="state === states.analysisForm">
      <h2>Добавить тип анализа</h2>
      <b-form @submit.prevent="state = states.genesForm">
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
          <b-button type="submit" variant="info">Продолжить</b-button>
        </b-form-group>
        <b-row>
          <b-col>
            <p v-show="errorMessage" class="text-danger">{{errorMessage}}</p>
          </b-col>
        </b-row>
      </b-form>
    </div>
    <div v-show="state === states.genesForm">
      <gene-manager v-on:saved="saveAll" :analysis-id="id"/>
    </div>
  </div>
</template>

<script>
  import save from "../../mixins/save";
  import Gene from "./Gene";

  export default {
    name: "Analysis",
    components: {
      'gene-manager': Gene
    },
    mixins: [save],
    data() {
      return {
        saveLink: this.$config.routes.analyses,
        categories: [],
        id: null,
        states: {
          genesForm: 2,
          analysisForm: 1
        },
        state: 1
      }
    },
    watch: {
      responseData: function (data) {
        this.id = data.id;
      }
    },
    created() {
      if (this.categories.length) {
        return;
      }
      window.axios(this.$config.routes.analysisTypes)
        .then(response => this.categories = response.data.items)
        .catch(error => this.errorMessage = error.response.data.message)
    },
    methods: {
      saveAll(payload) {
        this.saveData.genes = payload.genes;
        this.save();
      }
    }
  }
</script>