<template>
<div class="content-bottom-header">
      <div class="row squares-resources">
        <transition
              name="animate"
              mode="in-out"
              enter-active-class="animated fadeInUp">
            <span class="resource-not-found" v-if="!getSearchTitle.length && loading" :key="notfound">No em trobat el recurs...</span>
        </transition>
        <!-- Empieza recurso -->
        <transition-group
          name="animate-css"
          mode="in-out"
          enter-active-class="animated fadeInUp">
          <div class="col-md-4" v-for="r in getSearchTitle" :key="r.recurs_id">
            <div class="recurso">
              <div class="recurso-content">
                <h2>
                  <a v-bind:href="'#/resource/'+ r.id">
                      {{r.titolRecurs}}</a>
                  </a>
                </h2>
                <div class="recurso-meta">
                    <div class="autor">
                      <a href="#">
                        {{r.creatPer}}
                      </a>
                    </div>
                    <div class="fecha">
                      {{r.dataPublicacio}}
                    </div>
                    <div class="categoria">
                      <a v-on:click="getCategory(r.nomCategoria)" v-bind:href="'#/'+r.nomCategoria">
                        {{r.nomCategoria}}
                      </a>
                    </div>
                    <div class="fecha">
                        {{r.nomEntitat}}
                    </div>
                </div>
                
                <div class="recurso-foto" :style="{ backgroundImage: 'url(' + r.fotoResum + ')' }"> 
                </div>
              </div>
            </div>
        </div>
        </transition-group>
        <!-- Acaba recurso -->
      </div>
    </div>
  </div>
</template>

<script>
  export default{

    data(){

      return{
          recursos:[],
          loading:false,
          correctCategory:''
        }

    },
    created(){
      this.fetchResource(this.$route.params.id);
      
    },
    mounted(){
        this.getResourceBackground();
    },
    methods:{
        getResourceBackground() {


        } ,  
      fetchResource(typeUser){

        typeUser = 'student';

        this.$http.get('../api/typeuser/'+typeUser).then(response=>{
            this.recursos = response.data.resources;
            console.log(this.recursos);
            this.$root.search = '';
            this.loading = true;
        });
      },
      getCategory: function(value){

        var cap = value.charAt(0).toUpperCase() + value.slice(1);
        this.$root.category = { category: value, name: cap };
      }
      
    },
    computed:{
      getSearchTitle(){

        var searchWord = this.$root.search;
        var searchEntity = this.$root.entity.name;

        if(searchEntity === 'Totes'){
              searchEntity = '';
        }

        return this.recursos
            .filter(function(item) {
                return item.titolRecurs.includes(searchWord); 
            })
            .filter(function(item) {
                return item.nomEntitat.includes(searchEntity);
            })

      }
    }
  }
</script>