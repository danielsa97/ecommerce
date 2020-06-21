<template>
    <page title="Departamentos" description="Gerencie os departamentos da loja">
        <b-modal id="department_modal"
                 title="Gerenciar Departamento"
                 @hidden="reset"
                 @ok.prevent="save"
                 ok-title="Salvar"
                 ok-only>
            <form ref="department_form" data-action="/catalog/department" data-method="post">
                <form-group label="Nome" :required="true">
                    <b-form-input name="name" :value="content.name"/>
                </form-group>
                <form-group label="Descrição">
                    <b-form-textarea name="description" :value="content.description"/>
                </form-group>
            </form>
        </b-modal>
        <data-table @create="$bvModal.show('department_modal')"
                    @edit="edit"
                    @change-status="changeStatusDepartment"
                    :id="datatable"
                    route="datatable.catalog.department"/>
    </page>
</template>

<script>
    import FormMixin from "../../../mixins/FormMixin";
    import ChangeStatusMixin from "../../../mixins/ChangeStatusMixin";

    export default {
        name: "DepartmentManager",
        mixins: [FormMixin, ChangeStatusMixin],
        data() {
            return {
                content: {},
                datatable: 'department_datatable'
            }
        },
        methods: {
            reset() {
                Object.assign(this.$data, this.$options.data.apply(this));
            },
            changeStatusDepartment({id}) {
                this.changeStatus(route('catalog.department.change-status', {id: id}), this.datatable);
            },
            edit({id}) {
                this.request({
                    method: 'get',
                    url: route('catalog.department.edit', {id: id}),
                    onSuccess: ({data}) => {
                        this.content = data;
                        this.$bvModal.show('department_modal');
                        this.$nextTick(() => {
                            this.$refs['department_form'].dataset.action = route('catalog.department.update', {id: id});
                            this.$refs['department_form'].dataset.method = 'put';
                        });
                    },
                    toastAlert: false
                });
            },
            save() {
                let form = this.$refs['department_form'];
                this.request({
                    url: form.dataset.action,
                    method: form.dataset.method,
                    data: new FormData(form),
                    onSuccess: () => {
                        if (this.datatable) {
                            $(`#${this.datatable}`).DataTable().ajax.reload();
                        }
                        this.$bvModal.hide('department_modal');
                    },
                    onError: (error) => {
                        if (error.response.status === 422) {
                            this.showErrors(error.response.data.errors);
                        }
                    }
                });
            }
        }
    }
</script>
