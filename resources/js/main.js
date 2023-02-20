/* eslint-disable import/order */
import '@/@iconify/icons-bundle'
import App from '@/App.vue'
import layoutsPlugin from '@/plugins/layouts'
import vuetify from '@/plugins/vuetify'
import { loadFonts } from '@/plugins/webfontloader'
import router from '@/router'
// eslint-disable-next-line import/no-unresolved
import '@core-scss/template/index.scss'
import '@styles/styles.scss'
import { createPinia } from 'pinia'
import { createApp } from 'vue'

// make jw pagination component available in application
import JwPagination from 'jw-vue-pagination'
import { Vue } from "vue-class-component"

Vue.component = function (jwPagination, JwPagination) {
  
}
Vue.component('jw-pagination', JwPagination)

loadFonts()


// Create vue app
const app = createApp(App)


// Use plugins
app.use(vuetify)
app.use(createPinia())
app.use(router)
app.use(layoutsPlugin)

// Mount vue app
app.mount('#app')

new Vue({
  el: "#app",
  // eslint-disable-next-line vue/component-api-style
  render: h => h(App),
})
