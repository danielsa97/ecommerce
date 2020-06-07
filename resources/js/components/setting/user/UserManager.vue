<template>
    <b-modal id="user_modal"
             title="Gerenciar usuário"
             @hidden="formReset"
             @ok.prevent="saveUser"
             ok-title="Salvar"
             ok-only>
        <form ref="user_form" data-action="/setting/user" data-method="post">
            <form-group label="Nome completo" :required="true">
                <b-form-input name="name" :value="content.name"/>
            </form-group>
            <form-group label="E-mail" :required="true">
                <b-form-input name="email" :value="content.email"/>
            </form-group>
            <form-group label="Senha">
                <b-form-input type="password" name="password" placeholder="*****"/>
            </form-group>
            <form-group label="Digite a senha novamente">
                <b-form-input type="password" name="password_confirmation" placeholder="*****"/>
            </form-group>
        </form>
    </b-modal>
</template>

<script>
    import FormMixin from "../../../mixins/FormMixin";

    export default {
        name: "UserManager",
        props: {
            datatable: {
                type: String,
                required: false
            }
        },
        mixins: [FormMixin],
        data() {
            return {
                content: {}
            }
        },
        mounted() {
            if (this.datatable) {
                document.getElementById(this.datatable).addEventListener('click', ({target}) => {
                    this.getUser(target.dataset.user_edit);
                    this.changeStatus(target.dataset.user_change_status);
                });
            }
        },
        methods: {
            formReset() {
                this.content = {};
            },
            changeStatus(id = undefined) {
                if (id) {
                    this.$toast.question("Deseja alterar o status deste usuário?", 'Alerta', {
                        buttons: [
                            ['<button>Sim</button>', (instance, toast) => {
                                instance.hide({transitionOut: 'fadeOut'}, toast, 'button');
                                this.request({
                                    url: `/setting/user/${id}/change-status`,
                                    method: 'put',
                                    toastAlert: false,
                                    onSuccess: () => {
                                        if (this.datatable) {
                                            $(`#${this.datatable}`).DataTable().ajax.reload();
                                        }
                                        this.$toast.success("Status alterado", "Sucesso");
                                    },
                                    onError: (error) => {

                                    }
                                });
                            }, true],
                            ['<button>Não</button>', function (instance, toast) {
                                instance.hide({transitionOut: 'fadeOut'}, toast, 'button');
                            }],
                        ]
                    });
                }
            },
            getUser(id = undefined) {
                if (id) {
                    this.request({
                        method: 'get',
                        url: `/setting/user/${id}/edit`,
                        onSuccess: async ({data}) => {
                            this.content = data;
                            await this.$bvModal.show('user_modal');
                            this.$refs['user_form'].dataset.action = `/setting/user/${id}`;
                            this.$refs['user_form'].dataset.method = 'put';
                        },
                        toastAlert: false
                    });
                }
            },
            saveUser() {
                let form = this.$refs['user_form'];
                this.request({
                    url: form.dataset.action,
                    method: form.dataset.method,
                    data: new FormData(form),
                    onSuccess: () => {
                        if (this.datatable) {
                            $(`#${this.datatable}`).DataTable().ajax.reload();
                        }
                        this.$bvModal.hide('user_modal');
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
