<template>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                
            </div>
            <div id="navbar" class="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li v-on:click="changeTypeUser('teacher')" v-if="type === 'students'"><router-link :to="{name: 'HomeTeachers'}">Students</router-link></li>
                    <li  v-on:click="changeTypeUser('student')" v-if="type === 'teachers'"><router-link :to="{name: 'HomeStudents'}">Teachers</router-link></li>
                    <li v-if="type === 'students'"><router-link :to="{name: 'ArticlesStudents'}">Articles</router-link></li>
                </ul>
            </div>
        </nav>
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
