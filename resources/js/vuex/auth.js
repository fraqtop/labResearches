export default {
  getters: {
    authHeader: state => `Bearer ${state.token}`,
    isLoggedIn: state => !!state.token,
    username: state => state.username
  },
  state: {
    token: localStorage.getItem('token') || '',
    username: localStorage.getItem('username') || ''
  },
  mutations: {
    setUserData(state, payload) {
      state.token = payload.token
      state.username = payload.username
      localStorage.setItem('token', state.token)
      localStorage.setItem('username', state.username)
    },
    clear(state) {
      for(let value in state) {
        state[value] = null;
      }
      localStorage.clear()
    }
  },
  actions: {
    login({commit, getters}, authData) {
      return new Promise((resolve, reject) => {
        window.axios.post(this._vm.$config.login, authData)
          .then(response => {
            console.log(response.data)
            this.commit('setUserData', response.data)
            window.axios.defaults.headers.common['Authorization'] = this.getters.authHeader
            resolve(response)
          })
          .catch(error => reject(error))
      })
    },
    logout() {
      this.commit('clear')
    }
  }
}