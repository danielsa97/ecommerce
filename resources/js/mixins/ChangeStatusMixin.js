export default {
    methods: {
        changeStatus(url, datatableId = null, data = {}) {
            this.$toast.question("Deseja alterar o status?", 'Alerta', {
                buttons: [
                    ['<button>Sim</button>', (instance, toast) => {
                        instance.hide({transitionOut: 'fadeOut'}, toast, 'button');
                        let request = {
                            url: url,
                            method: 'put',
                            toastAlert: false,
                            onSuccess: () => {
                                if (datatableId) {
                                    $(`#${datatableId}`).DataTable().ajax.reload();
                                }
                                this.$toast.success("Status alterado", "Sucesso");
                            },
                            onError: (error) => {
                                this.$toast.error(error?.response?.data?.message || "Falha na solicitação");
                            }
                        };
                        this.request(Object.assign({data: data}, request));
                    }, true],
                    ['<button>Não</button>', function (instance, toast) {
                        instance.hide({transitionOut: 'fadeOut'}, toast, 'button');
                    }],
                ]
            });
        }
    }
};
