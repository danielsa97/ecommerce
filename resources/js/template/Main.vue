<template>
    <container v-if="allowDashboard"/>
    <router-view v-else/>
</template>
<script>
    import {mapGetters} from 'vuex';
    import Container from "./Container";

    export default {
        name: "Main",
        components: {Container},
        async mounted() {
            const {data} = await axios.get(route('public.ecommerce.info'));
            this.$store.commit('CHANGE_ECOMMERCE_INFORMATION', data);
        },
        computed: {
            ...mapGetters(['getEcommerceInformation']),
            allowDashboard() {
                return this.$auth.check() && !['404'].includes(this.$route.name)
            }
        },
        watch: {
            getEcommerceInformation: {
                deep: true,
                handler(value) {
                    if (value.favicon) {
                        let link = document.createElement('link');
                        link.rel = 'shortcut icon';
                        link.href = route('public.image.index', {image: value?.favicon?.name});
                        document.head.appendChild(link);
                    }
                    document.title = value?.name ?? document.title;
                }
            }
        }
    }
</script>
