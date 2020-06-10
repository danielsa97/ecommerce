const DataTableButtonMixin = {
    methods: {
        btnDataTableCreate(dataTableId = 'dataTableBuilder', action) {
            document.body.onload = () => {
                let table = $(`#${dataTableId}`).DataTable();
                table.button().add(0, {
                    text: '<i class="fa fa-plus-circle"></i> Cadastrar',
                    className: 'btn btn-primary',
                    action: () => action()
                })
            }
        }
    }
};
export default DataTableButtonMixin;
