<template>
	<div class="content-bottom-header" >
		<!-- <h1>RESOURCE</h1> -->
		<div id="resource" class="container">

			<div v-if="resource" class="col-xs-12 col-sm-8 col-md-8 col-lg-8 resource-body">
				<!--  clearfix visible-xs-block visible-sm-block visible-md-block visible-lg-block -->
				<h1>{{resource[0].titolRecurs}}</h1>
				<img class="img-responsive" src="\img\image\imagenprueba.jpg" alt="prueba View"> <!-- width="960" height="540" -->
				<h2>PROVA SUBTITOL De la plantilla del recurs de proves i bla, bla, bla, bla, bla...</h2>

				<!-- class="descshort" -->
				<p> <strong>DESCRIPCIO CURTA </strong> am wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a,</p>
					<!-- desc1 -->
				<p> <strong>DESCRIPCIO LLARGA 1! </strong> sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a 1</p>
					<!-- desc2 -->
				<p> <strong>DESCRIPCIO LLARGA 2!</strong> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a</p>
			</div>

			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 resource-extras">
				<h1>FITXA TÈCNICA</h1>
				<div>
					<h3>Data inicial i final</h3>
					<p>08/03/2017</p>
					<p>31/03/2021</p>
				</div>
				<div>
					<h3>Preu</h3>
					<p>gratuit</p>
					<p>0 €</p>
					<p>2500 €</p>
				</div>
				<div>
					<h3>Data de publicació</h3>
					<p>07/03/2017</p>
				</div>
				<div class="extras">
					<h3>Publicat per</h3>
					<p>Adrián Gallego Luque</p>
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
				});
			}
		}
	}
</script>