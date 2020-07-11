<template>
    <b-modal id="product_modal"
             title="Gerenciar Produto"
             @ok.prevent="save"
             @hidden="reset"
             ok-title="Salvar"
             ok-only>
        <form ref="product_form">
            <form-group label="Nome" :required="true">
                <b-form-input name="name" :value="content.name"/>
            </form-group>
            <form-group label="Descrição">
                <b-form-textarea name="description" :value="content.description"/>
            </form-group>
            <form-group label="Marca" name="brand_id" :required="true">
                <b-row>
                    <b-col cols="10">
                        <v-select v-model="content.brand"
                                  :options="options.brand"
                                  @search="brandSearch"/>
                    </b-col>
                    <b-col cols="2">
                        <b-button variant="primary" v-b-tooltip="'Novo'" size="sm" block v-b-modal.brand_modal>
                            <i class="fa fa-plus"/>
                        </b-button>
                    </b-col>
                </b-row>
            </form-group>
            <form-group label="Categoria" name="category_id" :required="true">
                <b-row>
                    <b-col cols="10">
                        <v-select v-model="content.category"
                                  :options="options.category"
                                  @search="categorySearch"/>
                    </b-col>
                    <b-col cols="2">
                        <b-button variant="primary" v-b-tooltip="'Novo'" size="sm" block v-b-modal.category_modal>
                            <i class="fa fa-plus"/>
                        </b-button>
                    </b-col>
                </b-row>
            </form-group>
        </form>
        <category-form/>
        <brand-form/>
    </b-modal>
</template>

<script>
    import CategoryForm from "../../category/form/CategoryForm";
    import BrandForm from "../../brand/form/BrandForm";
    import FormMixin from "../../../../mixins/FormMixin";

    export default {
        name: "ProductForm",
        components: {BrandForm, CategoryForm},
        mixins: [FormMixin],
        data() {
            return {
                content: {},
                form: {
                    action: route('catalog.product.store'),
                    method: 'post'
                },
                options: {
                    brand: [],
                    category: []
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
            async brandSearch(search = null, loading) {
                loading(true);
                let {data} = await axios.get(route('catalog.brand.search') + `?search=${search}`);
                this.options.brand = data;
                loading(false);
            },
            edit({id}) {
                this.request(route('catalog.product.edit', {id: id}), {
                    method: 'get',
                    onSuccess: ({data}) => {
                        this.content = data;
                        this.form.action = route('catalog.product.update', {id: id});
                        this.form.method = 'put';
                        this.$bvModal.show('product_modal');
                    }
                });
            },
            save() {
                let form = new FormData(this.$refs['product_form']);
                form.set('category_id', this.content?.category?.code);
                form.set('brand_id', this.content?.brand?.code);
                this.request(this.form.action, {
                    method: this.form.method,
                    data: form,
                    toast: true,
                    onSuccess: () => {
                        this.$bvModal.hide('product_modal');
                        this.$emit('save');
                    },
                    onError: (error) => this.showErrors(error)
                });
            }
        }
    }
</script>
