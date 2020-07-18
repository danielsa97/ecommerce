<template>
    <div>
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
        components: {Navbar, Sidebar, Page}
    }
</script>
