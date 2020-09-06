<template>
  <div class="fade-in">
    <h2>Исследуемые гены</h2>
      <b-row
          align-v="center"
          class="my-2 border-bottom p-2"
          v-for="gene in genes" v-bind:key="gene.id"
      >
        <b-col>{{gene.name}}</b-col>
        <b-col>{{gene.coords}}</b-col>
        <b-col>{{gene.description}}</b-col>
        <b-col>
          <b-button @click="removeGene(gene)" variant="danger">Удалить</b-button>
        </b-col>
      </b-row>
    <b-row v-show="!genes.length">
      <b-col>
        <p class="text-danger">
          Вы ещё не добавили ни одного гена к текущему анализу
        </p>
      </b-col>
    </b-row>
    <b-row>
      <b-col>
        <h4>Добавить исследуемый ген</h4>
      </b-col>
    </b-row>
    <b-form-group>
      <b-input v-model="saveData.name" placeholder="Имя"/>
    </b-form-group>
    <b-form-group>
      <b-input v-model="saveData.coords" placeholder="Координаты"/>
    </b-form-group>
    <b-form-group>
      <b-textarea v-model="saveData.description" placeholder="Описание"/>
    </b-form-group>
    <b-form-group>
      <b-row>
        <b-col v-for="status in genotypeStatuses" v-bind:key="status.id">
          <insert-genotype v-model="saveData.genotypes[status.id]" :status="status"/>
        </b-col>
      </b-row>
      <b-row>
        <b-col>
          <p class="text-danger">{{errorMessage}}</p>
        </b-col>
      </b-row>
      <b-button
          @click="addGene"
          variant="info"
      >
        Добавить ген
      </b-button>
      <b-button
        @click="complete"
        class="ml-2"
        variant="success"
      >
        Сохранить
      </b-button>
    </b-form-group>
  </div>
</template>

<script>
import save from "../../mixins/save";
import Genotype from "./Genotype";

export default {
  name: "Gene",
  components: {
    'insert-genotype': Genotype
  },
  mixins: [save],
  props: {
    analysisId: {
      required: false,
      default: null
    }
  },
  data() {
    return {
      genes: [],
      saveLink: this.$config.routes.genes,
      saveData: {
        genotypes: {}
      },
      genotypeStatuses: []
    }
  },
  watch: {
    analysisId: function (newValue) {
      this.genes.map((item) => {
        item.analysisId = newValue
      })
    }
  },
  created() {
    if (this.analysisId) {
      this.getGenes();
    }
    if (!this.genotypeStatuses.length) {
      window.axios(this.$config.routes.genotypeStatuses)
        .then(response => {
          this.genotypeStatuses = response.data.items;
        });
    }
  },
  methods: {
    getGenes() {
      window.axios(`${this.$config.routes.genes}?filters[analysis_id]=${this.analysisId}`)
        .then(response => this.genes = this.genes.concat(response.data.items))
        .catch(error => console.log(error.response.data.message))
    },
    addGene() {
      if (!this.isValid()) {
        return;
      }
      this.syncSave()
        .then(response => {
          this.genes.push(response.data);
          this.saveData = {
            genotypes: {}
          }
        })
    },
    removeGene(gene) {
      window.axios.delete(`${this.$config.routes.genes}/${gene.id}`)
        .then(() => {
          this.genes = this.genes.filter((item) => {
            return item !== gene;
          })
        })
    },
    isValid() {
      this.errorMessage = null;
      if (!this.saveData.name) {
        this.errorMessage = 'Не указано обозначение гена';
      }
      if (this.genotypeStatuses.length !== Object.keys(this.saveData.genotypes).length) {
        this.errorMessage = 'Генотипы не заполнены';
      }
      return this.errorMessage === null;
    },
    complete() {
      if (!this.genes.length) {
        this.errorMessage = 'Нельзя добавить исследование без исследуемых генов';
        return;
      }
      this.$emit('saved', {genes: this.genes.map(gene => gene.id)})
    }
  }
}
</script>
