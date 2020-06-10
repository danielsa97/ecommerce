const FormMixin = {
    methods: {
        async request(options = {}) {
            try {
                let method = options.method || 'post';
                options.method = ['post', 'get'].includes(method.toLowerCase()) ? method : 'post';
                if (options.data instanceof FormData) {
                    options.data.append('_method', method);
                    Object.entries(options.appends ?? {}).forEach(item => {
                        options.data.append(item[0], item[1] ?? '');
                    });
                } else {
                    options.data = Object.assign({_method: method}, options.data);
                }
                const response = await axios(options);
                if (options.toastAlert !== false) {
                    this.$toast.success(response?.data?.message ?? "Solicitação realizada");
                }
                if (options.onSuccess) options.onSuccess(response);
            } catch (error) {
                if (options.onError) options.onError(error);
                if (options.toastAlert !== false) this.$toast.error(error.response.data.message ?? "Falha na solicitação");
            }
        },
        showErrors(errors, form = null) {
            Object.entries(errors).forEach(error => {
                let legend, errorElement;
                legend = (form || document).querySelector(`[data-legend=${error[0]}]`);
                errorElement = (form || document).querySelector(`[data-error=${error[0]}]`);
                if (legend) legend.classList.add('text-danger');
                if (errorElement) errorElement.innerHTML = error[1];
            });
        }
    }
};
export default FormMixin;
