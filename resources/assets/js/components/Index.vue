<template>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <button v-on:click="changeTypeUser('teacher')" v-if="type === 'students'"  id="myButton" class="float-left submit-button" >Go Teachers</button>

                <button  v-if="type === 'teachers'" v-on:click="changeTypeUser('student')" id="myButton" class="float-left submit-button" >Go Students</button>

            </div>
            <div id="navbar" class="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li v-if="type === 'students'"><router-link :to="{name: 'HomeStudents'}">Students</router-link></li>
                    <li v-if="type === 'teachers'"><router-link :to="{name: 'HomeTeachers'}">Teachers</router-link></li>
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
                type:''
            }
        },
        created(){
            this.typeUser();
        },
        methods:{
            typeUser(){
                /*var actualRoute = window.location;*/

                this.type = 'students';

                /*if(actualRoute.pathname.indexOf('students') === 1){
                    this.type = 'students';
                }

                if(actualRoute.pathname.indexOf('teachers') === 1){
                    this.type = 'teachers';
                }*/
            },
            changeTypeUser: function (typeUser){

                localStorage.removeItem("typeUser");

                localStorage.setItem("typeUser", typeUser);

                window.location = 'http://localhost:8000/'+typeUser+'s/home/';
            }
        }
    }

</script>
