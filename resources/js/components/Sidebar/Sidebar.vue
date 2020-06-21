<template>
    <ul class="nav nav-pills nav-sidebar flex-column"
        data-widget="treeview" role="menu" data-animation-speed="300">
        <menu-item v-for="(route, idx) in routes" :key="idx" :route="route"/>
    </ul>
</template>

<script>
    import MenuRouter from "../../vue-router/MenuRouter";
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
