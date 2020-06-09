<template>
    <b-modal id="user_modal"
             title="Gerenciar usuário"
             @hidden="formReset"
             @ok.prevent="save"
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
    import ChangeStatusMixin from "../../../mixins/ChangeStatusMixin";

    export default {
        name: "UserManager",
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
                    this.changeStatus(change_status, route('setting.user.change-status', {id: change_status}), this.datatable);
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
                        url: route('setting.user.edit', {id: id}),
                        onSuccess: async ({data}) => {
                            this.content = data;
                            await this.$bvModal.show('user_modal');
                            this.$refs['user_form'].dataset.action = route('setting.user.update', {id: id});
                            this.$refs['user_form'].dataset.method = 'put';
                        },
                        toastAlert: false
                    });
                }
            },
            save() {
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
