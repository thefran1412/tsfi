<template>
<div class="content-bottom-header">
      <div class="row squares-resources">
        <transition
              name="animate"
              mode="in-out"
              enter-active-class="animated fadeInUp">
            <span class="resource-not-found" v-if="!this.$root.recursos.length && loading" :key="notfound">No em trobat el recurs...</span>
        </transition>
        <!-- Empieza recurso -->
        <transition-group
          name="animate-css"
          mode="in-out"
          enter-active-class="animated fadeInUp">
          <div class="col-md-4" v-for="r in this.$root.recursos" :key="r.recurs_id">
            <div class="recurso">
              <div class="recurso-content">
                <h2>
                  <a v-bind:href="'#/resource/'+ r.recurs_id">
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
                      <a v-on:click="getCategory(r.category[0].nomCategoria)" v-bind:href="'#/'+typeUserUrl+'/'+r.category[0].nomCategoria">
                        {{r.category[0].nomCategoria}}
                      </a>
                    </div>
                    <div v-if="r.entity[0]" class="fecha">
                        {{r.entity[0].nomEntitat}}
                    </div>
                </div>
                
                <div class="recurso-foto" :style="{ backgroundImage: 'url('+'/images/' + r.fotoResum + ')' }"> 
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
          loading:false,
          correctCategory:'',
          typeUserUrl: this.$route.params.typeuser
        }

    },
    created(){
      
    },
    mounted(){
  
    },
    methods:{
        getCategory: function(value){
          console.log('hola');

          var cap = value.charAt(0).toUpperCase() + value.slice(1);
          this.$root.category = { codiCategoria: cap, nomCategoria: value };
        }
    },
    computed:{
      getSearchTitle(){

        var searchWord = this.$root.search;
        var searchEntity = this.$root.entity.name;

        if(searchEntity === 'Totes'){
              searchEntity = '';
        }

        function normalize(text){
            return text.toLowerCase()
                .replace(/á/g, 'a')
                .replace(/é/g, 'e')
                .replace(/í/g, 'i')
                .replace(/ó/g, 'o')
                .replace(/ú/g, 'u');
        }

        // return this.$root.recursos.filter(function(item) {

        //       if(!normalize(item.titolRecurs).includes(normalize(searchWord))){
        //           return normalize(item.creatPer).includes(normalize(searchWord));
        //       }else{
        //           return normalize(item.titolRecurs).includes(normalize(searchWord)); 
        //       }
              
        //     }).filter(function(item) {
        //         return item.entity[0].nomEntitat.includes(searchEntity);
        //     })

      }
    }
  }
</script>