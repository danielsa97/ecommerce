<template>
    <div class="content-wrapper">
        <div class="container">
            <div class="content-header container-fluid text-gray">
                <h3>{{title}} / <small class="fs15">{{description}}</small></h3>
            </div>
            <b-card class="content">
                <slot/>
            </b-card>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Page",
        props: {
            title: {
                type: String,
                required: true
            },
            description: {
                type: String,
                required: true
            }
        }
    }
</script>

<style scoped>
    .fs15 {
        font-size: 15px;
    }
</style>
