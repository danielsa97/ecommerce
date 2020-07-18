<template>
    <div class="content-wrapper">
        <div class="container">
            <div class="content-header container-fluid text-gray">
                <h3>{{$route.meta.title}} / <small class="fs15">{{$route.meta.description}}</small></h3>
            </div>
            <b-card class="content">
                <transition name="slide-fade" mode="out-in">
                    <router-view/>
                </transition>
            </b-card>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Page"
    }
</script>
