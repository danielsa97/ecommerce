require('./bootstrap');
require('./js-routes');
import Vue from 'vue';
import VueIziToast from 'vue-izitoast';
import vSelect from 'vue-select'

import {BootstrapVue} from 'bootstrap-vue';

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
Vue.component('select2', require("./components/Select2").default);


if (document.getElementById('app')) new Vue({
    el: '#app',
});
