<template>
    <div class="pt-5 vh-100 text-center bg-404">
        <h1 class=" icon text-black-50">4<i class="fa fa-ban"/>4</h1>
        <br>
        <span class="fs15 text-uppercase font-weight-bold">Page not found!</span>
    </div>
</template>

<script>
    export default {
        name: "Error404"
    }
</script>

<style scoped>
    .icon {
        font-size: 250px;
    }

    .bg-404 {
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #6190E8, #A7BFE8);
        background-size: 400% 400%;
        animation: gradient 20s ease infinite;
    }

    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }
</style>
