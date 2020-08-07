<template>
  <b-row>
    <b-col md="10">
      <b-input
          @focus="isFocused = true"
          @blur="handleBlur"
          v-model="query"
          @keydown="handleInput"
          :placeholder="placeholder"
      />
      <div
          v-show="objects.length && isFocused"
          class="suggest-hint"
      >
        <div
            v-for="object in objects"
            v-bind:key="object.id"
            @click="choose(object)"
            class="suggest-item p-2"
        >
          <p class="m-0 p-0">{{object[searchField]}}</p>
        </div>
      </div>
    </b-col>
    <b-col md="2">
      <insert-modal v-on:saved="choose" :entity-type="link"/>
    </b-col>
  </b-row>
</template>

<script>
  import ModalContainer from "./insert/ModalContainer";

  export default {
    name: "LiveSearch",
    components: {
      'insert-modal': ModalContainer
    },
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
      value: {
        required: true,
      },
      isNeedsDetails: {
        required: false,
        type: Boolean,
        default: false
      }
    },
    watch: {
      value: function (value) {
        if (!value) {
          this.query = null;
        }
      }
    },
    data() {
      return {
        query: '',
        objects: [],
        timeOut: null,
        isFocused: false,
      }
    },
    methods: {
      search(query) {
        window.axios.get(`${this.$config.routes.apiRoot}/${this.link}?filters[like:${this.searchField}]=${query}`)
          .then(response => {
            this.objects = response.data.items
          })
          .catch(error => {
            this.objects = []
            console.log(error.response)
          })
      },
      handleBlur() {
        this.timeOut = setTimeout(() => {
          this.isFocused = false
        }, 1000)
      },
      choose(item) {
        let valueToReturn = this.isNeedsDetails ? item : item.id;
        this.$emit('input', valueToReturn);
        this.query = item[this.searchField];
        this.objects = [];
      },
      handleInput() {
        if (this.query.length < this.searchOn) {
          this.objects = []
          return;
        }
        this.search(this.query);
      }
    }
  }
</script>

<style lang="scss" scoped>
  @import "../../sass/variables";

  .suggest-hint{
    position: absolute;
    background: #E4F0F6;
    z-index: 10;
    top: 40px;
    width: 95%;
  }
  .suggest-item {
    cursor: pointer;
    border-radius: 5px;
    transition: all 0.5s;
    &:hover {
      color: $bright-font;
      font-weight: bolder;
      background: $blue;
    }
  }
</style>