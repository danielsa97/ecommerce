<template>
    <page title="Descontos" description="Gerencie os descontos da loja">
        <discount-form ref="discount_form" @save="dataTableRefresh"/>
        <data-table @create="$bvModal.show('discount_modal')"
                    @edit="$refs.discount_form.edit($event)"
                    @change-status="changeDiscountStatus"
                    :id="datatable"
                    route="catalog.discount.index"/>
    </page>
</template>

<script>
    import ChangeStatusMixin from "../../../mixins/ChangeStatusMixin";
    import DiscountForm from "./form/DiscountForm";

    export default {
        name: "DiscountManager",
        mixins: [ChangeStatusMixin],
        data() {
            return {
                datatable: 'discount_datatable'
            }
        },
        components: {DiscountForm},
        methods: {
            changeDiscountStatus({id}) {
                this.changeStatus(route('catalog.discount.change-status', {id: id}), this.datatable);
            },
            dataTableRefresh() {
                $(`#${this.datatable}`).DataTable().ajax.reload();
            }
        }
    };
</script>
