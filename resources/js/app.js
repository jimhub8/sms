require('./bootstrap');

require('alpinejs');


window.Vue = require('vue');

window.eventBus = new Vue()

import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/en'
import 'element-ui/lib/theme-chalk/index.css';
import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader
import vuetify from './vuetify'

import VueRouter from 'vue-router'

Vue.use(VueRouter)
Vue.use(ElementUI, { locale });


import myCallcenter from './components/callcenter'
import myRider from './components/riders'

import mySms from './components/sms'



const routes = [
    { path: '/', component: myCallcenter },
    { path: '/rider', component: myRider },
]
const router = new VueRouter({
    // mode: 'history',
    routes // short for `routes: routes`
})


const app = new Vue({
    el: '#app',
    // token: csrf_token,
    vuetify,
    router,
    components: {
        myCallcenter, myRider, mySms
    },
});
