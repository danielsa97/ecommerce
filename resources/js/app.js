require('./bootstrap');
require('./assets/js-routes');
require('admin-lte');

import Vue from 'vue';
import VueIziToast from 'vue-izitoast';
import vSelect from 'vue-select';
import money from 'v-money';
import VueTheMask from 'vue-the-mask';
import {BootstrapVue} from 'bootstrap-vue';
import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
import VueSelectSides from "vue-select-sides";
import VueFormWizard from 'vue-form-wizard';
import VueRouter from 'vue-router';
import MenuRouter from "./vue-router/MenuRouter";
import App from "./components/template/App";
import VueAxios from 'vue-axios';
import VueAuth from '@websanova/vue-auth'
import auth from "./auth";
import Vuex from 'vuex';
import store from "./vuex/store";

Vue.use(Vuex);
Vue.use(VueAxios, axios);
Vue.use(VueRouter);
Vue.use(VueFormWizard);
Vue.use(money);
Vue.use(VueTheMask);
Vue.use(BootstrapVue);
Vue.use(VueSelectSides, {
    locale: "pt_BR"
});
Vue.use(VueIziToast, {
    resetOnHover: true,
    position: 'topRight',
});

const router = new VueRouter({
    mode: 'history',
    routes: MenuRouter.toRouter()
});

Vue.router = router;
Vue.use(VueAuth, auth);


//Global Components
Vue.component('v-select', vSelect);
Vue.component('form-group', require("./components/FormGroup").default);
Vue.component('form-group-multiple', require("./components/FormGroupMultiple").default);
Vue.component("vue-select-sides", VueSelectSides);
Vue.component('VueCtkDateTimePicker', VueCtkDateTimePicker);
Vue.component('data-table', require("./components/DataTable").default);
Vue.component('input-image', require("./components/InputImage").default);

new Vue({
    el: '#app',
    render: app => app(App),
    store: new Vuex.Store(store),
    router
});

