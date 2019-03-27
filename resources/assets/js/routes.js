import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);


export default new Router({
	routes: [
		{
			path: '/',
			name: 'home',
			component: require('./views/Pageslist') 
		},
		{
			path: '/page/:id',
			name: 'page_show',
			component: require('./views/PagesView') 
		},
		{
			path: '*',
			component: require('./views/404') 
		},
	]
});