<template>
    <div>
        <b-modal id="category_modal"
                 title="Gerenciar Categoria"
                 @hidden="reset"
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
                <form-group label="Departamento" name="department_id" :required="true">
                    <b-row>
                        <b-col cols="10">
                            <v-select v-model="content.department"
                                      :options="options.department"
                                      @search="departmentSearch"/>
                        </b-col>
                        <b-col cols="2">
                            <b-button variant="primary" v-b-tooltip="'Novo'" block v-b-modal.department_modal>
                                <i class="fa fa-plus"/>
                            </b-button>
                        </b-col>
                    </b-row>
                </form-group>
                <form-group label="Categoria Pai">
                    <v-select v-model="content.category"
                              :options="options.category"
                              @search="categorySearch"/>
                </form-group>
            </form>
        </b-modal>
        <department-manager/>
    </div>
</template>

<script>
    import FormMixin from "../../../mixins/FormMixin";
    import ChangeStatusMixin from "../../../mixins/ChangeStatusMixin";
    import DataTableButtonMixin from "../../../mixins/DataTableButtonMixin";

    export default {
        name: "CategoryManager",
        props: {
            datatable: {
                type: String,
                required: false
            }
        },
        mixins: [FormMixin, ChangeStatusMixin, DataTableButtonMixin],
        data() {
            return {
                content: {
                    category: {},
                    department: {}
                },
                options: {
                    category: [],
                    department: []
                },
            }
        },
        mounted() {

            if (this.datatable) {
                this.btnDataTableCreate(this.datatable, () => {
                    this.$bvModal.show('category_modal');
                });
                document.getElementById(this.datatable).addEventListener('click', ({target}) => {
                    let {change_status, edit} = target.dataset;
                    this.get(edit);
                    this.changeStatus(change_status, route('catalog.category.change-status', {id: change_status}), this.datatable);
                });
            }
        },
        methods: {
            categorySearch(search = null, loading) {
                loading(true);
                axios({
                    method:'post',
                    url: route('catalog.category.search', {search: search}),
                    data: {
                        category_id: this.content.id
                    }
                }).then(({data}) => {
                    this.options.category = data;
                    loading(false);
                });

            },
            departmentSearch(search = null, loading) {
                loading(true);
                axios.get(route('catalog.department.search', {search: search}))
                    .then(({data}) => {
                        this.options.department = data;
                        loading(false);
                    });

            },
            reset() {
                Object.assign(this.$data, this.$options.data.apply(this));
            },
            get(id = undefined) {
                if (id) {
                    this.request({
                        method: 'get',
                        url: route('catalog.category.edit', {id: id}),
                        onSuccess: async ({data}) => {
                            this.content = data;
                            await this.$bvModal.show('category_modal');
                            this.$refs['category_form'].dataset.action = route('catalog.category.update', {id: id});
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
                    appends: {
                        category_id: this.content?.category?.code,
                        department_id: this.content?.department?.code
                    },
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
