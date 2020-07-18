<template>
    <div :class="['small-box', bg]">
        <div class="inner">
            <h3>{{counter}}</h3>
            <p>{{label}}</p>
        </div>
        <div class="icon">
            <i :class="icon"/>
        </div>
        <router-link :to="action" class="small-box-footer"> Acessar <i class="fas fa-arrow-circle-right"/></router-link>
    </div>
</template>

<script>
    export default {
        name: "CounterCard",
        props: {
            name: {
                type: String,
                required: true
            },
            label: {
                type: String,
                required: true
            },
            bg: {
                type: String,
                required: false,
                default: 'bg-primary'
            },
            action: {
                type: String,
                required: false,
                default: '#'
            },
            icon: {
                type: String,
                required: false,
                default: 'fa fa-plus'
            }
        },
        data() {
            return {
                counter: null
            };
        },
        mounted() {
            this.$http.get(route('widget.index', {name: this.name})).then(({data}) => {
                this.counter = data;
            });
        }
    }
</script>
