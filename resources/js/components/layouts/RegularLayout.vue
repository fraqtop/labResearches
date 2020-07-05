<template>
  <div>
    <navbar class="mb-5"/>
    <router-view/>
  </div>
</template>

<script>
  import Navbar from "../Navbar";

  export default {
    name: "Layout",
    components: {Navbar}
  }
</script>

<style scoped>

</style>