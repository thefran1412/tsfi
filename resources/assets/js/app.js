
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

//SendResource
import EnviarRecurs from './components/EnviarRecurs.vue';
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
import Resources from './components/CategoryTypes.vue';


//Recurso
import Resource from './components/Resources.vue';

//SearchResource
import ResultOfSearch from './components/ResultsOfSearch.vue';

//map
import Location from './components/Location.vue';
import LocationInput from './components/LocationInput.vue';

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
        {path:'/location-input', component:LocationInput, name:'location-input'}

    ]
});



new Vue(Vue.util.extend({router}, Index)).$mount('#appVue')
