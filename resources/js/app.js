require('./bootstrap');

require('alpinejs');


window.Vue = require('vue');

window.eventBus = new Vue()

import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/en'
import 'element-ui/lib/theme-chalk/index.css';
import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader
import vuetify from './vuetify'
import store from './vuex'

import VueRouter from 'vue-router'

Vue.use(VueRouter)
Vue.use(ElementUI, { locale });


import myUsers from './components/users/users'

import myCallcenter from './components/callcenter'
import myRider from './components/riders'

import mySms from './components/sms'
import mySmsMult from './components/sms/multiple.vue'


import myApp from './components/agents'
import myHeader from './components/inc/Header'


import myAgents from './components/agents/account'
import myProducts from './components/agents/product'
import myStock from './components/agents/stock'
import myvendors from './components/agents/vendor'
import myRiders from './components/agents/rider'

import myTracking from './components/waybill/track'



const routes = [
    { path: '/', component: myCallcenter },
    { path: '/users', component: myUsers },
    { path: '/rider', component: myRider },
    { path: '/agents', component: myAgents },
    { path: '/products', component: myProducts },
    { path: '/stock', component: myStock },
    { path: '/vendors', component: myvendors },

    { path: '/sms', component: mySmsMult },
    { path: '/riders', component: myRiders },

]
const router = new VueRouter({
    // mode: 'history',
    routes // short for `routes: routes`
})


const app = new Vue({
    el: '#app',
    // token: csrf_token,
    store,
    vuetify,
    router,
    components: {
        myApp, myHeader,
        myCallcenter, myRider, mySms, myAgents, myProducts, myStock, myvendors, mySmsMult, myRiders,myTracking
    },
});
