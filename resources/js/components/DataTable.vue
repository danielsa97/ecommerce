<template>
    <div class="table-responsive">
        <table ref="datatable" :id="id" class="table table-bordered table-striped">
            <thead/>
        </table>
    </div>
</template>

<script>
    export default {
        name: "DataTable",
        props: {
            route: {
                type: String,
                required: true
            },
            id: {
                type: String,
                required: false
            }
        },
        mounted() {
            this.makeDataTable();
        },
        methods: {
            async makeDataTable() {
                let {data} = await axios.get(route(this.route));
                let table = $(this.$refs.datatable);
                table.DataTable(data).button().add(0, {
                    text: '<i class="fa fa-plus-circle"></i> Cadastrar',
                    className: 'btn btn-primary btn-sm',
                    action: () => this.$emit('create')
                });
                table.on("click", "tr[role='row']", evt => {
                    let {emit} = evt.target.dataset;
                    if (emit) {
                        this.$emit(emit, evt.target.dataset);
                    }
                });

            }
        }
    }
</script>

<style scoped>

</style>
