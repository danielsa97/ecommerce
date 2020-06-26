<template>
    <b-modal id="user_modal"
             title="Gerenciar Usuário"
             @ok.prevent="save"
             ok-title="Salvar"
             @hidden="reset"
             ok-only>
        <form ref="user_form">
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
    import FormMixin from "../../../../mixins/FormMixin";

    export default {
        name: "UserForm",
        mixins: [FormMixin],
        data() {
            return {
                content: {},
                form: {
                    action: route('setting.user.store'),
                    method: 'post'
                }
            }
        },
        methods: {
            edit({id}) {
                this.request(route('setting.user.edit', {id: id}), {
                    method: 'get',
                    onSuccess: ({data}) => {
                        this.content = data;
                        this.form.action = route('setting.user.update', {id: id});
                        this.form.method = 'put';
                        this.$bvModal.show('user_modal');
                    }
                });
            },
            save() {
                this.request(this.form.action, {
                    method: this.form.method,
                    data: new FormData(this.$refs['user_form']),
                    toast: true,
                    onSuccess: () => {
                        this.$bvModal.hide('user_modal');
                        this.$emit('save');
                    },
                    onError: (error) => this.showErrors(error)
                });
            }
        }
    }
</script>
