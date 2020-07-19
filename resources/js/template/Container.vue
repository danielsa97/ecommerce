<template>
    <div class="wrapper">
        <navbar/>
        <sidebar/>
        <page/>
    </div>
</template>

<script>
    import Navbar from "./Navbar";
    import Sidebar from "./Sidebar";
    import Page from "./Page";

    export default {
        name: "Container",
        components: {Page, Sidebar, Navbar},
        mounted() {
            //BugFix to adminLte Treeview
            $('[data-widget="treeview"]').each(() => {
                AdminLte.Treeview._jQueryInterface.call($(this), 'init');
            });
        }
    }
</script>
