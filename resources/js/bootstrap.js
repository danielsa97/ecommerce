window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

require('overlayscrollbars');
require('select2');

require('bootstrap');
require('datatables.net-buttons-bs');
require('datatables.net-bs4');

const DATATABLE_PT_BR = require('./assets/datatable-pt-br');

$.extend(true, $.fn.dataTable.defaults, {
    "language": DATATABLE_PT_BR,
});

$.fn.select2.defaults.set('language', require("select2/dist/js/i18n/pt-BR"));

window.btnCadastroDataTable = (dataTableId = 'dataTableBuilder') => {
    let table = $(`#${dataTableId}`).css('width', "100%").DataTable();
    new $.fn.dataTable.Buttons(table, {
        buttons: [
            {
                text: '<i class="fa fa-plus-circle"></i> Cadastrar',
                className: 'btn btn-primary btn-sm',
                attr: {
                    id: `btn_${dataTableId}`
                }
                // action: function () {
                //     location.href = route;
                // }
            }
        ]
    });

    table.buttons(1, null).container().prependTo(
        table.table().container()
    );
};
