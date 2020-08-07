<template>
  <date-picker
      :only-date="true"
      :no-button-now="true"
      :format="$config.datetimeFormat"
      :label="this.placeholder"
      v-model="date"
      locale="ru"
  />
</template>

<script>
  import DatePicker from 'vue-ctk-date-time-picker'

  export default {
    name: "CustomDatePicker",
    components: {DatePicker},
    props: {
      placeholder: {
        required: false,
        default: 'Выберите дату'
      }
    },
    data() {
      return {
        date: null
      }
    },
    watch: {
      date: function (value) {
        this.$emit('input', value)
      }
    }
  }
</script>
