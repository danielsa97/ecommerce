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

//Components

Vue.component('user-manager', require("./components/setting/user/UserManager").default);
Vue.component('brand-manager', require("./components/catalog/brand/BrandManager").default);
Vue.component('department-manager', require("./components/catalog/department/DepartmentManager").default);
Vue.component('category-manager', require("./components/catalog/category/CategoryManager").default);
Vue.component('discount-manager', require("./components/catalog/discount/DiscountManager").default);

//General Components
Vue.component('v-select', vSelect);
Vue.component('form-group', require("./components/FormGroup").default);
Vue.component("vue-select-sides", VueSelectSides);
Vue.component('VueCtkDateTimePicker', VueCtkDateTimePicker);
Vue.component('data-table', require("./components/DataTable").default);
Vue.component('page', require("./components/Page").default);
Vue.component('sidebar', require("./components/Sidebar/Sidebar").default);

if (document.getElementById('app')) new Vue({
    el: '#app',
    router
});
