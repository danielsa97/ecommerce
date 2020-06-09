<template>
    <b-modal id="discount_modal"
             title="Gerenciar Discontos"
             @hidden="formReset"
             @ok.prevent="save"
             ok-title="Salvar"
             ok-only>
        <form ref="discount_form" data-action="/catalog/discount" data-method="post">
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
        name: "discountManager",
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
                //     this.$bvModal.show('discount_modal');
                // };
                document.getElementById(this.datatable).addEventListener('click', ({target}) => {
                    let {change_status, edit} = target.dataset;
                    this.get(edit);
                    this.changeStatus(change_status, `/catalog/discount/${change_status}/change-status`, this.datatable);
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
                        url: `/catalog/discount/${id}/edit`,
                        onSuccess: async ({data}) => {
                            this.content = data;
                            await this.$bvModal.show('discount_modal');
                            this.$refs['discount_form'].dataset.action = `/catalog/discount/${id}`;
                            this.$refs['discount_form'].dataset.method = 'put';
                        },
                        toastAlert: false
                    });
                }
            },
            save() {
                let form = this.$refs['discount_form'];
                this.request({
                    url: form.dataset.action,
                    method: form.dataset.method,
                    data: new FormData(form),
                    onSuccess: () => {
                        if (this.datatable) {
                            $(`#${this.datatable}`).DataTable().ajax.reload();
                        }
                        this.$bvModal.hide('discount_modal');
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
