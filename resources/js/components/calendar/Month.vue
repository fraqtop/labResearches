<template>
  <div>
    <h4>{{label}}</h4>
    <div class="legend">
      <p
          v-for="label in labels"
          v-bind:key="label"
          class="text-center m-0 text-muted"
      >
        {{label}}
      </p>
    </div>
    <div class="month">
      <div
          v-for="day in calendar"
          v-bind:class="{'bg-info': day.isHoliday}"
          @click="editDay(day.number)"
          class="border text-center clickable calendar-cell"
      >
        {{day.number}}
      </div>
    </div>
    <insert-holiday
        :month="number"
        :day="selectedDay"
        v-model="isModalVisible"
        v-on:saved="addHoliday"
    />
  </div>
</template>

<script>
import InsertHoliday from "../insert/Holiday";
export default {
  name: "Month",
  components: {InsertHoliday},
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
      grid: [],
      calendar: [],
      labels: ['пн', 'вт', 'ср', 'чт', 'пт', 'сб', 'вс'],
      year: (new Date()).getFullYear(),
      test: null,
      currentHolidays: [],
      isModalVisible: false,
      selectedDay: null
    }
  },
  watch: {
    holidays: function (value) {
      this.currentHolidays = value;
      this.setCalendar();
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
    let grid = (new Array(42)).fill(-1, 0, 42);
    let weekDay = date.getDay();
    let offset = weekDay ? weekDay - 1 : 6
    for (let index = 0; index < this.days.length; index++) {
      grid[offset + index] = this.days[index];
    }
    this.label = date.toLocaleString('ru', {
      month: 'long',
    });
    this.grid = grid
    this.setCalendar();
  },
  methods: {
    isHoliday(dayNumber) {
      if (!dayNumber || dayNumber < 0) {
        return false;
      }
      if (this.currentHolidays.indexOf(dayNumber) !== -1) {
        return true;
      }
      return !this.$moment(`${dayNumber}-${this.number + 1}-${this.year}`, 'DD-MM-YYYY').isBusinessDay()
    },
    setCalendar() {
      this.calendar = this.grid.map((day) => {
        return {
          number: day === -1 ? '' : day,
          isHoliday: this.isHoliday(+day)
        }
      });
    },
    editDay(day) {
      if (day && !this.isHoliday(day)) {
        this.selectedDay = day;
        this.isModalVisible = true;
      }
    },
    addHoliday(payload) {
      this.currentHolidays.push(+payload.day);
      this.setCalendar();
      this.isModalVisible = false;
    },
  }
}
</script>

<style lang="scss" scoped>
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
  .legend {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
  }
</style>