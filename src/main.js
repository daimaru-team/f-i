import '@babel/polyfill'
import Vue from 'vue';
import './plugins/vuetify'
import App from './App.vue';
import router from './router';
import store from './store';
import './registerServiceWorker';
import GlobalDate from './views/date.vue'

Vue.component(GlobalDate.name, GlobalDate);

Vue.config.productionTip = false;

new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app');
