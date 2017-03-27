<template>
<div class="content-bottom-header">
      <span class="resource-not-found" v-if="!this.$root.recursos.length === 0" >No em trobat el recurs...</span>
      <!-- <div class="prueba" v-if="this.$root.recursos.length === 0" ></div> -->
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
          <div class="col-md-4" v-for="(r, key) in this.$root.recursos" :key="r.recurs_id">
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
                      <i class="fa fa-archive" aria-hidden="true"></i>
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
        <infinite-loading :on-infinite="onInfinite" ref="infiniteLoading" >
            <span slot="no-more">
              No n'hi han més recursos.
            </span>
        </infinite-loading>

        <!-- Acaba recurso -->
      </div>
    </div>
  </div>
</template>
<style type="text/css">
  
  .prueba{
    height: 200px;
    width: 100%;
    margin-bottom: 20px;
    background-color: red;
  }
</style>

<script>

import InfiniteLoading from 'vue-infinite-loading';

  export default{
    data(){
      return{
          loading:false,
          correctCategory:'asda',
          recursos:[],
          typeUserUrl: this.$route.params.typeuser,
          typeCategory:this.$route.params.category,
          num:0
        }

    },
    created(){
      
    },
    mounted(){

    },
    methods:{
          onInfinite(){
                this.$parent.onInfinite(this.$route.params.typeuser, this.$route.params.category);
          },
          getCategory: function(value){
            this.$root.recursos = [];
            var cap = value.charAt(0).toUpperCase() + value.slice(1);
            this.$router.push('/'+this.typeUserUrl + '/' + value);
            this.$nextTick(() => {
                this.$refs.infiniteLoading.$emit('$InfiniteLoading:reset');
                this.$root.page = 1;
            });
            this.$parent.animationScroll();
            this.$root.category = { codiCategoria: cap, nomCategoria: value };
          }
         },
    components: {
            InfiniteLoading
    }
  }
</script>