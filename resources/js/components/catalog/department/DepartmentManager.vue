<template>
    <div>
        <department-form ref="department_form" @save="dataTableRefresh"/>
        <data-table @create="$bvModal.show('department_modal')"
                    @edit="$refs.department_form.edit($event)"
                    @change-status="changeDepartmentStatus"
                    :id="datatable"
                    route="catalog.department.index"/>
    </div>
</template>

<script>
    import ChangeStatusMixin from "../../../mixins/ChangeStatusMixin";
    import DepartmentForm from "./form/DepartmentForm";

    export default {
        name: "DepartmentManager",
        components: {DepartmentForm},
        mixins: [ChangeStatusMixin],
        data() {
            return {
                datatable: 'department_datatable'
            }
        },
        methods: {
            changeDepartmentStatus({id}) {
                this.changeStatus(route('catalog.department.change-status', {id: id}), this.datatable);
            },
            dataTableRefresh() {
                $(`#${this.datatable}`).DataTable().ajax.reload();
            }
        }
    }
</script>
