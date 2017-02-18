import Vue from 'vue'
import Router from 'vue-router'
import HomeScreen from 'components/HomeScreen'
import VideoScreen from 'components/VideoScreen'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeScreen
    },
    {
      path: '/video/:id',
      props: true,
      name: 'video',
      component: VideoScreen
    }
  ]
})
