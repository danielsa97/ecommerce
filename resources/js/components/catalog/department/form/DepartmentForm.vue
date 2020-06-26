<template>
    <b-modal id="department_modal"
             title="Gerenciar Departamento"
             @ok.prevent="save"
             @hidden="reset"
             ok-title="Salvar"
             ok-only>
        <form ref="department_form">
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
    import FormMixin from "../../../../mixins/FormMixin";

    export default {
        name: "DepartmentForm",
        mixins: [FormMixin],
        data() {
            return {
                content: {},
                form: {
                    action: route('catalog.department.store'),
                    method: 'post'
                }
            };
        },
        methods: {
            edit({id}) {
                this.request(route('catalog.department.edit', {id: id}), {
                    method: 'get',
                    onSuccess: ({data}) => {
                        this.content = data;
                        this.form.action = route('catalog.department.update', {id: id});
                        this.form.method = 'put';
                        this.$bvModal.show('department_modal');
                    }
                });
            },
            save() {
                this.request(this.form.action, {
                    method: this.form.method,
                    data: new FormData(this.$refs['department_form']),
                    toast: true,
                    onSuccess: () => {
                        this.$bvModal.hide('department_modal');
                        this.$emit('save');
                    },
                    onError: (error) => this.showErrors(error)
                });
            }
        }
    }
</script>
