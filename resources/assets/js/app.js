require('./bootstrap');

window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    'X-Requested-With': 'XMLHttpRequest'
};

Vue.component('v-contracts', require('./components/contracts.vue'));
Vue.component('v-services', require('./components/services.vue'));

const app = new Vue({
    el: '#app',
})
