/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'vue-good-table/dist/vue-good-table.css'

//Use Globally
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(VueRouter);
Vue.use(VueAxios, axios);


Vue.component('Welcome', require('./components/Welcome.vue').default);
Vue.component('SkillsRate', require('./components/SkillsRate.vue').default);
Vue.component('JobList', require('./components/JobList.vue').default);
Vue.component('Home', require('./components/Home.vue').default);


const app = new Vue({
    el: '#app',
});
