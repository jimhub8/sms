require('./bootstrap');

require('alpinejs');


window.Vue = require('vue');

window.eventBus = new Vue()

import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader
import vuetify from './vuetify'




import myTracking from './components/waybill/track'



const app = new Vue({
    el: '#track',
    // token: csrf_token,
    vuetify,
    components: {
        myTracking
    },
});
