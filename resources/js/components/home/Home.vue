<template>
    <b-row class="d-sm-flex justify-content-center">
        <b-col sm="2">
            <counter-card action="dashboard/setting/user"
                          label="Usuários"
                          name="user_counter"
                          icon="fa fa-user"/>
        </b-col>
        <b-col sm="2">
            <counter-card action="dashboard/setting/user"
                          label="Clientes"
                          bg="bg-teal"
                          name="customer_counter"
                          icon="fa fa-users"/>
        </b-col>
        <b-col sm="2">
            <counter-card action="dashboard/catalog/department"
                          bg="bg-purple"
                          label="Departamentos"
                          name="department_counter"
                          icon="fa fa-archive"/>
        </b-col>
        <b-col sm="2">
            <counter-card action="dashboard/catalog/category"
                          bg="bg-gradient-success"
                          label="Categorias"
                          name="category_counter"
                          icon="fa fa-filter"/>
        </b-col>
        <b-col sm="2">
            <counter-card action="dashboard/catalog/brand"
                          bg="bg-gradient-danger"
                          label="Marcas"
                          name="brand_counter"
                          icon="fa fa-copyright"/>
        </b-col>
    </b-row>
</template>

<script>
    import CounterCard from "./widgets/CounterCard";

    export default {
        name: "Home",
        components: {CounterCard},
    }
</script>
