<template>
    <b-modal id="brand_modal"
             title="Gerenciar Marca"
             @ok.prevent="save"
             @hidden="reset"
             ok-title="Salvar"
             ok-only>
        <form ref="brand_form" enctype="multipart/form-data">
            <form-group label="Nome" :required="true">
                <b-form-input name="name" :value="content.name"/>
            </form-group>
            <form-group label="Descrição">
                <b-form-textarea name="description" :value="content.description"/>
            </form-group>
            <form-group label="Imagem" name="image" :required="true">
                <input-image v-model="content.image"/>
            </form-group>
        </form>
    </b-modal>
</template>

<script>
    import FormMixin from "../../../../mixins/FormMixin";

    export default {
        name: "BrandForm",
        mixins: [FormMixin],
        data() {
            return {
                content: {},
                form: {
                    action: route('catalog.brand.store'),
                    method: 'post'
                }
            };
        },
        methods: {
            edit({id}) {
                this.request(route('catalog.brand.edit', {id: id}), {
                    method: 'get',
                    onSuccess: ({data}) => {
                        this.content = data;
                        this.form.action = route('catalog.brand.update', {id: id});
                        this.form.method = 'put';
                        this.$bvModal.show('brand_modal');
                    }
                });
            },
            save() {
                let form = new FormData(this.$refs['brand_form']);
                if (this.content.image) {
                    form.set('image', this.content.image);
                }
                this.request(this.form.action, {
                    method: this.form.method,
                    data: form,
                    toast: true,
                    onSuccess: () => {
                        this.$bvModal.hide('brand_modal');
                        this.$emit('save');
                    },
                    onError: (error) => this.showErrors(error)
                });
            }
        }
    }
</script>
