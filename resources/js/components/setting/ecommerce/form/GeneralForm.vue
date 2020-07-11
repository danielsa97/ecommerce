<template>
    <form @submit.prevent="save" enctype="multipart/form-data">
        <b-row>
            <b-col cols="12" md="6">
                <form-group label="Nome da Loja" :required="true">
                    <b-form-input name="name" :value="content.name"/>
                </form-group>
                <form-group label="Descrição">
                    <b-form-textarea name="description" :value="content.description"/>
                </form-group>
                <form-group label="Palavras chaves"
                            tooltip="Essas palavras ajudam a encontrar o site da loja nos motores de busca(Google, Bing)">
                    <b-form-tags
                        v-model="content.tags"
                        name="tags[]"
                        separator=" ,;"
                        placeholder="Digite as palavras chaves da loja"
                        class="mb-2"/>
                </form-group>
            </b-col>
            <b-col cols="12" md="6">
                <b-row>
                    <b-col cols="12" md="8">
                        <form-group label="Logomarca">
                            <input-image v-model="content.brand"/>
                        </form-group>
                    </b-col>
                    <b-col cols="12" md="4">
                        <form-group label="Favicon">
                            <input-image v-model="content.favicon"/>
                        </form-group>
                    </b-col>
                </b-row>
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
                    action: route('setting.ecommerce.update-general'),
                    method: 'put'
                }
            }
        },
        methods: {
            save({target}) {
                let form = new FormData(target);
                form.set('brand', this.content.brand ?? '');
                form.set('favicon', this.content.favicon ?? '');
                this.request(this.form.action, {
                    method: this.form.method,
                    data: form,
                    toast: true,
                    onError: (error) => this.showErrors(error)
                });
            }
        }

    }
</script>

