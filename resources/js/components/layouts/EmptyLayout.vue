<template>
  <b-container>
    <b-row>
      <b-col md="6" class="my-auto offset-md-3">
        <router-view/>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
  export default {
    name: "EmptyLayout"
  }
</script>

<style lang="scss" scoped>
  .row {
    height: 100vh;
  }
</style>