export default {
  data() {
    return {
      errorMessage: null
    }
  },
  methods: {
    save() {
      window.axios.post(this.saveLink, this.saveData)
        .then(response => {
          this.isVisible = false
          this.$emit('saved', response.data)
        })
        .catch(error => this.errorMessage = this.setErrorMessage(error))
    },
    setErrorMessage(error) {
      return error.response.data.message || this.$config.defaultMessages[error.response.status]
    }
  }
}