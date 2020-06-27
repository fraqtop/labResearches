<template>
  <b-navbar type="dark" variant="info">
    <b-navbar-brand>
      <router-link :to="{name: 'Index'}">Сербалаб</router-link>
    </b-navbar-brand>
    <b-navbar-nav>
      <b-nav-item>
        <router-link :to="{name: 'PriceList'}">Прайс</router-link>
      </b-nav-item>
    </b-navbar-nav>
  </b-navbar>
</template>

<script>
  export default {
    name: "Navbar"
  }
</script>

<style scoped>

</style>