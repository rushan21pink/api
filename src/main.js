import Vue from 'vue'
import App from './App.vue'
import router from './router'
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/src/themes/default/index.scss';
import Toasted from 'vue-toasted';
Vue.use(Toasted);

Vue.use(VueToast, {
  position: 'bottom-right'
})

Vue.config.productionTip = false
window.axios = require('axios').default;
window.toast = Vue.$toast;

new Vue({
  router,
  render: h => h(App),
}).$mount('#app')
