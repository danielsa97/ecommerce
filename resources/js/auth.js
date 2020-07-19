import bearer from '@websanova/vue-auth/drivers/auth/bearer'
import axios from '@websanova/vue-auth/drivers/http/axios.1.x'
import router from '@websanova/vue-auth/drivers/router/vue-router.2.x'

require('./assets/js-routes');

export default {
    auth: bearer,
    http: axios,
    router: router,
    tokenDefaultName: 'auth-id',
    tokenStore: ['localStorage'],
    rolesVar: 'role',
    // registerData: {url: 'auth/register', method: 'POST', redirect: '/login'},
    loginData: {url: route('auth.login'), method: 'POST', redirect: '/dashboard', fetchUser: true},
    logoutData: {url: route('auth.logout'), method: 'POST', redirect: '/login', makeRequest: true},
    fetchData: {url: route('auth.user'), method: 'GET', enabled: true},
    refreshData: {url: route('auth.refresh'), method: 'GET', enabled: true, interval: 30}
};
