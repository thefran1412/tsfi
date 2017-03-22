<template>
    <div id="appVue">
        <header>
            <div class="header-top-item header-search-container">
                <span>TSFI</span>
                <form class="site-search" >
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
            <div class="footer-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4" >
                            <multiselect @select="dispatchAction" selected-label="Seleccionada" track-by="codiCategoria" label="codiCategoria" placeholder="Selecciona una categoria" :options="categories" ></multiselect>
                        </div>
                        <div class="col-md-4">
                            <multiselect v-model="entity" :options="entities" :custom-label="nameWithLang" placeholder="Selecciona una entitat" label="nomEntitat" track-by="nomEntitat"  :allow-empty="false"></multiselect>
                        </div>
                        <div class="col-md-2 user-type">
                            <li v-on:click="typeUser('Envians un recurs')" >
                                <router-link :to="{name: 'enviar-recurs'}">
                                    <span>Enviar</span>
                                    <span>Recurs</span>
                                </router-link>
                            </li>
                        </div>
                        <div class="col-md-2 user-type">
                            <li v-on:click="changeTypeUser('teacher')" v-if="type === 'student'">
                                <span>Estudiants i</span>
                                <span>Pares</span>
                            </li>
                            <li  v-on:click="changeTypeUser('student')" v-if="type === 'teacher'">
                                <span>Orientadors i</span>
                                <span>Professors</span>
                            </li>
                        </div>
                    </div>
                </div>
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
    import InfiniteLoading from 'vue-infinite-loading';
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
                typeUserUrl: this.$route.params.typeuser,
                typeCategory:this.$route.params.category,
                page:1,
                route:null,
            }
        },
        created(){
            this.whatUserPage(this.$route.params.typeuser);
            this.fetchCategories();
            this.fetchEntities();
            //this.onInfinite(this.$route.params.typeuser, this.$route.params.category);
            this.correctSelectCategory(this.$route.params.category);
            //this.fetchResource(this.$route.params.typeuser, this.$route.params.category);
        },
        mounted(){
            this.typeUser();

        },
        methods:{
            typeUser(value){

                var typeUser = localStorage.getItem("typeUser");

                // if(value){
                //     this.recursos = [];
                //     this.$nextTick(() => {
                //         this.prueba.$emit('$InfiniteLoading:reset');
                //     });
                //     this.category = { codiCategoria:value , nomCategoria: 'enviar-recurs' };
                // }

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
            changeTypeUser: function (typeUser){

                this.search = '';

                localStorage.removeItem("typeUser");

                localStorage.setItem("typeUser", typeUser);

                var typeActUser = localStorage.getItem("typeUser");


                localStorage.removeItem("numType");

                localStorage.setItem("numType", 0);

                this.typeUser();

                

                this.recursos = [];
                this.$nextTick(() => {
                    this.$children[3].$refs.infiniteLoading.$emit('$InfiniteLoading:reset');
                    this.page = 1;
                    this.$router.push('/'+typeUser+'/home');
                    var URLactual = window.location.hash;
                    console.log(URLactual);
                    var cont = 0;
                    var pr;
                    if(URLactual.indexOf(typeUser)>0 && cont===0){
                        pr = true;
                        cont++;
                    }

                    if(pr){
                        this.onInfinite(typeActUser, 'home');
                    }
                    
                    
                });

                
                //this.category = { codiCategoria: 'Totes les Categories', nomCategoria: 'home' };

            },
            correctSelectCategory(routeParam){
                if(routeParam !== 'home' && routeParam !== undefined){
                    var cap = routeParam.charAt(0).toUpperCase() + routeParam.slice(1);
                    this.category = { codiCategoria: cap, nomCategoria: routeParam };
                }

                if(routeParam !== undefined){
                    this.category = { codiCategoria: 'Totes les Categories', nomCategoria: 'home' };
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

                  console.log(this.route);

                  var nroute = '../api/typeuser/'+ typeUser+'/'+typeCategory + '?page=' + this.page;

                  if(this.route !== nroute){

                    this.route = nroute;

                          this.$http.get(this.route , {

                          }).then((res) => {
                            if (res.data.resources.length ) {
                              this.recursos = this.recursos.concat(res.data.resources);
                                  this.$children[3].$refs.infiniteLoading.$emit('$InfiniteLoading:loaded');
                                  if (this.recursos.length / 20 === 10) {
                                    this.$children[3].$refs.infiniteLoading.$emit('$InfiniteLoading:complete');
                                  }
                                  this.page++;
                            } else {
                              this.$children[3].$refs.infiniteLoading.$emit('$InfiniteLoading:complete');
                            }

                          });
                    }else{
                        console.log('errorconsole.log(this.route);');
                    }
                },
                dispatchAction(v){
                    console.log(v);
                    this.recursos = [];
                    if(v.nomCategoria !== 'enviar-recurs'){
                        var typeUser = localStorage.getItem("typeUser");
                        
                        this.$nextTick(() => {
                            this.$children[3].$refs.infiniteLoading.$emit('$InfiniteLoading:reset');
                            this.page = 1;
                            if(v.nomCategoria !== 'home'){
                                //this.onInfinite(typeUser, v.nomCategoria);
                            }
                            this.$router.push('/'+typeUser + '/' + v.nomCategoria)
                        });
                        // console.log('index', 'hola');
                        // this.$emit('test');
                    }
                }
        },
       components: {
            Multiselect,
            InfiniteLoading
        },
    }

</script>
