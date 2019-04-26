import Vue from 'vue';
import Router from 'vue-router';
import Login from './views/Login.vue';
import Queue from './views/Queue.vue';
import Customer from './views/Customer.vue';
import Mechanic from './views/Mechanic.vue';
import Cars from './views/Cars.vue';
import Celenders from './views/Celenders.vue';
import History from './views/History.vue'

Vue.use(Router);

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/Queue',
      name: 'Queueu',
      component: Queue,
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
    },
    {
      path: '/Customer',
      name: 'Customer',
      component: Customer,
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
    },
    {
      path: '/Mechanic',
      name: 'Mechanic',
      component: Mechanic,
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
    },
    {
      path: '/Cars',
      name: 'Cars',
      component: Cars,
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
    },
    {
      path: '/Celenders',
      name: 'Celender',
      component: Celenders,
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
    },
    {
      path: '/History',
      name: 'History',
      component: History,
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
    },
    {
      path: '/Login',
      name: 'Login',
      component: Login,
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
    },
  ],
});
