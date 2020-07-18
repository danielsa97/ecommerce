import NProgress from 'nprogress';

window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


const loading = {
    stage: 1,
    run: () => {
        switch (loading.stage) {
            case 2:
                setTimeout(() => {
                    NProgress.inc();
                    loading.run();
                }, 500);
                break;
            case 3:
                loading.stage = 1;
                NProgress.done();
                break;
        }
    },
    done: () => {
        loading.stage = 3;
    }

};


axios.interceptors.request.use((config) => {
    if (loading.stage === 1) {
        NProgress.start();
        loading.stage = 2;
        loading.run();
    }
    return config;
}, (error) => {
    loading.done();
    return Promise.reject(error);
});

axios.interceptors.response.use((response) => {
    loading.done();
    return response;
}, (error) => {
    loading.done();
    return Promise.reject(error);
});

require('overlayscrollbars');
require('bootstrap');
require('datatables.net-buttons-bs');
require('datatables.net-bs4');
require('admin-lte');

const DATATABLE_PT_BR = require('./assets/datatable-pt-br');

$.extend(true, $.fn.dataTable.defaults, {
    "language": DATATABLE_PT_BR,
});

