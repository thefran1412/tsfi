<template>
	<div class="content-bottom-header" >
		<!-- <h1>RESOURCE</h1> -->
		<div id="resource" class="container">

			<div v-if="resource" class="col-xs-12 col-sm-8 col-md-8 col-lg-8 resource-body">
				<!--  clearfix visible-xs-block visible-sm-block visible-md-block visible-lg-block -->
				<h1>{{resource[0].titolRecurs}}</h1>
				<img class="img-responsive" src="\img\image\imagenprueba.jpg" alt="prueba View"> <!-- width="960" height="540" -->
				<h2>{{resource[0].subtitol}}</h2>
				<!-- <pre>{{this.recurso}}</pre> -->
				<!-- class="descshort" -->
				<p><strong>{{resource[0].descBreu}}</strong></p>
					<!-- desc1 -->
				<p>{{resource[0].descDetaill1}}</p>
					<!-- desc2 -->
				<p>{{resource[0].descDetaill2}}</p>
			</div>

			<div v-if="resource" class="col-xs-12 col-sm-4 col-md-4 col-lg-4 resource-extras">
				<h1>FITXA TÈCNICA</h1>
				<div>
					<h3>Data inicial i final</h3>
					<p>{{resource[0].dataInici}}</p>
					<p>{{resource[0].dataFinal}}</p>
				</div>
				<div>
					<h3>Preu</h3>
					<p>{{resource[0].gratuit}}</p>
					<p>{{resource[0].preuInferior}} €</p>
					<p>{{resource[0].preuSuperior}} €</p>
				</div>
				<div>
					<h3>Data de publicació</h3>
					<p>{{resource[0].dataPublicacio}}</p>
				</div>
				<div class="extras">
					<h3>Publicat per</h3>
					<p>{{resource[0].creatPer}}</p>
				</div>
				<div class="extras">
				<h3>Direcció</h3>
					<p>Calle estroncio 15-21, 3-4</p>
				</div>

				<div class="banners">
					<h1>Banner</h1>
				</div>
			</div>
		</div>
	</div>
</template>


<script>
	export default{
		data(){
			return{
				image:'',
				resource:null
			}
		},
		created(){
			this.fetchResource(this.$route.params.id);
		},
		methods:{
			fetchResource: function(id){
				this.$http.get('../api/recursos/'+id).then(function(response){
					this.resource = response.data.resource;
					console.log(this.resource);
					console.log(this.recurso);
				});
			}
		}
	}
</script>