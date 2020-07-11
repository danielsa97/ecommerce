<template>
    <b-row>
        <b-col sm="3">
            <counter-card action="dashboard/setting/user"
                          label="Usuários do sistema"
                          name="user_system_counter"
                          icon="fa fa-user"/>
        </b-col>
        <b-col sm="3">
            <counter-card action="dashboard/catalog/department"
                          bg="bg-purple"
                          label="Departamentos"
                          name="department_counter"
                          icon="fa fa-archive"/>
        </b-col>
        <b-col sm="3">
            <counter-card action="dashboard/catalog/category"
                          bg="bg-gradient-success"
                          label="Categorias"
                          name="category_counter"
                          icon="fa fa-filter"/>
        </b-col>
        <b-col sm="3">
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
