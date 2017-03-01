<template>
    <label v-if="!processing" class="btn-upload btn-success btn btn-default btn-file navbar-btn">
        Upload <input @change="start" type="file"  style="display: none;">
    </label>
    <button v-else-if="processing"  type="button" @click="stop" class="btn-upload btn-upload btn-danger btn navbar-btn">
        Stop upload
    </button>
</template>

<script>
import FileAPI from 'FileAPI'

export default {
  name: 'app-nav',
  data () {
    return {
      processing: false,
      file: null,
      msg: 'Welcome to Your Vue.js App'
    }
  },
  methods: {
    start (e) {
      this.processing = true

      let file = FileAPI.getFiles(e)[0]
      let xhr = new XMLHttpRequest()

        // обработчик для закачки
      xhr.upload.onprogress = function (event) {
        console.log(event.loaded + ' / ' + event.total)
      }

      xhr.onload = xhr.onerror = function () {
        if (this.status === 200) {
          console.log('success')
          this.processing = false
        } else {
          console.log('error' + this.status)
        }
      }

      xhr.open('POST', 'http://ts.docker/api/uploader', true)
      xhr.send(file)
    },
    stop () {
      this.processing = false
      console.log('Hello from upload')
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .btn-upload {
        margin-left: 20px;
    }
</style>
