<template>
    <div class="upload-progress progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
            <span class="sr-only">60% Complete</span>
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
    .upload-progress.progress {
        width: 100%;
        margin-bottom: 0;
        border-radius: 0;
        height: 5px;
    }
</style>
