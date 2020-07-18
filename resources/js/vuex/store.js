import {CHANGE_ECOMMERCE_INFORMATION} from "./mutation-types";

export default {
    state: {
        ecommerce: {}
    },
    getters: {
        getEcommerceInformation: state => {
            return state.ecommerce;
        }
    },
    mutations: {
        [CHANGE_ECOMMERCE_INFORMATION](state, n = {}) {
            state.ecommerce = n;
        }
    }
}
