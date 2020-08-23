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

export default {
  name: "CalendarIndex",
  components: {Month},
  data() {
    return {
      months: [...Array(12).keys()],
      holidays: {}
    }
  },
}
</script>