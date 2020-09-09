<template>
  <b-navbar type="dark" variant="info">
    <b-navbar-brand>
      <router-link :to="{name: 'Index'}">Сербалаб</router-link>
    </b-navbar-brand>
    <b-navbar-nav>
      <b-nav-item>
        <router-link :to="{name: 'ResearchesList'}">Журнал</router-link>
      </b-nav-item>
      <b-nav-item>
        <router-link :to="{name: 'PriceList'}">Прайс</router-link>
      </b-nav-item>
      <b-nav-item>
        <router-link :to="{name: 'CalendarIndex'}">Календарь</router-link>
      </b-nav-item>
    </b-navbar-nav>
    <b-navbar-nav class="ml-auto">
      <b-nav-item-dropdown right>
        <template slot="button-content">
          <span class="text-white font-weight-bold">{{this.$store.getters.username}}</span>
        </template>
        <b-dropdown-item @click="logout">Выйти</b-dropdown-item>
      </b-nav-item-dropdown>
    </b-navbar-nav>
  </b-navbar>
</template>

<script>
  export default {
    name: "Navbar",
    methods: {
      logout() {
        this.$store.dispatch('logout')
        this.$router.push({name: 'Login'})
      }
    }
  }
</script>