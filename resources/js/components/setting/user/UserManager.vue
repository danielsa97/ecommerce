<template>
    <div>
        <user-form ref="user_form" @save="dataTableRefresh"/>
        <data-table @create="$bvModal.show('user_modal')"
                    @edit="$refs.user_form.edit($event)"
                    @change-status="changeUserStatus"
                    :id="datatable"
                    route="setting.user.index"/>
    </div>
</template>

<script>
    import ChangeStatusMixin from "../../../mixins/ChangeStatusMixin";
    import UserForm from "./form/UserForm";

    export default {
        name: "UserManager",
        components: {UserForm},
        mixins: [ChangeStatusMixin],
        data() {
            return {
                datatable: 'user_datatable'
            }
        },
        methods: {
            changeUserStatus({id}) {
                this.changeStatus(route('setting.user.change-status', {id: id}), this.datatable);
            },
            dataTableRefresh() {
                $(`#${this.datatable}`).DataTable().ajax.reload();
            }
        }
    }
</script>
