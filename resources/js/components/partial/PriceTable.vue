<template>
  <div>
    <b-table striped hover :items="items" :fields="fields">
      <template slot="top-row" slot-scope="{ fields }">
        <td v-for="field in fields" :key="field.key">
          <b-input v-if="!field.custom" v-model="filters[field.key]" :placeholder="field.label"/>
        </td>
      </template>
      <template slot="cell(link)" slot-scope="data" class="clickable">
        <a :href="data.item['self-link']">перейти</a>
      </template>
    </b-table>
  </div>
</template>

<script>
  export default {
    name: "PriceTable",
    props: {
      items: {
        required: true,
        default: []
      }
    },
    computed: {
      searchableFields: function () {
        return this.fields.filter((field) => {
          return !field.custom
        })
      }
    },
    data() {
      return {
        fields: [
          {
            key: 'code',
            label: 'Код'
          },
          {
            key: 'description',
            label: 'Описание'
          },
          {
            key: 'duration',
            label: 'Длительность'
          },
          {
            key: 'price',
            label: 'Цена'
          },
          {
            key: 'link',
            label: 'Действия',
            custom: true
          }
        ],
        filters: {
          code: null,
          description: null,
          duration: null,
          price: null
        },
        searchDelay: null
      }
    },
    watch: {
      filters: {
        handler() {
          let filtersQuery = ''
          clearTimeout(this.searchDelay)
          this.searchDelay = setTimeout(() => {
            for (let property in this.filters) {
              if (this.filters[property]) {
                filtersQuery += `&filters[like:${property}]=${this.filters[property]}`
              }
            }
            this.$emit('filtersChanged', { query: filtersQuery })
          }, 1000)
        },
        deep: true
      }
    }
  }
</script>

<style scoped>

</style>