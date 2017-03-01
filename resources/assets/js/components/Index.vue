<template>
    <div id="app">
        <header>
            <div class="header-top-item header-search-container">
                <span>TSFI</span>
                <form class="site-search" >
                      <div id="site-search-container">
                        <input value="" type="search" id="site-search" placeholder=" Cerca el recurs...">
                      </div>
                      <button tabindex="2" type="submit">
                        <span class="a11y-only">Search</span>
                            <svg class="icon-search" viewBox="0 0 34 34" fill="none" stroke="currentColor">
                                <ellipse stroke-width="3" cx="16" cy="15" rx="12" ry="12"></ellipse>
                                <path d="M26 26 l 8 8" stroke-width="3" stroke-linecap="square"></path>
                            </svg>
                     </button>
                </form>
                <div class="user-type">
                    <li v-on:click="changeTypeUser('teacher')" v-if="type === 'students'"><router-link :to="{name: 'HomeTeachers'}">Alumnes</router-link></li>
                    <li  v-on:click="changeTypeUser('student')" v-if="type === 'teachers'"><router-link :to="{name: 'HomeStudents'}">Professors</router-link></li>
                </div>
            </div>
            <div class="footer-menu">
                <div class="container">
                    <div class="col-md-6">
                        <multiselect v-model="category" selected-label="Seleccionada" track-by="category" label="category" placeholder="Select one" :options="categories" :selected="selected" :searchable="false" :allow-empty="false"></multiselect>
                    </div>
                    <div class="col-md-6">
                        <multiselect v-model="value" :options="options" :custom-label="nameWithLang" placeholder="Selecciona una entitat" label="name" track-by="name"></multiselect>
                    </div>
               </div>
            </div>
        </header>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>

    import Multiselect from 'vue-multiselect';

    export default{
        components: {
            Multiselect
        },
        props:{
            maxHeight: {
                type: Number,
                default: 162
              },
          },
        data(){
            return{
                type:'',
                rolNumber: 0,
                category: { category: 'Categories' },
                categories: [
                    { category: 'Categories' },
                    { category: 'Events' },
                    { category: 'Noticies' },
                    { category: 'Tallers' },
                    { category: 'Conferencies' }
                ],
                options: [
                    { name: 'Vue.js' },
                    { name: 'Rails' },
                    { name: 'Sinatra' },
                    { name: 'Laravel' },
                    { name: 'Phoenix' },
                    { name: 'Vue.js' },
                    { name: 'Rails' },
                    { name: 'Sinatra' },
                    { name: 'Laravel' },
                    { name: 'Phoenix' }
                  ]
            }
        },
        created(){
            this.whatUserPage();
            this.typeUser();
        },
        methods:{
            typeUser(){

                if(localStorage.length === 1){

                    var typeUser = localStorage.getItem("typeUser");

                    if(typeUser === 'student'){
                        this.type = 'students';
                    }else{
                        this.type = 'teachers';
                    }
                }

            },
            whatUserPage(){
                if(localStorage.length === 1 && this.rolNumber === 0){

                    this.rolNumber = 1;

                    var typeUser = localStorage.getItem("typeUser");
                    
                    if(typeUser === 'student'){
                        this.$router.push('/events-students')
                    }else{
                        this.$router.push('/events-teachers')
                    }
                }
            },
            changeTypeUser: function (typeUser){

                localStorage.removeItem("typeUser");

                localStorage.setItem("typeUser", typeUser);

                this.rolNumber = 0;

                this.typeUser();
            },
            nameWithLang ({ name }) {
              return `${name}`
            }
        }
    }

</script>
