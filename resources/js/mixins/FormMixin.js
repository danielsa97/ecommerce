const FormMixin = {
    methods: {
        reset() {
            Object.assign(this.$data, this.$options.data.apply(this));
        },
        request(url, options = {}) {
            let method = (options.method || (options.data instanceof FormData && options?.data?.method ? options.data.method : 'post')).toLowerCase();
            options = Object.assign({data: {}}, options);
            options.url = url;
            options.method = ['post', 'get'].includes(method) ? method : 'post';
            if (options.data instanceof FormData) options.data.set('_method', method);
            else options.data._method = method;

            this.$http(options).then(response => {
                if (options.toast) this.$toast.success(response.data?.message ?? "Solicitação realizada");
                if (options.onSuccess) options.onSuccess(response);
            }).catch(error => {
                if (options.onError) options.onError(error);
                if (options.toast) this.$toast.error(error.response.data?.message ?? "Falha na solicitação");
            });
        },
        showErrors(error, form = null) {
            if (error?.response?.status === 422) {
                Object.entries(error.response.data.errors).forEach(error => {
                    let legend, errorElement;
                    legend = (form || document).querySelector(`[data-legend=${error[0]}]`);
                    errorElement = (form || document).querySelector(`[data-error=${error[0]}]`);
                    if (legend) legend.classList.add('text-danger');
                    if (errorElement) errorElement.innerHTML = error[1];
                });
            } else if (error?.response?.status === 401) {
                this.$toast.error("Sem autorização");
            }
        }
    }
};
export default FormMixin;
