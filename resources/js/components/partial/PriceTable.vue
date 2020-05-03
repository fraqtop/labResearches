<template>
  <div>
    <b-table striped hover :items="items" :fields="fields"></b-table>
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
          }
        ]
      }
    }
  }
</script>

<style scoped>

</style>