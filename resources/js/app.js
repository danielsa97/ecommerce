require('./bootstrap');

import Vue from 'vue';
import VueIziToast from 'vue-izitoast';
import {BootstrapVue} from 'bootstrap-vue';

Vue.use(BootstrapVue);
Vue.use(VueIziToast);

if (document.getElementById('app')) new Vue({
    el: '#app',
});

