require('./bootstrap');
require('./js-routes');
import Vue from 'vue';
import VueIziToast from 'vue-izitoast';
import vSelect from 'vue-select'
import money from 'v-money'
Vue.use(money)
import VueTheMask from 'vue-the-mask'
Vue.use(VueTheMask)
import {BootstrapVue} from 'bootstrap-vue';
import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css';

import VueFormWizard from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
Vue.use(VueFormWizard)

import VueSelectSides from "vue-select-sides";
Vue.use(VueSelectSides, {
    locale: "pt_BR"
});
Vue.component("vue-select-sides", VueSelectSides);

Vue.component('VueCtkDateTimePicker', VueCtkDateTimePicker);
Vue.use(BootstrapVue);
Vue.use(VueIziToast, {
    resetOnHover: true,
    position: 'topRight',
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


if (document.getElementById('app')) new Vue({
    el: '#app',
});
