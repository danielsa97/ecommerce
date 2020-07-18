import Container from "./template/Container";

require('./bootstrap');
require('./js-routes');
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


//Global Components
Vue.component('v-select', vSelect);
Vue.component('form-group', require("./components/FormGroup").default);
Vue.component('form-group-multiple', require("./components/FormGroupMultiple").default);
Vue.component("vue-select-sides", VueSelectSides);
Vue.component('VueCtkDateTimePicker', VueCtkDateTimePicker);
Vue.component('data-table', require("./components/DataTable").default);
Vue.component('input-image', require("./components/InputImage").default);

if (document.getElementById('app')) new Vue({
    el: '#app',
    render: h => h(Container),
    router
});
