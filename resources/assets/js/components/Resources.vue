<template>
	<div class="content-bottom-header">
		<!-- <h1>RESOURCE</h1> -->
		<div id="resource" >

			<div class="col-xs-12 col-sm-8 col-lg-8 resource-body">
				<h1 class="title-resource">PROVA TITOL</h1>
				<!-- <div class="picture">PRUEBA imagen</div> -->
				<img class="img-responsive" src="\img\image\imagenprueba.jpg" alt="prueba View" width="960" height="540">
				<div class="subtitle">PRUEBA DE subTITULO</div>
				<div class="descshort">PRUEBA DE descripcion corta</div>
				<div class="desc1">PRUEBA DE descripcion larga y extensa 1</div>
				<div class="desc2">PRUEBA DE descripcion larga y extensa 1</div>
			</div>

			<div class="col-xs-12 col-sm-4 col-lg-4 resource-extras">
				<h1 class="title-data-sheet">FITXA TÈCNICA</h1>
				<div class="dateini">date('dataInici');</div>
				<div class="dateend">date('DdtaFinal');</div>
				<div class="free">boolean('Gratuit');</div>
				<div class="priceshort"> double('preuInferior', 15, 2);</div>
				<div class="pricelong">double('preuSuperior', 15, 2);</div>
				<div class="dateini">dateTime('dataPublicacio');</div>
				<div class="autor">string('creatPer');</div>
				<div class="loc">integer('idLocalitzacio')</div>
				<div class="banners">

				</div>
			</div>
		</div>
	</div>
</template>


<!-- $table->string('titol', 150);
            $table->string('subTitol', 250);
            $table->string('descBreu', 500);
            $table->string('descDetaill1');
            $table->string('descDetaill2');
            $table->integer('relevancia');
            $table->date('dataInici');
            $table->date('DdtaFinal');
            $table->boolean('Gratuit');
            $table->double('preuInferior', 15, 2);
            $table->double('preuSuperior', 15, 2);
            $table->dateTime('dataPublicacio');
            $table->boolean('visible');
            $table->string('fotoResum');
            $table->string('creatPer');
            $table->integer('idLocalitzacio')->references('id')->on('localitzacions'); -->
<script>
	/*export default{
		data(){
			return{
				users:[]
			}
		},
		created(){
			this.fetchUsers();
		},
		methods:{
			fetchUsers(){
				this.$http.get('api/users').then(response=>{
					this.users = response.data.users;
				})
			}
		}
	}*/
</script>