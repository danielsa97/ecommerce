<template>
    <b-modal id="department_modal"
             title="Gerenciar departamento"
             @hidden="formReset"
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
</template>

<script>
    import FormMixin from "../../../mixins/FormMixin";
    import ChangeStatusMixin from "../../../mixins/ChangeStatusMixin";

    export default {
        name: "DepartmentManager",
        props: {
            datatable: {
                type: String,
                required: false
            }
        },
        mixins: [FormMixin, ChangeStatusMixin],
        data() {
            return {
                content: {}
            }
        },
        mounted() {
            if (this.datatable) {
                console.log(document.getElementById(`btn_${this.datatable}`))
                // document.getElementById(`btn_${this.datatable}`).onclick = () => {
                //     this.$bvModal.show('department_modal');
                // };
                document.getElementById(this.datatable).addEventListener('click', ({target}) => {
                    let {change_status, edit} = target.dataset;
                    this.get(edit);
                    this.changeStatus(change_status, route('catalog.department.edit', {id: change_status}), this.datatable);
                });
            }
        },
        methods: {
            formReset() {
                this.content = {};
            },
            get(id = undefined) {
                if (id) {
                    this.request({
                        method: 'get',
                        url: route('catalog.department.edit', {id: id}),
                        onSuccess: async ({data}) => {
                            this.content = data;
                            await this.$bvModal.show('department_modal');
                            this.$refs['department_form'].dataset.action = route('catalog.department.update', {id: id});
                            this.$refs['department_form'].dataset.method = 'put';
                        },
                        toastAlert: false
                    });
                }
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
