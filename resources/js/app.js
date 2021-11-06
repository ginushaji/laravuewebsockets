/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('lang.js');

import VueLang from '@eli5/vue-lang-js';
import translations from './vue-translations';

window.Vue = require('vue').default;

Vue.use(VueLang, {
    messages: translations, // Provide locale file
    locale: 'en',           // Set locale
    fallback: 'en'          // Set fallback locale
});

const VueSimpleAlert = require('vue-simple-alert').default;
Vue.use(VueSimpleAlert);

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('app-component', require('./components/AppComponent.vue').default);
Vue.component('payment-panel', require('./components/PaymentPanel').default);
Vue.component('payment-content', require('./components/PaymentContent').default);
Vue.component('page-footer', require('./components/PageFooter').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
