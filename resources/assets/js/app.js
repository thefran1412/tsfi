
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */
var Vue = require('vue');
var VueRouter = require('vue-router');

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.http.headers.common['X-CSRF-TOKEN'] = Laravel.csrfToken;
Vue.use(VueRouter);

import Index from './components/Index.vue';

import HomeStudents from './components/HomeStudents.vue';
import ArticlesStudents from './components/ArticlesStudents.vue';

import HomeTeachers from './components/HomeTeachers.vue';


const router = new VueRouter({
    hashbang:false,
    base:__dirname,
    mode: 'history',
    linkActiveClass: 'active',
    routes:[
    	{path:'/events-students',component:HomeStudents, name:'HomeStudents' },
    	{path:'/articles-students',component:ArticlesStudents, name:'ArticlesStudents' },
    	{path:'/events-teachers',component:HomeTeachers, name:'HomeTeachers' }
    ]
});



new Vue(Vue.util.extend({router}, Index)).$mount('#appVue')
