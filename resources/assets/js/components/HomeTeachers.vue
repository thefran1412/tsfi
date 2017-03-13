<template>
	<div class="content-bottom-header">
      <div class="row squares-resources">      
        <!-- Empieza recurso -->
        <div class="col-md-4" v-for="r in recursos">
            <div class="recurso">
              <div class="recurso-content">
                <h2>
                  <a v-bind:href="'#/'+ r.id">
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
                      <a v-bind:href="'#/'+r.nom">
                        {{r.nom}}
                      </a>
                    </div>
                </div>
                
                <div class="recurso-foto"> <!-- data-syle="background-image: url('\public\images\Prueba\Prueba-700x394.jpg');"  
                style="\public\images\Prueba\Prueba-700x394.jpg"
                   -->
                </div>
              </div>
            </div>
        </div>
        <!-- Acaba recurso -->
      </div>
    </div>
	</div>
</template>

<script>
  export default{

    data(){

      return{

          recursos:[]
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
        })
    },
    }
  }
</script>
