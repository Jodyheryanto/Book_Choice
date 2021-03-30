import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import App from './App.vue'
import router from './router'
import store from './store'
import VCalendar from 'v-calendar'
import { EventBus } from './utils/eventbus'
import VueJsModal from 'vue-js-modal'
import VueIziToast from 'vue-izitoast'
import "izitoast/dist/css/iziToast.css"
import VueMq from 'vue-mq'
import Vuesax from 'vuesax'
import 'vuesax/dist/vuesax.css' //Vuesax styles

Vue.use(Vuesax)
var VueCookie = require('vue-cookie');
Vue.use(VueCookie);

Vue.use(VueMq, {
  breakpoints: {
    mobile: 450,
    tablet: 900,
    laptop: 1250,
    desktop: Infinity,
  }
})

Vue.config.productionTip = false

Vue.use(VueJsModal, {
  dialog: true,
  dynamic: true,
  dynamicDefaults: {
    foo: 'foo'
  }
})

Vue.use(VueIziToast);

// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

Vue.use(VCalendar, {
  componentPrefix: 'vc'
});

Vue.prototype.$eventBus = EventBus;

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
