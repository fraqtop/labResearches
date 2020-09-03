<template>
  <b-container>
    <b-row>
      <month
          v-for="month in months"
          v-bind:key="month"
          :number="month"
          :holidays="holidays[month]"
          class="col-4 mb-1"
      />
    </b-row>
  </b-container>
</template>

<script>
import Month from "./Month";
import InsertHoliday from "../insert/Holiday";

export default {
  name: "CalendarIndex",
  components: {InsertHoliday, Month},
  data() {
    return {
      months: [...Array(12).keys()],
      holidays: {},
      selectedDay: {},
      isFormVisible: false
    }
  },
  created() {
    window.axios(this.$config.routes.holidays)
      .then(response => this.holidays = response.data)
  }
}
</script>