<template>
  <div>
    <h5>{{status.name}}</h5>
    <b-form-group>
      <b-input @keyup="$emit('input', genotype)" v-model="genotype.name" placeholder="Обозначение"/>
    </b-form-group>
    <b-form-group>
      <b-textarea @keyup="$emit('input', genotype)" v-model="genotype.description" placeholder="Описание"/>
    </b-form-group>
  </div>
</template>

<script>
export default {
  name: "Genotype",
  props: {
    status: {
      required: true,
      type: Object
    },
    value: {
      required: false,
      type: Object
    }
  },
  watch: {
    value: function (newValue) {
      this.genotype = Object.assign({genotypeStatusId: this.status.id}, newValue);
    }
  },
  data() {
    return {
      genotype: {
        genotypeStatusId: this.status.id
      },
    }
  },
}
</script>