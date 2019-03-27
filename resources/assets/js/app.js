

require('./bootstrap');

import Datepicker from 'vuejs-datepicker';

import Vue from 'vue';

import router from './routes'; 

// Vue.component('pageslist', require('./views/Pageslist.vue'));

// Vue.component('pagesview', require('./components/Pagesview.vue'));

const app = new Vue({
    el: '#app',
    router,
    data:{
    	menu : 0
    },
	Datepicker
});
