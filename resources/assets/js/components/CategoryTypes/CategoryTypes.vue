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
          <div class="col-md-4" v-for="(r, key) in this.$root.recursos" v-if="r.category[0].deleted === 0 || r.category[0].deleted" :key="r.recurs_id">
            <div class="recurso">
              <div class="recurso-content">
                <a v-bind:href="'#/resource/'+ r.recurs_id">
                  <h2>{{r.titolRecurs}}</h2>
                  <h6>{{r.subTitol}}</h6>
                </a>
                <div class="recurso-meta">
                    <div class="autor">
                      {{r.creatPer}}
                    </div>
                    <div class="fecha">{{r.dataPublicacio}}</div>
                    <div class="categoria">
                      
                      <a v-on:click="getCategory(r.category[0].nomCategoria)" v-bind:href="'#/'+typeUserUrl+'/'+r.
                        category[0].nomCategoria">
                        <i class="fa fa-archive" aria-hidden="true"></i>
                        {{r.category[0].nomCategoria}}
                      </a>
                    </div>
                    <div v-if="r.entity[0]" class="fecha">
                        {{r.entity[0].nomEntitat}}
                    </div>
                </div>
                
                <div class="recurso-foto" :style="{ backgroundImage: r.fotoResum ? 'url(img/image/' + r.fotoResum + ')' : 'url(img/image/tsfi-default-image.png)' }"> 
                </div>
              </div>
            </div>
        </div>
        </transition-group>
        <infinite-loading :on-infinite="onInfinite" ref="infiniteLoading" >
            <span slot="no-more">
              No n'hi han més recursos.
            </span>
             <span slot="no-results">
                No em trobat cap resultat amb aquesta paraula.
              </span>
        </infinite-loading>

        <!-- Acaba recurso -->
      </div>
    </div>
  </div>
</template>

<script src="./CategoryTypes.js" ></script>