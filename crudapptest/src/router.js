import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'
import AddPost from './views/AddPost.vue'
import View from './views/View.vue'
import Edit from './views/Edit'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import(/* webpackChunkName: "about" */ './views/About.vue')
    },
    {
      path: '/save-post',
      name: 'add',
      component: AddPost
    },
   {
     path :'/view-post',
     name: 'view',
     component: View
   },
   {
     path:'/edit/:id',
     name:'edit',
     component:Edit
   }
  ]
})
