window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

require('overlayscrollbars');
require('bootstrap');
require('datatables.net-buttons-bs');
require('datatables.net-bs4');

const DATATABLE_PT_BR = require('./assets/datatable-pt-br');

$.extend(true, $.fn.dataTable.defaults, {
    "language": DATATABLE_PT_BR,
});

