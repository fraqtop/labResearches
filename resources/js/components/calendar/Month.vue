<template>
  <div>
    <h4>{{label}}</h4>
    <div class="month">
      <div
          v-for="day in grid"
          v-bind:class="{'bg-info': isHoliday(day)}"
          class="border text-center clickable calendar-cell"
      >
        {{day}}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Month",
  props: {
    number: {
      required: true,
      type: Number
    },
    holidays: {
      required: false,
      type: Array,
      default: () => []
    },
  },
  data() {
    return {
      label: '',
      days: [],
      grid: []
    }
  },
  created() {
    if (this.number === 1) {
      this.days = 28
    } else if ([0, 2, 4, 6, 7, 9, 11].indexOf(this.number) !== -1) {
      this.days = 31
    } else {
      this.days = 30
    }
    this.days = [...(new Array(this.days)).keys()].map(dayNumber => dayNumber += 1)
    let date = new Date();
    date.setMonth(this.number);
    date.setDate(1)
    let grid = new Array(42);
    let offset = date.getDay() - 1;
    for (let index = 0; index < this.days.length; index++) {
      grid[offset + index] = this.days[index];
    }
    this.grid = grid;
    this.label = date.toLocaleString('ru', {
      month: 'long',
    });
  },
  methods: {
    isHoliday(dayNumber) {
      if (!dayNumber) {
        return false;
      }
      let year = (new Date()).getFullYear();
      return !this.$moment(`${dayNumber}-${this.number + 1}-${year}`, 'DD-MM-YYYY').isBusinessDay()
    }
  }
}
</script>

<style lang="scss">
  .month {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    grid-template-rows: repeat(5, 1fr);
  }
  .calendar-cell {
    &:hover {
      background: gray;
    }
  }
</style>