<template>
    <div id="appVue">
        <header>
            <div class="header-top-item header-search-container">

                <div class="row">
                    <div class="col-md-1" >
                        <li v-on:click="returnHomePage('teacher')" v-if="type === 'teacher'">
                                <span class="title">TSFI</span>
                        </li>
                        
                        <li  v-on:click="returnHomePage('student')" v-if="type === 'student'">
                                <span class="title">TSFI</span>
                        </li>
                        </div>
                        <div class="col-md-3 col-md-offset-3">
                            <div class="selects">
                                <multiselect @select="dispatchAction" v-model="category" selected-label="Seleccionada" track-by="codiCategoria" label="codiCategoria" placeholder="Selecciona una categoria" :options="categories" :searchable="false" :allow-empty="false"></multiselect>
                            </div>
                        </div>
                    <div class="col-md-3" v-show="noShow">
                        <multiselect v-model="entity" :options="entities" :custom-label="nameWithLang" placeholder="Selecciona una entitat" label="codiCategoria" track-by="codiCategoria"  :allow-empty="false"></multiselect>
                    </div>
                    <div class="col-md-3">
                            <form @submit.prevent="actionToSearch" class="site-search" >
                              <div id="site-search-container">
                                <input v-model="search" type="search" id="site-search" placeholder="Cerca el recurs...">
                              </div>
                              <button tabindex="2" type="submit">
                                    <span class="a11y-only">Search</span>
                                    <svg class="icon-search" viewBox="0 0 34 34" fill="none" stroke="currentColor">
                                        <ellipse stroke-width="3" cx="16" cy="15" rx="12" ry="12"></ellipse>
                                        <path d="M26 26 l 8 8" stroke-width="3" stroke-linecap="square"></path>
                                    </svg>
                               </button>
                            </form>
                    </div>
                    <div class="col-md-2 user-type">
                        <li v-on:click="typeUser('Envians un recurs')">
                            <router-link :to="{name: 'enviar-recurs'}">
                                <i class="fa fa-cloud-upload" aria-hidden="true" title="Enviar recurs"></i>
                            </router-link>
                        </li>
                        <li v-on:click="changeTypeUser('teacher')" v-if="type === 'student'">
                                <i class="fa fa-pied-piper" aria-hidden="true" title="Canviar perfil"></i>
                        </li>
                        <li  v-on:click="changeTypeUser('student')" v-if="type === 'teacher'">
                                <i class="fa fa-pied-piper" aria-hidden="true" title="Canviar perfil"></i>
                        </li>
                    </div>
                </div>   
                <span class="profile">
                    <li v-if="type === 'student'">
                        Estudiants i Pares
                    </li>
                    <li v-if="type === 'teacher'">
                        Orientadors i Professors  
                    </li>
                </span>
            </div>
        </header>
        <div class="container">
            <router-view></router-view>
        </div>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 network">
                        <h4>Segueix-nos a :</h4>
                        <a href="#"><img src="/img/twitter.svg"></a>
                        <a href="#"><img src="/img/facebook.svg"></a>
                        <a href="#"><img src="/img/instagram.svg"></a>
                    </div>
                    <div class="col-md-offset-2 col-md-4 contact">
                        <h4>Contacta amb nosaltres :</h4>
                        <span>Número de Telefón: 93 333 33 33</span>
                        <span>Correu Electrónic: 
                            <a href="mailto:info@tsfi.com">info@tsfi.com</a>
                        </span>
                    </div>
                </div>
                <div class="row entitats">
                    <div class="col-md-12">
                        <h4>Entitats Col·laboradores :</h4>
                    </div>
                    <div class="col-md-4" v-for="e in entities">
                        <a v-bind:href="e.link" target="_blank">{{ e.nomEntitat }}</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    import { EventBus } from '../app.js';
    
    export default{
        data(){
            return{
                type:'',
                search:'',
                searchSubmit : '',
                entity: { name: ''},
                recursos:[],
                category: { codiCategoria: 'Totes les Categories', nomCategoria: 'home' },
                categories: [],
                entities: [],
                prueba:null,
                noShow:false,
                typeUserUrl: this.$route.params.typeuser,
                typeCategory:this.$route.params.category,
                page:1
            }
        },
        created(){
            this.whatUserPage(this.$route.params.typeuser);
            this.fetchCategories();
            this.fetchEntities();
            this.correctSelectCategory(this.$route.params.category);
        },
        mounted(){
            this.typeUser();
        },
        methods:{
            typeUser(value){
                var typeUser = localStorage.getItem("typeUser");

                if(typeUser === 'student'){
                    this.type = 'student';
                }
                if(typeUser === 'teacher'){
                    this.type = 'teacher';
                }
            },
            whatUserPage(value){
                var typeNum = localStorage.getItem("numType");
                this.search = '';
                if(localStorage.length >= 2 && Number(typeNum) === 0){
                    var typeUser = localStorage.getItem("typeUser");
                    localStorage.removeItem("numType");
                    localStorage.setItem("numType", 1);
                    if(typeUser === 'student'){
                        this.$router.push('/student/home')
                    }else{
                        this.$router.push('/teacher/home')
                    }
                }
            },
            returnHomePage(typeUser){
                
                this.$router.push('/'+typeUser+'/home');
                this.recursos = [];
                this.$nextTick(() => {
                    this.$children[3].$refs.infiniteLoading.$emit('$InfiniteLoading:reset');
                    this.page = 1;
                });
                this.category = { codiCategoria: 'Totes les Categories', nomCategoria: 'home' };
            },
            changeTypeUser: function (typeUser){
                
                this.search = '';
                localStorage.removeItem("typeUser");
                localStorage.setItem("typeUser", typeUser);
                
                var typeActUser = localStorage.getItem("typeUser");
                localStorage.removeItem("numType");
                localStorage.setItem("numType", 0);

                this.$router.push('/'+typeUser+'/home');

                this.typeUser();
                this.recursos = [];
                this.$nextTick(() => {
                    this.$children[3].$refs.infiniteLoading.$emit('$InfiniteLoading:reset');
                    this.page = 1;
                });
                
                this.category = { codiCategoria: 'Totes les Categories', nomCategoria: 'home' };
            },
            correctSelectCategory(routeParam){
                console.log(routeParam);
                if(routeParam !== undefined){
                    if(routeParam !== 'home'){
                    var cap = routeParam.charAt(0).toUpperCase() + routeParam.slice(1);
                    this.category = { codiCategoria: cap, nomCategoria: routeParam };
                    }
                    if(routeParam === 'home'){
                        this.category = { codiCategoria: 'Totes les Categories', nomCategoria: 'home' };
                    }
                }
                
            },
            fetchEntities(){
                this.$http.get('../api/entitats').then(response=>{
                    this.entities = response.data.entities;
                })
            },
            fetchCategories(){
                this.$http.get('../api/categories').then(response=>{
                    this.categories = response.data.categories;
                })
            },
            fetchResource(typeUser, category){
                this.$http.get('../api/typeuser/'+this.type+'/'+category).then(response=>{
                    this.recursos = response.data.resources;
                    this.search = '';
                    this.loading = true;
                });
              },
             onInfinite(typeUser, typeCategory) {
                  var route = '../api/typeuser/'+ typeUser+'/'+typeCategory + '?page=' + this.page;
                  var t;
                  var d;
                  
                  this.$http.get( route , {

                  }).then((res) => {
                    if (res.data.resources.length ) {
                      this.recursos = this.recursos.concat(res.data.resources);
                            this.recursos.forEach(function(data){
                                if(data.dataPublicacio){
                                    t = data.dataPublicacio.split(/[- :]/);
                                    d = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
                                    data.dataPublicacio = d.toLocaleDateString('en-GB');
                                }
                            });

                          this.$children[3].$refs.infiniteLoading.$emit('$InfiniteLoading:loaded');
                          if (this.recursos.length / 20 === 10) {
                            this.$children[3].$refs.infiniteLoading.$emit('$InfiniteLoading:complete');
                          }
                          this.page++;
                    } else {
                      this.$children[3].$refs.infiniteLoading.$emit('$InfiniteLoading:complete');
                    }
                  });
                },
                dispatchAction(v){
                    this.recursos = [];
                    var typeUser = localStorage.getItem("typeUser");
                    this.$router.push('/'+typeUser + '/' + v.nomCategoria);

                        this.$nextTick(() => {
                            this.$children[3].$refs.infiniteLoading.$emit('$InfiniteLoading:reset');
                            this.page = 1;
                        });
                },
                actionToSearch(){
                        this.$children[3].list = [];
                        this.$children[3].tags = [];
                        
                        this.$router.push('/search?name=' + this.search);

                        this.$nextTick(() => {
                            this.$children[3].$refs.infiniteLoading.$emit('$InfiniteLoading:reset');
                            this.$children[3].pageSearch = 1;
                        });
                }
        },
       components: {
            Multiselect
        },
        watch: {
            '$route' (to, from) {
                this.$children[3].list = [];
                this.recursos = [];

                this.$router.push(to.fullPath);

                if(!to.fullPath.indexOf('enviar-recurs') > 0){
                    this.$nextTick(() => {
                            this.$children[3].$refs.infiniteLoading.$emit('$InfiniteLoading:reset');
                            this.$children[3].pageSearch = 1;
                            this.page = 1;
                        });
                }else{
                    this.category = { codiCategoria: "Envia'ns un recurs", nomCategoria: 'home' };
                }

                if(to.fullPath.indexOf('student') > 0 || to.fullPath.indexOf('teacher') > 0){
                    

                    if(to.fullPath.indexOf('home') > 0){
                        this.category = { codiCategoria: 'Totes les Categories', nomCategoria: 'home' };
                    }else{
                        var cap = to.params.category.charAt(0).toUpperCase() + to.params.category.slice(1);
                        this.category = { codiCategoria: cap, nomCategoria: to.params.category };
                    }
                }
           }
       }
    }
</script>