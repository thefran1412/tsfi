<template>
	<div class="content-bottom-header" >
		<div id="resource" class="container">
			<!-- Columna principal -->
			<div v-if="resource" class="col-xs-12 col-sm-8 col-md-8 col-lg-8 resource-body">
				<!--  titol Recurs-->
				<h1>{{resource[0].titolRecurs}}</h1>
				<!--  Foto resum-->
				<img class="img-responsive" :src="'/img/image/'+ resource[0].fotoResum" :alt="resource[0].titolRecurs" :title="resource[0].titolRecurs">
				<!-- autor i data publicació-->
				<div v-if="resource[0].creatPer && datePub" class="autor">
					<h5><strong>Autor: </strong> {{resource[0].creatPer}} <p><strong> <i class="fa fa-calendar" aria-hidden="true"></i> {{datePub}}</strong></p></h5>
				</div>
				<!-- subtitol -->
				<h2>{{resource[0].subtitol}}</h2>
				<!-- class="descshort" -->
				<p><strong>{{resource[0].descBreu}}</strong></p>
					<!-- desc1 -->
				<p>{{resource[0].descDetaill1}}</p>
					<!-- desc2 -->
				<p>{{resource[0].descDetaill2}}</p>
			</div>
			<!-- Columna secundaria -->
			<div v-if="resource" class="col-xs-12 col-sm-4 col-md-4 col-lg-4 resource-extras">
				<h1>FITXA TÈCNICA</h1>
				<div v-if="resource[0].age" class="resource-extras-tag">
					<h3>Edats recomenades</h3>
					<p v-for="r in resource[0].age">{{r.codiEdat}}</p>
				</div>
				<div v-if="dateIni && dateEnd"class="resource-extras-tag">
					<h3>Data inicial i final</h3>
					<p>{{dateIni}}</p>
					<p>{{dateEnd}}</p>
				</div>
				<div v-if="resource[0].gratuit === 1 || (resource[0].preuInferior && resource[0].preuSuperior)" class="resource-extras-tag">
					<h3>Preu</h3>
					<p v-if="resource[0].gratuit === 1">gratuït</p>
					<p v-if="resource[0].gratuit === 0">{{resource[0].preuInferior}} €</p>
					<p v-if="resource[0].gratuit === 0">{{resource[0].preuSuperior}} €</p>
				</div>

				<!-- <pre>{{this.resource[0].entitats}}</pre> -->
				<div v-if="resource[0].entity" class="extras">
				<!-- Logo entitat ** sin arreglar -->
					<h3>{{resource[0].entity[0].nomEntitat}}</h3></br>
					<h4 v-if="resource[0].entity[0].descEntitat">{{resource[0].entity[0].descEntitat}}</h4>
					<!-- <a :href="resource[0].entity[0].link" target="_blank">
						<img class="img-responsive" :src="resource[0].entity[0].logo" :alt="resource[0].entity[0].link" :title="resource[0].entity[0].link">
					</a> -->
					<h4><strong>Adreça:</strong></br>{{resource[0].entity[0].adreca}}</h4>

					<h4 v-if="resource[0].entity[0].telf1 !== 0 && resource[0].entity[0].telf2 !== 0"><strong>Telefóns: </strong></br>{{resource[0].entity[0].telf1}} / {{resource[0].entity[0].telf2}}</h4>
					<h4 v-if="resource[0].entity[0].telf1 !== 0 && resource[0].entity[0].telf2 === 0"><strong>Telefón: </strong></br>{{resource[0].entity[0].telf1}}</h4>
					<h4 v-if="resource[0].entity[0].telf1 === 0 && resource[0].entity[0].telf2 !== 0"><strong>Telefón: </strong></br>{{resource[0].entity[0].telf2}}</h4>
					<!-- plana web -->
					<h4><strong>Plana web:</strong></br><a class="links":href="resource[0].entity[0].link" target="_blank" :title="resource[0].entity[0].link">{{resource[0].entity[0].link}}</a></h4>

					<h3>Xarxes Socials</h3>
						<a class="socialMedia" :href="'https://twitter.com/'+ resource[0].entity[0].twitter" target="_blank" :title="'https://twitter.com/'+ resource[0].entity[0].twitter">
						   <i class="fa fa-twitter fa-3x"></i>
						</a>
						<a class="socialMedia" :href="'https://www.facebook.com/'+ resource[0].entity[0].facebook" target="_blank" :title="'https://twitter.com/'+ resource[0].entity[0].twitter">
						  <i class="fa fa-facebook fa-3x"></i>
						</a>
						<a class="socialMedia" :href="'https://www.instagram.com/'+ resource[0].entity[0].instagram" target="_blank" :title="'https://twitter.com/'+ resource[0].entity[0].twitter">
						  <i class="fa fa-instagram fa-3x"></i>
						</a>
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
				resource:null,
				dateIni:null,
				dateEnd:null,
				datePub:null
			}
		},
		created(){
			this.fetchResource(this.$route.params.id);
		},
		methods:{
			fetchResource: function(id){
				this.$http.get('../api/recursos/'+id).then(function(response){
					this.resource = response.data.resource;
					this.dateIni = response.data.dateIni;
					this.dateEnd = response.data.dateEnd;
					this.datePub = response.data.datePub;
					console.log(this.resource);
					console.log(this.dateIni);
					console.log(this.dateEnd);
					console.log(this.datePub);
				});
			}
		}
	}
</script>