
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */
var Vue = require('vue');
var VueRouter = require('vue-router');
var Meta = require('vue-meta');


require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.http.headers.common['X-CSRF-TOKEN'] = Laravel.csrfToken;
Vue.use(VueRouter);
Vue.use(Meta);




//Index
import Index from './components/MenuAndFooter/MenuAndFooter.vue';

//SendResource
import EnviarRecurs from './components/SendResource/SendResource.vue';
import VeeValidate from 'vee-validate';
import { Validator } from 'vee-validate';

const dictionary = {
  en: {
    messages:{
      required: () => 'Some English Message'
    }
  },
  ca: {
    messages: {
      required: (field) => `El camp ${field} es obligatori.`,
      decimal: (field) => `Ha de ser numeric amb 2 decimals max.`,
      max: (field, [length]) => `El camp ${field} no pot ser major a ${length} caràcteres.`,
      size: (field, [size]) => `La imatge ${field} ha de ser menor a ${size} KB.`
    }
  }
};
Vue.use(VeeValidate)
Validator.updateDictionary(dictionary);

const validator = new Validator({ first_name: 'required' });

validator.setLocale('ca');

//Categories
import Resources from './components/CategoryTypes/CategoryTypes.vue';


//Recurso
import Resource from './components/Resources/Resources.vue';

//SearchResource
import ResultOfSearch from './components/ResultsOfSearch/ResultsOfSearch.vue';

//map
import Location from './components/Map/Location.vue';
import LocationInput from './components/Map/LocationInput.vue';

//NotFound
import NotFound from './components/PageNotFound/PageNotFound.vue';

// modal component
Vue.component('modal', {
  template: '#modal-template'
})


const router = new VueRouter({
    hashbang:false,
    base:__dirname,
    linkActiveClass: 'active',
    routes:[
        {path:'/resource/:id',component:Resource, name:'resource' },
        {path:'/enviar-recurs',component:EnviarRecurs, name:'enviar-recurs' },
        {path:'/:typeuser/:category',component:Resources, name:'resources' },
        {path:'/search',component:ResultOfSearch, name:'result-of-search' },
        {path:'/map', component:Location, name:'map'},
        {path:'/location-input', component:LocationInput, name:'location-input'},
        {path:'*', component: NotFound, name: 'not-found'},

    ]
});


new Vue(Vue.util.extend({router}, Index)).$mount('#appVue')
