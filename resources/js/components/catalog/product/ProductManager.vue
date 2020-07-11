<template>
    <div>
        <product-form ref="category_form" @save="dataTableRefresh"/>
        <data-table @create="$bvModal.show('product_modal')"
                    @edit="$refs.product_form.edit($event)"
                    @change-status="changeProductStatus"
                    :id="datatable"
                    route="catalog.product.index"/>
    </div>
</template>

<script>
    import ProductForm from "./form/ProductForm";
    import ChangeStatusMixin from "../../../mixins/ChangeStatusMixin";

    export default {
        name: "ProductManager",
        components: {ProductForm},
        mixins: [ChangeStatusMixin],
        data() {
            return {
                datatable: 'product_datatable',
            }
        },
        methods: {
            changeProductStatus({id}) {
                this.changeStatus(route('catalog.product.change-status', {id: id}), this.datatable);
            },
            dataTableRefresh() {
                $(`#${this.datatable}`).DataTable().ajax.reload();
            }
        }
    }
</script>
