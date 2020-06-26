export default {
    methods: {
        changeStatus(url, datatableId = null, options = {}) {
            this.$toast.question("Deseja alterar o status?", 'Alerta', {
                buttons: [
                    ['<button>Sim</button>', (instance, toast) => {
                        instance.hide({transitionOut: 'fadeOut'}, toast, 'button');
                        axios(url, {method: 'put', ...options}).then(() => {
                            if (datatableId) {
                                $(`#${datatableId}`).DataTable().ajax.reload();
                            }
                        }).catch(error => {
                            this.$toast.error(error.response.data?.message ?? "Falha na solicitação");
                        });
                    }, true],
                    ['<button>Não</button>', function (instance, toast) {
                        instance.hide({transitionOut: 'fadeOut'}, toast, 'button');
                    }],
                ]
            });
        }
    }
};
