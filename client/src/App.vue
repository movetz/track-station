<template>
  <div id="app">
    <app-nav></app-nav>
    <div class="container">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>

import Nav from 'components/Nav'

export default {
  name: 'app',
  components: {
    'app-nav': Nav
  }
}
</script>

<style>
#app {
  /*font-family: 'Avenir', Helvetica, Arial, sans-serif;*/
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
</style>
