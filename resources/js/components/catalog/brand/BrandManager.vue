<template>
    <b-modal id="brand_modal"
             title="Gerenciar Marca"
             @hidden="reset"
             @ok.prevent="save"
             ok-title="Salvar"
             ok-only>
        <form ref="brand_form" data-action="/catalog/brand" data-method="post">
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
        name: "BrandManager",
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
                    this.changeStatus(change_status, route('catalog.brand.change-status', {id: change_status}), this.datatable);
                });
            }
        },
        methods: {
            reset() {
                Object.assign(this.$data, this.$options.data.apply(this));
            },
            get(id = undefined) {
                if (id) {
                    this.request({
                        method: 'get',
                        url: route('catalog.brand.edit', {id: id}),
                        onSuccess: async ({data}) => {
                            this.content = data;
                            await this.$bvModal.show('brand_modal');
                            this.$refs['brand_form'].dataset.action = route('catalog.brand.update', {id: id});
                            this.$refs['brand_form'].dataset.method = 'put';
                        },
                        toastAlert: false
                    });
                }
            },
            save() {
                let form = this.$refs['brand_form'];
                this.request({
                    url: form.dataset.action,
                    method: form.dataset.method,
                    data: new FormData(form),
                    onSuccess: () => {
                        if (this.datatable) {
                            $(`#${this.datatable}`).DataTable().ajax.reload();
                        }
                        this.$bvModal.hide('brand_modal');
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
