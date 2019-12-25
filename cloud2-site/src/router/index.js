import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../views/Home.vue';
import About from '../views/About.vue';
import Contact from '../views/Contact.vue';
import Login from '../views/Login.vue';
import Dash from '../views/Dash.vue';
import DashDef from '../views/DashDef.vue';
import Docs from '../views/Doctors.vue';
import Patients from '../views/Patients.vue';
import Assignments from '../views/Assignments.vue';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
  },
  {
    path: '/about',
    name: 'about',
    component: About,
  },
  {
    path: '/contact',
    name: 'contact',
    component: Contact,
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
  },
  {
    path: '/dash',
    name: 'dash',
    component: Dash,
    meta: {
      isAdmin: true,
    },
    children: [
      {
        path: '/dash',
        component: DashDef,
      },
      {
        path: '/docs',
        component: Docs,
      },
      {
        path: '/patients',
        component: Patients,
      },
      {
        path: '/assignments',
        component: Assignments,
      },
    ],
  },
];

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes,
});

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.isAdmin)) {
    if (localStorage.getItem('jwt') === null) {
      next({
        path: '/login',
      });
    } else {
      next();
    }
  } else if (to.matched.some(record => record.meta.guest)) {
    next();
  } else {
    next();
  }
});

export default router;
