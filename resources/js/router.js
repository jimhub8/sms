import Vue from 'vue'
import VueRouter from 'vue-router'


Vue.use(VueRouter)

import myCall from './components/calls'

// import myCallList from './components/calls/incoming'

const routes = [
    { path: '/', component: myCall, name: 'call' },
    // { path: '/calllist', component: myCallList, name: 'callList' },
]



export default new VueRouter({routes})
