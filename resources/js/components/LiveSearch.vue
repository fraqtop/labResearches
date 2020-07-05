<template>
  <b-row>
    <b-col md="10">
      <b-input
          v-model="query"
          :placeholder="placeholder"
      />
      <div
          class="suggest-hint"
          v-show="objects.length"
      >
        <div
            v-for="object in objects"
            v-bind:key="object.id"
        >
          <p>{{object[searchField]}}</p>
        </div>
      </div>
    </b-col>
    <b-col md="2">
      <b-button variant="info" class="font-weight-bold text-white">+</b-button>
    </b-col>
  </b-row>
</template>

<script>
  export default {
    name: "LiveSearch",
    props: {
      placeholder: {
        type: String,
        required: false,
        default: 'Начните вводить'
      },
      link: {
        type: String,
        required: true
      },
      searchOn: {
        type: Number,
        required: false,
        default: 3
      },
      searchField: {
        type: String,
        required: false,
        default: 'name'
      },
    },
    data() {
      return {
        query: '',
        objects: []
      }
    },
    watch: {
      query: function (value) {
        if (value.length >= this.searchOn) {
          this.search(value)
        }
      }
    },
    methods: {
      search(query) {
        window.axios.get(`${this.$config.routes.apiRoot}/${this.link}?filters[like:${this.searchField}]=${query}`)
          .then(response => console.log(response.data))
          .catch(error => console.log(error.response))
      }
    }
  }
</script>