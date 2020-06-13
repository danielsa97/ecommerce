<template>
  <b-modal
    size="xl"
    id="discount_modal"
    title="Gerenciar Descontos"
    @hidden="formReset"
    @ok.prevent="save"
    ok-title="Salvar"
    ok-only
  >
    <form ref="discount_form" data-action="/catalog/discount" data-method="post">
      <form-wizard color="#343a40" @on-complete="save">
        <tab-content title="Dados Iniciais">
          <form-group label="Voucher" :required="true">
            <b-form-input name="voucher" :value="content.voucher" />
          </form-group>
          <form-group label="Tipo">
            <b-form-select name="type" v-model="content.type" :options="types"></b-form-select>
          </form-group>
          <form-group label="Valor" :required="true">
            <money name="value" class="form-control" v-model="content.value" v-bind="valueMoney"></money>
          </form-group>
        </tab-content>
        <tab-content title="Periodo">
          <form-group label="Data Inicial" :required="true">
            <VueCtkDateTimePicker
              label="Selecione a Data e Hora"
              name="date_start"
              v-model="content.date_start"
            />
          </form-group>
          <form-group label="Data Final" :required="true">
            <VueCtkDateTimePicker
              name="date_finish"
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
              v-bind="money"
            ></money>
          </form-group>
          <form-group label="Valor Maxímo na Compra" :required="true">
            <money
              name="maximum_discount_amount"
              class="form-control"
              v-model="content.maximum_discount_amount"
              v-bind="money"
            ></money>
          </form-group>
          <form-group label="Prioridade" :required="true">
            <the-mask class="form-control" :mask="['###']" />
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
        </tab-content>
      </form-wizard>
    </form>
  </b-modal>
</template>

<script>
import FormMixin from "../../../mixins/FormMixin";
import ChangeStatusMixin from "../../../mixins/ChangeStatusMixin";
import DataTableButtonMixin from "../../../mixins/DataTableButtonMixin";

export default {
  name: "DiscountManager",
  props: {
    datatable: {
      type: String,
      required: false
    }
  },
  mixins: [FormMixin, ChangeStatusMixin, DataTableButtonMixin],
  data() {
    return {
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
        { value: "A", text: "Absoluto" },
        { value: "M", text: "Porcentagem" }
      ],
      options: {
        category: []
      }
    };
  },
  mounted() {
    if (this.datatable) {
      this.btnDataTableCreate(this.datatable, () => {
        this.$bvModal.show("discount_modal");
      });
      document
        .getElementById(this.datatable)
        .addEventListener("click", ({ target }) => {
          let { change_status, edit } = target.dataset;
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
    },
    get(id = undefined) {
      if (id) {
        this.request({
          method: "get",
          url: `/catalog/discount/${id}/edit`,
          onSuccess: async ({ data }) => {
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
          category_id: this.content.select.category?.code
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
    async productSearch(search, loading) {
      loading(true);
      let { data } = await axios.post(
        route("catalog.product.search") + `?search=${search}`,
        {
          product_id: this.product_id
        }
      );
      this.options.category = data;
      loading(false);
    },
    async categorySearch(search, loading) {
      loading(true);
      let { data } = await axios.post(
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
    "content.type": function(newVal, oldVal) {
      if (newVal == "A") {
        this.valueMoney.prefix = "R$ ";
      } else {
        this.valueMoney.prefix = "% ";
      }
    }
  }
};
</script>
