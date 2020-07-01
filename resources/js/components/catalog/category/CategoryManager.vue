<template>
    <div>
        <category-form ref="category_form" @save="dataTableRefresh"/>
        <data-table @create="$bvModal.show('category_modal')"
                    @edit="$refs.category_form.edit($event)"
                    @change-status="changeCategoryStatus"
                    :id="datatable"
                    route="catalog.category.index"/>
    </div>
</template>

<script>
    import ChangeStatusMixin from "../../../mixins/ChangeStatusMixin";
    import CategoryForm from "./form/CategoryForm";

    export default {
        name: "CategoryManager",
        components: {CategoryForm},
        mixins: [ChangeStatusMixin],
        data() {
            return {
                datatable: 'category_datatable',
            }
        },
        methods: {
            changeCategoryStatus({id}) {
                this.changeStatus(route('catalog.category.change-status', {id: id}), this.datatable);
            },
            dataTableRefresh() {
                $(`#${this.datatable}`).DataTable().ajax.reload();
            }
        }
    }
</script>
