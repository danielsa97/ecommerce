<template>
    <b-modal id="category_modal"
             title="Gerenciar Categoria"
             @ok.prevent="save"
             @hidden="reset"
             ok-title="Salvar"
             ok-only>
        <form ref="category_form">
            <form-group label="Nome" :required="true">
                <b-form-input name="name" :value="content.name"/>
            </form-group>
            <form-group label="Descrição">
                <b-form-textarea name="description" :value="content.description"/>
            </form-group>
            <form-group label="Departamento" name="departments" :required="true">
                <b-row>
                    <b-col cols="10">
                        <v-select v-model="content.departments"
                                  :options="options.departments"
                                  @search="departmentSearch" :multiple="true"/>
                    </b-col>
                    <b-col cols="2">
                        <b-button variant="primary" v-b-tooltip="'Novo'" size="sm" block v-b-modal.department_modal>
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
        <department-form/>
    </b-modal>
</template>

<script>
    import FormMixin from "../../../../mixins/FormMixin";
    import DepartmentForm from "../../department/form/DepartmentForm";

    export default {
        name: "CategoryForm",
        components: {DepartmentForm},
        mixins: [FormMixin],
        data() {
            return {
                content: {},
                form: {
                    action: route('catalog.category.store'),
                    method: 'post'
                },
                options: {
                    category: [],
                    departments: []
                },
            }
        },
        methods: {
            async categorySearch(search = null, loading) {
                loading(true);
                let {data} = await axios.post(route('catalog.category.search') + `?search=${search}`, {
                    category_id: this.content.id
                });
                this.options.category = data;
                loading(false);
            },
            async departmentSearch(search = null, loading) {
                loading(true);
                let {data} = await axios.get(route('catalog.department.search') + `?search=${search}`);
                this.options.departments = data;
                loading(false);
            },

            edit({id}) {
                this.request(route('catalog.category.edit', {id: id}), {
                    method: 'get',
                    onSuccess: ({data}) => {
                        this.content = data;
                        this.form.action = route('catalog.category.update', {id: id});
                        this.form.method = 'put';
                        this.$bvModal.show('category_modal');
                    }
                });
            },
            save() {
                let form = new FormData(this.$refs['category_form']);
                form.set('category_id', this.content?.category?.code ?? '');
                this.content?.departments?.forEach(department => {
                    form.append('departments[]', department?.code);
                });
                this.request(this.form.action, {
                    method: this.form.method,
                    data: form,
                    toast: true,
                    onSuccess: () => {
                        this.$bvModal.hide('category_modal');
                        this.$emit('save');
                    },
                    onError: (error) => this.showErrors(error)
                });
            }
        }
    }
</script>
