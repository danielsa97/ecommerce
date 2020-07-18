<template>
    <aside class="main-sidebar vh-100 sidebar-dark-primary elevation-4">
        <a href="/"
           class="brand-link bg-white text-center">
            <small class="brand-text  font-weight-light">
                Loja
            </small>
        </a>
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

    export default {
        name: "Sidebar",
        components: {MenuItem},
        data() {
            return {
                routes: MenuRouter.toMenu()
            };
        }
    }
</script>
