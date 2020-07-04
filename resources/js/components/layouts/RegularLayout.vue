<template>
  <div>
    <navbar/>
    <router-view/>
  </div>
</template>

<script>
  import Navbar from "../partial/Navbar";

  export default {
    name: "Layout",
    components: {Navbar}
  }
</script>

<style scoped>

</style>