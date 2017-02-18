<template>
    <div class="row">
        <div class="col-lg-7">
            <h2>Main</h2>
            <router-link :to="{ name: 'video', params: { id: 'yCtfrAXHcPs' }}">Video test</router-link>
        </div>
        <div class="col-lg-5">
            <h2>Stream</h2>
        </div>
    </div>
</template>

<script>
export default {
  name: 'app-nav',
  data () {
    return {
      msg: 'Welcome to Your Vue.js App'
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
