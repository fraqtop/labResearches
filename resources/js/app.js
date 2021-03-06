/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import BootstrapVue from 'bootstrap-vue'
import config from "./config"
import VueRouter from 'vue-router'
import Vuex from 'vuex'
import auth from './vuex/auth'
import App from "./components/App";
import routes from "./routes";
import moment from 'moment-business-days';

const router = new VueRouter({
  mode: 'history',
  routes: routes,
});

window.Vue = require('vue');
window.Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    auth
  }
})

window.Vue.use(BootstrapVue);
window.Vue.use(VueRouter);
window.Vue.prototype.$config = config
window.Vue.prototype.$moment = moment

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: '#app',
  components: {App},
  router,
  store,
});
