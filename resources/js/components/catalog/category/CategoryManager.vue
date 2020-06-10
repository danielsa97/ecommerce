<template>
    <div>
        <b-modal id="category_modal"
                 title="Gerenciar categoria"
                 @hidden="formReset"
                 @ok.prevent="save"
                 ok-title="Salvar"
                 ok-only>
            <form ref="category_form" data-action="/catalog/category" data-method="post">
                <form-group label="Nome" :required="true">
                    <b-form-input name="name" :value="content.name"/>
                </form-group>
                <form-group label="Descrição">
                    <b-form-textarea name="description" :value="content.description"/>
                </form-group>
                <form-group label="Departamento" :required="true">
                    <b-row>
                        <b-col cols="10">
                            <select2 name="department_id" url="/catalog/department/department-search"/>
                        </b-col>
                        <b-col cols="2">
                            <b-button variant="primary" v-b-tooltip="'Novo'" block v-b-modal.department_modal>
                                <i class="fa fa-plus"/>
                            </b-button>
                        </b-col>
                    </b-row>
                </form-group>
                <form-group label="Categoria superior">
                    <select2 name="category_id" url="/catalog/category/category-search"/>
                </form-group>
            </form>
        </b-modal>
        <department-manager/>
    </div>
</template>

<script>
    import FormMixin from "../../../mixins/FormMixin";
    import ChangeStatusMixin from "../../../mixins/ChangeStatusMixin";

    export default {
        name: "CategoryManager",
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
                document.getElementById(this.datatable).addEventListener('click', ({target}) => {
                    let {change_status, edit} = target.dataset;
                    this.get(edit);
                    this.changeStatus(change_status, `/catalog/category/${change_status}/change-status`, this.datatable);
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
                        url: `/catalog/category/${id}/edit`,
                        onSuccess: async ({data}) => {
                            this.content = data;
                            await this.$bvModal.show('category_modal');
                            this.$refs['category_form'].dataset.action = `/catalog/category/${id}`;
                            this.$refs['category_form'].dataset.method = 'put';
                        },
                        toastAlert: false
                    });
                }
            },
            save() {
                let form = this.$refs['category_form'];
                this.request({
                    url: form.dataset.action,
                    method: form.dataset.method,
                    data: new FormData(form),
                    onSuccess: () => {
                        if (this.datatable) {
                            $(`#${this.datatable}`).DataTable().ajax.reload();
                        }
                        this.$bvModal.hide('category_modal');
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
