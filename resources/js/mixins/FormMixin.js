const FormMixin = {
    methods: {
        async request(options = {}) {
            try {
                let method = options.method || 'post';
                options.method = ['post', 'get'].includes(method.toLowerCase()) ? method : 'post';
                if (options.data instanceof FormData) {
                    options.data.append('_method', method);
                } else {
                    options.data = Object.assign({_method: method}, options.data);
                }

                const response = await axios(options);
                if (options.toastAlert !== false) {
                    this.$toast.success(response?.data?.message ?? "Solicitação realizada");
                }
                if (options.onSuccess) options.onSuccess(response);
            } catch (error) {
                if (options.toastAlert !== false) {
                    this.$toast.error(error?.response?.data?.message ?? error?.response?.data ?? "Falha na solicitação");
                }
                if (options.onError) options.onError(error);
            }
        }
    }
};
export default FormMixin;
