require('./bootstrap');

import Vue from 'vue';
import VueIziToast from 'vue-izitoast';
import {BootstrapVue} from 'bootstrap-vue';

Vue.use(BootstrapVue);
Vue.use(VueIziToast, {
    resetOnHover: true,
    position: 'topRight',
});

//Components

Vue.component('user-form', require("./components/setting/user/UserForm").default);


if (document.getElementById('app')) new Vue({
    el: '#app',
});

