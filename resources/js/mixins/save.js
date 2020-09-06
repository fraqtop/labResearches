export default {
  data() {
    return {
      errorMessage: null,
      saveData: {},
      responseData: null
    }
  },
  methods: {
    save() {
      window.axios.post(this.saveLink, this.saveData)
        .then(response => {
          this.responseData = response.data;
          this.$emit('saved', response.data);
        })
        .catch(error => this.errorMessage = this.setErrorMessage(error))
    },
    setErrorMessage(error) {
      return error.response.data.message || this.$config.defaultMessages[error.response.status]
    },
    syncSave() {
      return new Promise((resolve) => {
        window.axios.post(this.saveLink, this.saveData)
          .then(response => {
            resolve(response.data);
          })
          .catch(error => this.errorMessage = this.setErrorMessage(error))
      })
    }
  }
}