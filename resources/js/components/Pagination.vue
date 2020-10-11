<template>
  <b-row v-show="meta.currentPage !== meta.lastPage" class="w-100">
    <b-col class="centered pagination clickable">
      <p class="p-2 m-0 text-bold">Загрузить ещё</p>
    </b-col>
  </b-row>
</template>

<script>
  export default {
    name: "Pagination",
    props: {
      meta: {
        type: Object,
        required: true
      }
    }
  }
</script>

<style lang="scss" scoped>
  .pagination {
    background: cadetblue;
    padding: 0;
  }
</style>