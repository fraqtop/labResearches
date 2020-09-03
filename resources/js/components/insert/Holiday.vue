<template>
  <b-modal v-model="isVisible" hide-footer>
    <h3 class="text-muted">Добавить выходной день</h3>
    <b-row class="w-50 mb-2">
      <b-col>
        Месяц:
      </b-col>
      <b-col>
        {{monthLabel}}
      </b-col>
    </b-row>
    <b-row class="w-50 mb-2">
      <b-col>
        День:
      </b-col>
      <b-col>
        {{saveData.day}}
      </b-col>
    </b-row>
    <b-form @submit.prevent="save">
      <b-form-group>
        <b-form-checkbox
          v-model="saveData.year"
          :value="null"
          :unchecked-value="new Date().getFullYear()"
        >
          Каждый год
        </b-form-checkbox>
      </b-form-group>
      <b-row v-show="errorMessage">
        <b-col>
          <p class="text-danger">{{errorMessage}}</p>
        </b-col>
      </b-row>
      <b-button variant="success" type="submit">Добавить</b-button>
    </b-form>
  </b-modal>
</template>

<script>
import save from "../../mixins/save";

export default {
  name: "InsertHoliday",
  mixins: [save],
  props: {
    value: {
      required: false,
      type: Boolean
    },
    day: {
      required: false,
      type: Number
    },
    month: {
      required: false,
      type: Number
    }
  },
  watch: {
    value: function () {
      let date = new Date();
      date.setMonth(this.month);
      this.monthLabel = date.toLocaleString('ru', {month: 'long'});
      this.saveData = {
        day: this.day,
        month: this.month
      };
      this.isVisible = this.value
    },
    isVisible: function (value) {
      this.$emit('input', value)
    }
  },
  data() {
    return {
      saveData: {},
      monthLabel: '',
      isVisible: false,
      saveLink: this.$config.routes.holidays
    }
  },
}
</script>
