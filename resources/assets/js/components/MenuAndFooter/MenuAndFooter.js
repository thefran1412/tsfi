import Multiselect from 'vue-multiselect';
import { EventBus } from '../../app.js';
    
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
                mobile:false,
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
            searchMobile(){
                this.mobile = this.mobile ? false : true;
            },
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

                this.animationScroll();

                this.$nextTick(() => {
                    this.$children[3].$refs.infiniteLoading.$emit('$InfiniteLoading:reset');
                    this.page = 1;
                });
                this.category = { codiCategoria: 'Totes les Categories', nomCategoria: 'home' };
            },
            animationScroll(){
                     $("html, body").animate({ scrollTop: 5 }, "slow");
                     $("html, body").animate({ scrollTop: 0 }, "slow");
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
                          console.log(this.recursos);
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
                    
                    this.animationScroll();

                    if(to.fullPath.indexOf('home') > 0){
                        this.$nextTick(() => {
                            this.$children[3].$refs.infiniteLoading.$emit('$InfiniteLoading:reset');
                            this.$children[3].pageSearch = 1;
                            this.page = 1;
                        });
                        this.category = { codiCategoria: 'Totes les Categories', nomCategoria: 'home' };
                    }else{
                        var cap = to.params.category.charAt(0).toUpperCase() + to.params.category.slice(1);
                        this.category = { codiCategoria: cap, nomCategoria: to.params.category };
                    }
                }
           }
       }
    }