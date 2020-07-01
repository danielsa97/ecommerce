<template>
    <form @submit.prevent="save">
        <b-row>
            <b-col cols="12" md="6">
                <form-group label="Nome da Loja">
                    <b-form-input name="name" :value="content.name"/>
                </form-group>
                <form-group label="Descrição">
                    <b-form-textarea name="description" :value="content.description"/>
                </form-group>
            </b-col>
            <b-col cols="12" md="6">
                <form-group label="Logomarca">
                    <input-image v-model="content.brand"/>
                </form-group>
                <form-group label="Palavras chaves" tooltip="Essas palavras ajudam a encontrar o site da loja nos motores de busca(Google, Bing)">
                    <b-form-tags
                        v-model="content.tags"
                        separator=" ,;"
                        placeholder="Digite as palavras chaves da loja"
                        class="mb-2"/>
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
        name: "GeneralForm",
        mixins: [FormMixin],
        data() {
            return {
                content: {},
                form: {
                    action: route('setting.store.update'),
                    method: 'put'
                }
            }
        },
        mounted() {
            this.edit();
        },
        methods: {
            edit() {
                this.request(route('setting.store.edit'), {
                    method: 'get',
                    onSuccess: ({data}) => {
                        this.content = data;
                    }
                });
            },
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

