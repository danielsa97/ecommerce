<template>
    <aside class="main-sidebar vh-100 sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link text-center">
            <img v-if="brand" :src="brand" alt="Logo" class="brand-image img-circle elevation-3">
            <span class="brand-text font-weight-light">{{getEcommerceInformation.name}}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column"
                    data-widget="treeview" role="menu" data-animation-speed="300">
                    <menu-item v-for="(route, idx) in routes" :key="idx" :route="route"/>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script>
    import MenuRouter from "../../vue-router/MenuRouter";
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
