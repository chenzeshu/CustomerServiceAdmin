require('./bootstrap');
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-default/index.css'
window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    'X-Requested-With': 'XMLHttpRequest'
};
Vue.use(ElementUI)

Vue.component('v-contracts', require('./components/contracts.vue'));
Vue.component('v-services', require('./components/services.vue'));
Vue.component('v-customer2', require('./components/customer2/customer2.vue'));
Vue.component('v-userrole', require('./components/auth/userrole.vue'));

const app = new Vue({
    el: '#app',
})
