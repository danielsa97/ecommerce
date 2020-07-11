<template>
    <b-tabs content-class="mt-3">
        <b-tab title="Geral" active>
            <general-form ref="general"/>
        </b-tab>
        <b-tab title="Endereço e Contato">
            <address-and-contact-form ref="adress_and_contact"/>
        </b-tab>
    </b-tabs>
</template>

<script>
    import GeneralForm from "./form/GeneralForm";
    import AddressAndContactForm from "./form/AddressAndContactForm";

    export default {
        name: "EcommerceManager",
        components: {AddressAndContactForm, GeneralForm},
        async mounted() {
            const {data} = await axios.get(route('setting.ecommerce.index'));
            let {tags, name, description, brand, phones, favicon, mails, adresses} = data;
            this.$refs.general.content = {tags, name, description, favicon: favicon?.name, brand: brand?.name};
            this.$refs.adress_and_contact.content = {phones, mails, adresses};
            this.$forceUpdate();
        }
    }
</script>
