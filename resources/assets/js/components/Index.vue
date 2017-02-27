<template>
    <div id="app">
        <div id="menu">
            <div class="header-item header-search-container">
                <span>TSFI</span>
                <form class="site-search" >
                      <div id="site-search-container">
                        <input value="" type="search" id="site-search" placeholder="Cerca el recurs...">
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
                
            </div>
        </div>
        <!-- <nav class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                
            </div>
            <div id="navbar" class="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li v-on:click="changeTypeUser('teacher')" v-if="type === 'students'"><router-link :to="{name: 'HomeTeachers'}">Students</router-link></li>
                    <li  v-on:click="changeTypeUser('student')" v-if="type === 'teachers'"><router-link :to="{name: 'HomeStudents'}">Teachers</router-link></li>
                    <li v-if="type === 'students'"><router-link :to="{name: 'ArticlesStudents'}">Articles</router-link></li>
                </ul>
            </div>
        </nav> -->
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>

    export default{
        data(){
            return{
                type:'',
                rolNumber: 0
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
            }
        }
    }

</script>
