<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="jumbotron">
                <h1>Hello, world! Its video # {{ id }}</h1>
                <p>This is an example to show the potential of an offcanvas layout pattern in Bootstrap. Try some responsive-range viewport sizes to see it in action.</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  name: 'app-nav',
  props: ['id'],
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
