import store from './store';
import Vue from 'vue';
import VModal from 'vue-js-modal';

Vue.use(VModal);

// window.Vue = Vue;


const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

new Vue({
    el: '#app',
    store
});
