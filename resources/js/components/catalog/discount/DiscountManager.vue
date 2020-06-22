<template>
    <page title="Descontos" descripition="Gerencie os descontos da loja">
        <b-modal
            size="xl"
            id="discount_modal"
            title="Gerenciar Descontos"
            @hidden="formReset"
            @show="showModal"
            hide-footer
            static>
            <form ref="discount_form" data-action="/catalog/discount" data-method="post">
                <form-wizard
                    finishButtonText='Finalizar'
                    backButtonText='Voltar'
                    nextButtonText='Proxímo'
                    subtitle=''
                    title=''
                    ref="wizard"
                    :start-index="0"
                    color="#343a40"
                    @on-complete="save">
                    <tab-content title="Dados Iniciais">
                        <form-group label="Nome" :required="true">
                            <b-form-input name="name" :value="content.name"/>
                        </form-group>
                        <form-group label="Voucher">
                            <b-form-input name="voucher" :value="content.voucher"/>
                        </form-group>
                        <form-group label="Tipo" :required="true">
                            <b-form-select name="type" v-model="content.type" :options="types"/>
                        </form-group>
                        <form-group label="Valor" :required="true">
                            <money name="value" class="form-control" v-model="content.value" v-bind="valueMoney"/>
                        </form-group>
                        <form-group label="Descrição">
                            <b-form-textarea name="description" :value="content.description"/>
                        </form-group>
                    </tab-content>
                    <tab-content title="Periodo">
                        <form-group label="Data Inicial" :required="true">
                            <VueCtkDateTimePicker
                                format="YYYY-MM-DD HH:mm"
                                v-model="content.date_start"
                                label="Selecione a Data e Hora"
                            />
                        </form-group>
                        <form-group label="Data Final" :required="true">
                            <VueCtkDateTimePicker
                                format="YYYY-MM-DD HH:mm"
                                v-model="content.date_finish"
                                label="Selecione a Data e Hora"
                            />
                        </form-group>
                    </tab-content>
                    <tab-content title="Regras">
                        <form-group label="Valor Mínimo na Compra" :required="true">
                            <money
                                name="minimum_order_value"
                                class="form-control"
                                v-model="content.minimum_order_value"
                                v-bind="money"/>
                        </form-group>
                        <form-group label="Valor Maxímo na Compra" :required="true">
                            <money
                                name="maximum_discount_amount"
                                class="form-control"
                                v-model="content.maximum_discount_amount"
                                v-bind="money"/>
                        </form-group>
                        <form-group label="Quantidade Mínima na Compa">
                            <the-mask
                                name="quantity_minimum"
                                v-model="content.quantity_minimum"
                                class="form-control"
                                :mask="['####']"
                            />
                        </form-group>
                        <form-group label="Quantidade Máxima na Compra">
                            <the-mask
                                name="quantity_maximum"
                                v-model="content.quantity_maximum"
                                class="form-control"
                                :mask="['####']"
                            />
                        </form-group>
                    </tab-content>
                    <tab-content>
                        <form-group label="Categorias">
                            <v-select
                                multiple
                                v-model="content.select.category"
                                :options="options.category"
                                @search="categorySearch"
                            />
                        </form-group>
                        <form-group label="Produtos/Skus">
                            <div class="ex-lib">
                                <vue-select-sides
                                    placeholder-search-right="Skus"
                                    placeholder-search-left="Produtos"
                                    type="grouped"
                                    order-by="asc"
                                    v-model="selected"
                                    :list="list"
                                    :sort-selected-up="sortSelectedUp"
                                    :search="true"
                                    :total="true"
                                    :toggle-all="true"
                                ></vue-select-sides>
                            </div>
                        </form-group>
                    </tab-content>
                </form-wizard>
            </form>
        </b-modal>
        <data-table @create="$bvModal.show('discount_modal')"
                    @edit="edit"
                    @change-status="changeStatusDiscount"
                    :id="datatable"
                    route="datatable.catalog.department"/>
    </page>
</template>

<script>
    import FormMixin from "../../../mixins/FormMixin";
    import ChangeStatusMixin from "../../../mixins/ChangeStatusMixin";

    export default {
        name: "DiscountManager",
        mixins: [FormMixin, ChangeStatusMixin],
        data() {
            return {
                datatable: 'discount_datatable',
                sortSelectedUp: true,
                product_id: null,
                category_id: null,
                content: {
                    select: {}
                },
                price: 0,
                money: {
                    decimal: ",",
                    thousands: ".",
                    prefix: "R$ ",
                    suffix: "",
                    precision: 2,
                    masked: false
                },
                valueMoney: {
                    decimal: ",",
                    thousands: ".",
                    prefix: "R$ ",
                    suffix: "",
                    precision: 2,
                    masked: false
                },
                selected: null,
                types: [
                    {value: "A", text: "Absoluto"},
                    {value: "M", text: "Porcentagem"}
                ],
                options: {
                    category: []
                },
                selected: {},
                list: [
                    {
                        value: "sul",
                        label: "Sul",
                        children: [
                            {
                                value: "santa-catarina",
                                label: "Santa Catarina"
                            }
                        ]
                    },
                    {
                        value: "sudeste",
                        label: "Sudeste",
                        children: [
                            {
                                value: "minas-gerais",
                                label: "Minas Gerais"
                            }
                        ]
                    }
                ]
            };
        },
        mounted() {
            if (this.datatable) {
                this.btnDataTableCreate(this.datatable, () => {
                    this.$bvModal.show("");
                });
                document
                    .getElementById(this.datatable)
                    .addEventListener("click", ({target}) => {
                        let {change_status, edit} = target.dataset;
                        this.get(edit);
                        this.changeStatus(
                            change_status,
                            `/catalog/discount/${change_status}/change-status`,
                            this.datatable
                        );
                    });
            }
        },
        methods: {
            formReset() {
                this.content = {};
                this.$refs.wizard.reset();
            },
            showModal() {
                this.$refs.wizard.reset();
            },
            changeStatusDiscount({id}) {
                this.changeStatus(route('catalog.discount.change-status', {id: id}), this.datatable);
            },
            edit({id}) {
                if (id) {
                    this.request({
                        method: "get",
                        url: `/catalog/discount/${id}/edit`,
                        onSuccess: async ({data}) => {
                            this.content = data;
                            await this.$bvModal.show("discount_modal");
                            this.$refs[
                                "discount_form"
                                ].dataset.action = `/catalog/discount/${id}`;
                            this.$refs["discount_form"].dataset.method = "put";
                        },
                        toastAlert: false
                    });
                }
            },
            save() {
                let form = this.$refs["discount_form"];
                this.request({
                    url: form.dataset.action,
                    method: form.dataset.method,
                    appends: {
                        category_id: this.content.select.category?.code,
                        date_start: this.content.date_start ?? null,
                        date_finish: this.content.date_finish ?? null
                    },
                    data: new FormData(form),
                    onSuccess: () => {
                        if (this.datatable) {
                            $(`#${this.datatable}`)
                                .DataTable()
                                .ajax.reload();
                        }
                        this.$bvModal.hide("discount_modal");
                    },
                    onError: error => {
                        if (error.response.status === 422) {
                            this.showErrors(error.response.data.errors);
                        }
                    }
                });
            },
            async categorySearch(search, loading) {
                loading(true);
                let {data} = await axios.post(
                    route("catalog.category.search") + `?search=${search}`,
                    {
                        category_id: this.category_id
                    }
                );
                this.options.category = data;
                loading(false);
            }
        },
        watch: {
            "content.type": function (newVal, oldVal) {
                if (newVal == "A") {
                    this.valueMoney.prefix = "R$ ";
                } else {
                    this.valueMoney.prefix = "% ";
                }
            }
        }
    };
</script>
