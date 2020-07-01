<template>
    <b-tabs content-class="mt-3">
        <b-tab title="Geral" active>
            <GeneralForm/>
        </b-tab>
        <!--            <b-tab title="Pagamentos"><p>I'm the second tab</p></b-tab>-->
    </b-tabs>
</template>

<script>
    import GeneralForm from "./form/GeneralForm";

    export default {
        name: "StoreManager",
        components: {GeneralForm}
    }
</script>

<style scoped>

</style>
