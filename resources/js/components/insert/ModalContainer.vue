<template>
  <div>
    <b-button
        @click="isVisible = true"
        variant="info"
        class="font-weight-bold text-white"
    >
      {{ buttonContent }}
    </b-button>
    <b-modal v-model="isVisible" ref="insert-modal" size="xl" hide-footer>
      <component
          v-on:saved="isVisible = false"
          v-on="$listeners"
          :is="formType"
      />
    </b-modal>
  </div>
</template>

<script>
  import Patient from "./Patient";
  import PayType from "./PayType";
  import Analysis from "./Analysis";
  import Material from "./Material";
  import Institution from "./Institution";

  export default {
    name: "Modal",
    components: {
      'insert-patients': Patient,
      'insert-pay-types': PayType,
      'insert-analyses': Analysis,
      'insert-materials': Material,
      'insert-institutions': Institution,
    },
    props: {
      entityType: {
        required: true,
        type: String
      },
      buttonContent: {
        required: false,
        type: String,
        default: '+'
      }
    },
    computed: {
      formType: function () {
        return `insert-${this.entityType}`
      }
    },
    data() {
      return {
        isVisible: false
      }
    }
  }
</script>
