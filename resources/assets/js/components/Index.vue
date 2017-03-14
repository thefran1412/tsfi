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
                            <router-link ref="canvas" :to="{name: category.category}" >
                            <multiselect v-model="category" selected-label="Seleccionada" track-by="name" label="name" placeholder="Selecciona una categoria" :options="categories" :searchable="false" :allow-empty="false"></multiselect>
                            </router-link>
                        </div>
                        <div class="col-md-4">
                            <multiselect v-model="entity" :options="entities" :custom-label="nameWithLang" placeholder="Selecciona una entitat" label="name" track-by="name"  :allow-empty="false"></multiselect>
                        </div>
                        <div class="col-md-2 user-type">
                            <li v-on:click="typeUser('#/enviar-recurs')" >
                                <router-link :to="{name: 'enviar-recurs'}">
                                    <span>Enviar</span>
                                    <span>Recurs</span>
                                </router-link>
                            </li>
                        </div>
                        <div class="col-md-2 user-type">
                            <li v-on:click="changeTypeUser('teacher')" v-if="type === 'students'">
                                <router-link :to="{name: 'home-teachers'}">
                                    <span>Estudiants i</span>
                                    <span>Pares</span>
                                </router-link>
                            </li>
                            <li  v-on:click="changeTypeUser('student')" v-if="type === 'teachers'">
                                <router-link :to="{name: 'home-students'}">
                                    <span>Orientadors i</span>
                                    <span>Professors</span>
                                </router-link>
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
                        <a v-bind:href="e.url" target="_blank">{{ e.name }}</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>

    import Multiselect from 'vue-multiselect';

    export default{
        components: {
            Multiselect
        },
        props:{
            
          },
        data(){
            return{
                type:'',
                search:'',
                searchSubmit : '',
                entity: { name: ''},
                category: { category: '', name: 'Totes les categories' },
                categories: [
                    { category: '' , name: 'Totes les categories'},
                    { category: 'events', name: 'Events' },
                    { category: 'noticies', name: 'Noticies'},
                    { category: 'tallers', name: 'Tallers'},
                    { category: 'conferencies', name: 'Conferencies'}
                ],
                entities: [
                    { name:'Totes', url:''},
                    { name: 'ADECAT', url: 'http://www.adecat.org/' },
                    { name: 'Ajuntament de BCN - Barcelona Activa', url: 'http://www.barcelonactiva.cat' },
                    { name: "Ajuntament de BCN - Institut Municipal d'Informàtica", url: 'http://ajuntament.barcelona.cat/imi/ca' },
                    { name: 'Anna Ginorella de Mundet', url: 'http://agmundet.es/wp/' },
                    { name: 'ASEITEC - CECOT', url: 'http://www.aseitec.org/' },
                    { name: 'Cambra de Comerç de BCN', url: 'http://www.cambrabcn.org/es/' },
                    { name: "Col.legi d'Enginyers Industrials de Catalunya - COEIC", url: 'http://www.eic.cat/' },
                    { name: 'Comissons Obreres - CCOO', url: 'http://www.ccoo.cat/' },
                    { name: "Consorci d'Educació", url: 'http://www.edubcn.cat/ca/' },
                    { name: 'Fira de Barcelona', url: 'http://www.firabarcelona.com/ca' },
                    { name: 'Fundació BCN FP', url: 'http://www.fundaciobcnfp.cat' },
                    { name: 'Fundació EURECAT', url: 'http://www.adecat.org/' },
                    { name: 'Gencat - ACCIÓ', url: 'http://accio.gencat.cat/cat/' },
                    { name: "Gencat - Departament d'Ensenyament", url: 'http://ensenyament.gencat.cat/ca/inici/' },
                    { name: "Gencat - Direcció General d'Industria", url: 'http://empresa.gencat.cat/ca/inici/' },
                    { name: "Gencat - Empresa i Coneixement CTTI", url: 'http://empresa.gencat.cat/ca/inici/' },
                    { name: 'Grup SIMON', url: 'http://www.grupsimon.com/ca' },
                    { name: 'Gutmar', url: 'http://www.gutmar.com/index.php?lang=ca' },
                    { name: 'Industria21', url: 'http://www.industria21.cat/' },
                    { name: 'Institut Escola del Treball', url: 'http://www.escoladeltreball.org/ca' },
                    { name: 'Jesuïtes Clot', url: 'http://www.clot.fje.edu/' },
                    { name: 'LEITAT', url: 'http://www.leitat.org/castellano/' },
                    { name: 'Pacte Industrial de la Regió Metropolitana de BCN', url: 'http://www.pacteindustrial.org/' },
                    { name: 'PIMEC', url: 'https://www.pimec.org/' },
                    { name: 'Salesians de Sarria', url: 'http://www.salesianssarria.com/' },
                    { name: 'SANDVIK', url: 'http://www.home.sandvik/en/' },
                    { name: 'Schneider', url: 'http://www.schneider-electric.es/es/' },
                    { name: 'SEAT', url: 'http://www.seat.es' },
                    { name: 'Unió General dels Treballadors - UGT', url: 'http://www.ugt.cat/' },
                    { name: 'Unió Patronal Metal.lúrgica - UPM', url: 'http://www.upm.org.es/' }
                  ]
            }
        },
        created(){
            this.whatUserPage();
            this.fetchEntities();
        },
        mounted(){
            this.typeUser();
        },
        methods:{
            typeUser(defaultPath){

                var typeUser = localStorage.getItem("typeUser");
                var pathURL = this.$refs.canvas.$el.hash;

                if(localStorage.length === 2){

                    if(defaultPath){
                        pathURL = defaultPath;
                    }


                    this.correctUrlPageCategory(typeUser, pathURL);
                }

            },
            whatUserPage(){

                var typeNum = localStorage.getItem("numType");

                this.search = '';

                if(localStorage.length === 2 && Number(typeNum) === 0){

                    var typeUser = localStorage.getItem("typeUser");

                    localStorage.removeItem("numType");

                    localStorage.setItem("numType", 1);

                    if(typeUser === 'student'){
                        this.$router.push('/home-students')
                    }else{
                        this.$router.push('/home-teachers')
                    }
                }
            },
            changeTypeUser: function (typeUser){

                this.search = '';

                localStorage.removeItem("typeUser");

                localStorage.setItem("typeUser", typeUser);

                localStorage.removeItem("numType");

                localStorage.setItem("numType", 0);

                this.whatUserPage();
                this.typeUser();

                if (typeUser === 'teacher') {
                    this.category = { category: 'home-teachers', name: 'Totes les categories' };
                };

                if (typeUser === 'student') {
                    this.category = { category: 'home-students', name: 'Totes les categories' };
                };
                
            },
            correctUrlPageCategory(typeUser, pathURL){

                this.type = typeUser+'s';
                this.categories[0].category = 'home-'+typeUser+'s';

                if(pathURL.indexOf('resource') < 0) {
                    if(pathURL.indexOf('#/') > -1 && pathURL !== '#/home-'+typeUser+'s'){
                        var url  = pathURL.replace('#/', '');
                        var cap = url.charAt(0).toUpperCase() + url.slice(1);

                        this.category = { category: url, name: cap };
                    }
                }
                
            },
            fetchEntities(){
                this.$http.get('../api/entitats').then(response=>{
                    console.log(response.data);
                })
            }
        }
    }

</script>
