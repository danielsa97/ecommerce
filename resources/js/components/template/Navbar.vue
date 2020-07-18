<template>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"/>
                </a>
            </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item">
                <a class="nav-link" href="#" @click.prevent="logout">
                    <i class="fa fa-fw fa-power-off"/> Sair
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        name: "Navbar",
        methods: {
            logout() {
                this.$auth.logout();
            }
        }
    }
</script>
