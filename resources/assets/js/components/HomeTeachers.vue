<template>
	<div class="content-bottom-header">

      <div class="row squares-resources">
        
        <!-- Empieza recurso -->
        <div class="col-md-4" v-for="r in recursos">
            <div class="recurso">
              <div class="recurso-content">
                <h2>
                  <a v-bind:href="r.urlRecurso">
                      {{r.titulo}}</a>
                  </a>
                </h2>
                <div class="recurso-meta">
                    <div class="autor">
                      <a href="#">
                        {{r.autor}}
                      </a>
                    </div>
                    <div class="fecha">
                      {{r.fecha}}
                    </div>
                    <div class="categoria">
                      <a v-bind:href="'#/'+r.categoria">
                        {{r.categoria}}
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

          recursos:[
            {urlRecurso: "#" ,titulo: "La esencia de los ‘spaghetti western’ en unos títulos de crédito", autor: "ignasi ballart", fecha: "17/04/2017", categoria:"events", image: "/images/Prueba-700x394.jpg"},
            {urlRecurso: "#", titulo: "La esencia de los ‘spaghetti western’ en unos títulos de crédito", autor: "carlos ruiz", fecha: "05/03/2016", categoria:"noticies", image: "/images/Prueba-700x394.jpg"}
          ]
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
            console.table(response.data);
        })
    },
    }
  }
</script>
