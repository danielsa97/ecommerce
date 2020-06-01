<template>
    <b-modal id="user_form" title="Gerenciar cadastro de usuário" @show="getUser" @hidden="resetModal" hide-footer>
        <form @submit.prevent="submit">
            <b-form-group label="Nome completo">
                <b-form-input name="name" :value="content.name"/>
            </b-form-group>
            <b-form-group label="E-mail">
                <b-form-input name="email" :value="content.email"/>
            </b-form-group>
            <b-form-group label="Senha">
                <b-form-input type="password" name="password" placeholder="*****"/>
            </b-form-group>
            <b-form-group label="Digite a senha novamente">
                <b-form-input type="password" name="password_confirmation" placeholder="*****"/>
            </b-form-group>
            <b-form-group>
                <b-button type="submit" variant="primary">Salvar</b-button>
            </b-form-group>
        </form>
    </b-modal>
</template>

<script>
    import FormMixin from "../../../mixins/FormMixin";

    export default {
        name: "UserForm",
        props: {
            datatableId: {
                type: String,
                required: false
            }
        },
        mixins: [FormMixin],
        data() {
            return {
                userId: null,
                content: {}
            }
        },
        watch: {},
        mounted() {
            document.addEventListener('click', async ({target}) => {
                let userId = target.dataset['user_form'];
                if (userId) {
                    this.userId = userId;
                    this.$bvModal.show('user_form');
                }
            });
        },
        methods: {
            resetModal() {
                this.userId = null;
                this.content = {};
            },
            getUser() {
                if (this.userId) {
                    this.request({
                        method: 'get',
                        url: `/setting/user/${this.userId}/edit`,
                        onSuccess: ({data}) => {
                            this.content = data;
                        },
                        toastAlert: false
                    });
                }
            },
            submit({target}) {
                this.request({
                    url: this.userId ? `/setting/user/${this.userId}` : '/setting/user',
                    data: new FormData(target),
                    method: this.userId ? 'put' : 'post',
                    onSuccess: () => {
                        if (this.datatableId) {
                            $(`#${this.datatableId}`).DataTable().ajax.reload();
                            this.$bvModal.hide('user_form');
                        }
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
