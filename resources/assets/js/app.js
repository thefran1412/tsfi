
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

//Index
import Index from './components/Index.vue';

//Students
import HomeStudents from './components/HomeStudents.vue';
import ArticlesStudents from './components/ArticlesStudents.vue';

//categories

import Events from './components/Events.vue';

//Teachers
import HomeTeachers from './components/HomeTeachers.vue';

//Recurso
import Resource from './components/Resources.vue';


const router = new VueRouter({
    hashbang:false,
    base:__dirname,
    linkActiveClass: 'active',
    routes:[
    	{path:'/home-students',component:HomeStudents, name:'home-students' },
    	{path:'/articles-students',component:ArticlesStudents, name:'articlesStudents' },
    	{path:'/home-teachers',component:HomeTeachers, name:'home-teachers' },
    	{path:'/resource',component:Resource, name:'resource' },
        {path:'/events',component:Events, name:'events' }
    ]
});



new Vue(Vue.util.extend({router}, Index)).$mount('#appVue')
