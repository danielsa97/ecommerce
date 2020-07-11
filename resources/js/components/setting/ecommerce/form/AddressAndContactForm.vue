<template>
    <form @submit.prevent="save">
        <b-row>
            <b-col cols="12" md="4">
                <h5>Endereços</h5>
                <form-group label="Rua">
                    <b-form-input name="address" :value="content.address"/>
                </form-group>
            </b-col>
            <b-col cols="12" md="4">
                <h5>E-mails</h5>
                <form-group label="E-mail">
                    <b-form-input name="email" :value="content.email"/>
                </form-group>
            </b-col>
            <b-col cols="12" md="4">
                <h5>Telefones</h5>
                <form-group label="Telefone">
                    <b-form-input name="phone" :value="content.phone"/>
                </form-group>
            </b-col>
        </b-row>
        <b-form-group class="text-right">
            <b-button type="submit" variant="primary">Salvar</b-button>
        </b-form-group>
    </form>
</template>

<script>
    import FormMixin from "../../../../mixins/FormMixin";

    export default {
        name: "AddressAndContactForm",
        mixins: [FormMixin],
        data() {
            return {
                content: {},
                form: {
                    action: route('setting.ecommerce.update-address-and-contact'),
                    method: 'put'
                }
            }
        },
        methods: {
            save({target}) {
                this.request(this.form.action, {
                    method: this.form.method,
                    data: new FormData(target),
                    toast: true,
                    onError: (error) => this.showErrors(error)
                });
            }
        }
    }
</script>

<style scoped>

</style>
