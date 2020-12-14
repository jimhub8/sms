import Vue from 'vue'
import Vuetify from 'vuetify'
import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader

Vue.use(Vuetify)

const opts = {
    // theme: { dark: true },
    icons: {
        iconfont: 'mdi', // default - only for display purposes
      },
}

export default new Vuetify(opts)
