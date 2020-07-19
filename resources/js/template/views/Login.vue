<template>
    <b-container :fluid="true">
        <b-row>
            <b-col cols="12" md="8"
                   class="vh-100 bg-dark text-center d-none d-md-flex align-items-center justify-content-center">
                <img v-if="brand" alt="Brand" class="img-fluid brand w-25 bg-white p-2 rounded" :src="brand">
            </b-col>
            <b-col cols="12" md="4" class="p-5 bg-light  vh-100">
                <h4><i class="fa fa-lock"/> Iniciar sessão</h4>
                <form-group label="E-mail" :required="true">
                    <b-form-input type="email" v-model="email" name="email" placeholder="mail@gmail.com" autofocus/>
                </form-group>
                <form-group label="Senha" :required="true">
                    <b-form-input type="password" v-model="password" name="password" placeholder="******"/>
                </form-group>
                <b-form-group class="text-right">
                    <b-button type="button" @click.prevent="login" variant="primary">
                        LOGIN <i class="fa fa-arrow-right"/>
                    </b-button>
                </b-form-group>
            </b-col>

        </b-row>
    </b-container>
</template>

<script>
    import FormMixin from "../../mixins/FormMixin";
    import {mapGetters} from 'vuex';

    export default {
        name: "Login",
        mixins: [FormMixin],
        data() {
            return {
                email: null,
                password: null
            }
        },
        computed: {
            ...mapGetters(['getEcommerceInformation']),
            brand() {
                let image = this.getEcommerceInformation?.brand?.name;
                return image ? route('public.image.index', {image}) : null;
            }
        },
        methods: {
            login() {
                this.$auth.login({
                    data: {
                        email: this.email,
                        password: this.password
                    },
                    error: (e) => {
                        this.showErrors(e)
                    },
                    rememberMe: true,
                    fetchUser: true
                })
            }
        }
    }
</script>
<style scoped>
    .brand {
        animation: start 600ms;
    }

    @keyframes start {
        0% {
            margin-top: 100px;
        }
        100% {
            margin-top: 0;
        }
    }
</style>
