<template>
    <aside class="main-sidebar vh-100 sidebar-dark-primary elevation-4">
        <router-link to="/dashboard" class="brand-link">
            <img :src="brand" v-if="brand" alt="Logo" class="brand-image img-circle elevation-3">
            <span class="brand-text font-weight-light">{{getEcommerceInformation.name}}</span>
        </router-link>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column"
                    data-widget="treeview" role="menu" data-animation-speed="300">
                    <menu-item v-for="(route, idx) in routes" :key="idx" :route="route"/>
                </ul>
            </nav>
        </div>
    </aside>

</template>

<script>
    import MenuRouter from "../vue-router/MenuRouter";
    import MenuItem from "./MenuItem";
    import {mapGetters} from 'vuex';

    export default {
        name: "Sidebar",
        components: {MenuItem},
        data() {
            return {
                routes: MenuRouter.toMenu()
            };
        },
        mounted() {

        },
        computed: {
            ...mapGetters(['getEcommerceInformation']),
            brand() {
                let image = this.getEcommerceInformation?.favicon?.name;
                return image ? route('public.image.index', {image}) : null;
            }
        },
    }
</script>
