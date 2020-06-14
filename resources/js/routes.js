/* eslint-disable max-len */
import VueRouter from 'vue-router';

const routes = [{
  path: '/',
  component: require('./components/main.vue').default,
}];


const router = new VueRouter({
  routes,
});

export default router;
