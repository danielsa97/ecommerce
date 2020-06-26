<template>
    <b-modal
        size="xl"
        id="discount_modal"
        title="Gerenciar Descontos"
        @show="$refs.wizard.reset()"
        @hidden="reset"
        hide-footer
        static>
        <form ref="discount_form">
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
                        <b-row>
                            <b-col cols="10">
                                <v-select
                                    multiple
                                    v-model="content.select.category"
                                    :options="options.category"
                                    @search="categorySearch"
                                />
                            </b-col>
                            <b-col cols="2">
                                <b-button variant="primary" v-b-tooltip="'Novo'" size="sm" block
                                          v-b-modal.category_modal>
                                    <i class="fa fa-plus"/>
                                </b-button>
                            </b-col>
                        </b-row>
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
                                :toggle-all="true"/>
                        </div>
                    </form-group>
                </tab-content>
            </form-wizard>
        </form>
        <category-form/>
    </b-modal>
</template>

<script>
    import FormMixin from "../../../../mixins/FormMixin";
    import CategoryForm from "../../category/form/CategoryForm";

    export default {
        name: "DiscountForm",
        components: {CategoryForm},
        mixins: [FormMixin],
        data() {
            return {
                form: {
                    action: route('catalog.discount.store'),
                    method: 'post'
                },
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
        methods: {
            edit({id}) {
                this.request(route('catalog.discount.edit', {id: id}), {
                    method: 'get',
                    onSuccess: ({data}) => {
                        this.content = data;
                        this.form.action = route('catalog.discount.update', {id: id});
                        this.form.method = 'put';
                        this.$bvModal.show('discount_modal');
                    }
                });
            },
            save() {
                let form = new FormData(this.$refs['discount_form']);
                form.set('category_id', this.content.select.category?.code ?? '');
                form.set('date_start', this.content.date_start ?? '');
                form.set('date_finish', this.content.date_finish ?? '');

                this.request(this.form.action, {
                    method: this.form.method,
                    data: form,
                    toast: true,
                    onSuccess: () => {
                        this.$bvModal.hide('discount_modal');
                        this.$emit('save');
                    },
                    onError: (error) => this.showErrors(error)
                });
            },
            async categorySearch(search, loading) {
                loading(true);
                let {data} = await axios.post(route("catalog.category.search") + `?search=${search}`, {
                    category_id: this.category_id
                });
                this.options.category = data;
                loading(false);
            }
        },
        watch: {
            "content.type": function (newVal) {
                if (newVal == "A") {
                    this.valueMoney.prefix = "R$ ";
                } else {
                    this.valueMoney.prefix = "% ";
                }
            }
        }
    }
</script>
