<template>
  <b-card class="text-center fade-in" header="Войдите в систему">
    <b-form @submit.prevent="login">
      <b-form-group>
        <b-input
            v-model="user.email"
            type="email"
            placeholder="Почта"
            required
        />
      </b-form-group>
      <b-form-group>
        <b-input
            type="password"
            v-model="user.password"
            placeholder="Пароль"
            required
        />
      </b-form-group>
      <b-button type="submit" variant="info">Войти</b-button>
    </b-form>
    <div class="text-danger" v-show="this.error">{{this.error}}</div>
  </b-card>
</template>

<script>
  export default {
    name: "Login",
    data() {
      return {
        user: {
          email: null,
          password: null
        },
        error: null
      }
    },
    methods: {
      login() {
        this.error = null
        this.$store.dispatch('login', this.user)
          .then(() => this.$router.push({name: 'Index'}))
          .catch(error => this.error = error.response.data.message)
      },
    }
  }
</script>