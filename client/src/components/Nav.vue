<template>
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">t.Station</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <uploader></uploader>
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="#">User</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
</template>

<script>
import Uploader from './Uploader'
import Progress from './Progress'

export default {
  name: 'app-nav',
  data () {
    return {
      msg: 'Welcome to Your Vue.js App'
    }
  },
  components: {
    'uploader': Uploader,
    'uploader-progress': Progress
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
