<template>
    <select :name="name" :multiple="multiple" aria-label="select2" ref="select2"/>
</template>

<script>
    export default {
        name: "Select2",
        props: {
            value: {
                required: false
            },
            multiple: {
                type: String,
                required: false,
                default: null
            },
            params: {
                type: Object,
                required: false,
                default: () => ({})
            },
            placeholder: {
                type: String,
                required: false,
                default: 'Selecione'
            },
            url: {
                type: String,
                required: true
            },
            name: {
                type: String,
                required: true
            },
        },
        mounted() {
            $(this.$refs.select2).select2({
                width: '100%',
                delay: 250,
                dropdownParent: $(this.$refs.select2).parent(), //Correção Pesquisar quando em modal bootstrap
                theme: 'bootstrap4',
                multiple: this.multiple,
                placeholder: this.placeholder,
                allowClear: true,
                ajax: {
                    url: this.url,
                    dataType: 'json',
                    data: params => ({
                        search: params.term,
                        ...this.params
                    })
                }
            });
        }
    }
</script>
