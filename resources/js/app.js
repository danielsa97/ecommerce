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

Vue.component('user-manager', require("./components/setting/user/UserManager").default);
Vue.component('form-group', require("./components/FormGroup").default);


if (document.getElementById('app')) new Vue({
    el: '#app',
});

