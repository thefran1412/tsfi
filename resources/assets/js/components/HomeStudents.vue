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
          enter-active-class="animated fadeInUp"
          leave-active-class="animated fadeOutUp">
          <div class="col-md-4" v-for="r in getSearchTitle" :key="r.id">
            <div class="recurso">
              <div class="recurso-content">
                <h2>
                  <a v-bind:href="'#/resource/'+ r.id">
                      {{r.titol}}</a>
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
                      <a v-on:click="getCategory(r.nom)" v-bind:href="'#/'+r.nom">
                        {{r.nom}}
                      </a>
                    </div>
                </div>
                
                <div class="recurso-foto" :style="{ backgroundImage: 'url(' + r.fotoResum + ')' }"> 
                </div>
              </div>
            </div>
        </div>

        </transition-group>

        <!-- Acaba recurso -->
        <div class="clear-right" v-if="getSearchTitle.length && loading"></div>
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
      this.fetchResource();
      
    },
    mounted(){
        this.getResourceBackground();
    },
    methods:{
        getResourceBackground() {


        } ,  
      fetchResource(){
        this.$http.get('../api/recursos').then(response=>{
            this.recursos = response.data.resources;
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
        return this.recursos.filter((recurso) => recurso.titol.includes(this.$root.search))
      }
    }
  }
</script>