<template>
  <b-row>
    <b-col md="4" offset="4">
      <b-card class="text-center" header="Войдите в систему">
        <b-form-group>
          <b-input v-model="user.email" placeholder="Почта"/>
        </b-form-group>
        <b-form-group>
          <b-input type="password" v-model="user.password" placeholder="Пароль"/>
        </b-form-group>
        <b-button @click="login" variant="info">Войти</b-button>
      </b-card>
    </b-col>
  </b-row>
</template>

<script>
  export default {
    name: "Login",
    data() {
      return {
        user: {
          email: null,
          password: null
        }
      }
    },
    methods: {
      login() {
        window.axios.post(this.$config.login, this.user)
          .then(response => {
            window.axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`
            this.$router.push({name: 'Index'})
          })
          .catch(error => console.log(error))
      }
    }
  }
</script>