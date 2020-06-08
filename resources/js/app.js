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
Vue.component('brand-manager', require("./components/catalog/brand/BrandManager").default);
Vue.component('department-manager', require("./components/catalog/department/DepartmentManager").default);

//General Components
Vue.component('form-group', require("./components/FormGroup").default);


if (document.getElementById('app')) new Vue({
    el: '#app',
});

