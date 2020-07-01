<template>
    <div>
        <brand-form ref="brand_form" @save="dataTableRefresh"/>
        <data-table @create="$bvModal.show('brand_modal')"
                    @edit="$refs.brand_form.edit($event)"
                    @change-status="changeBrandStatus"
                    :id="datatable"
                    route="catalog.brand.index"/>
    </div>
</template>

<script>
    import ChangeStatusMixin from "../../../mixins/ChangeStatusMixin";
    import BrandForm from "./form/BrandForm";

    export default {
        name: "BrandManager",
        components: {BrandForm},
        mixins: [ChangeStatusMixin],
        data() {
            return {
                datatable: 'brand_datatable'
            }
        },
        mounted() {
            console.log(this.$route)
        },
        methods: {
            changeBrandStatus({id}) {
                this.changeStatus(route('catalog.brand.change-status', {id: id}), this.datatable);
            },
            dataTableRefresh() {
                $(`#${this.datatable}`).DataTable().ajax.reload();
            }
        }
    }
</script>
