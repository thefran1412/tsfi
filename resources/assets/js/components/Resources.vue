<template>
	<div class="content-bottom-header" >
		<div id="resource" class="container">
			<!-- Columna principal -->
			<div  class="col-xs-12 col-sm-8 col-md-8 col-lg-8 resource-body">
				<!--  titol Recurs-->



				<h1 v-if="resource" >{{resource[0].titolRecurs}}</h1>

				

 				<!--  Foto resum-->
				<img v-if="resource" class="img-responsive" :src="'/img/image/'+ resource[0].fotoResum" :alt="resource[0].titolRecurs" :title="resource[0].titolRecurs">
				<!-- autor i data publicació-->
				<div v-if="resource && resource[0].creatPer && datePub" class="autor">
					<h5><strong>Autor: </strong> {{resource[0].creatPer}} <p><strong> <i class="fa fa-calendar" aria-hidden="true"></i> {{datePub}}</strong></p></h5>
				</div>
				<!-- subtitol -->
				<h2 v-if="resource">{{resource[0].subtitol}}</h2>
				<!-- class="descshort" -->
				<p v-if="resource"><strong>{{resource[0].descBreu}}</strong></p>
					<!-- desc1 -->
				<p v-if="resource">{{resource[0].descDetaill1}}</p>
					<!-- desc2 -->
				<p v-if="resource">{{resource[0].descDetaill2}}</p>
				<!-- media -->
				<h2 v-if="resource && resource[0].image_resource[0] || resource && resource[0].video_resource[0] || resource && resource[0].podcast[0]">Media</h2>
				<!-- <img  v-for="r in resource[0].image_resource" class="img-responsive" :src="r.imatge" :alt="r.descImatge" :title="r.descImatge"></img> -->

				<!-- <iframe v-for="r in resource[0].video_resource" width="560" height="315" :src="r.urlVideo" frameborder="0" allowfullscreen></iframe> -->

				<!-- <iframe v-for="r in resource[0].podcast" width="100%" height="200" frameborder="0" allowfullscreen="" scrolling="no" :src="r.podCast"></iframe> -->
				<h2>{{formatedAddress}}</h2>
				<div id="map" ref="map"></div>
			</div>

			<!-- Columna secundaria -->
			<div v-if="resource" class="col-xs-12 col-sm-4 col-md-4 col-lg-4 resource-extras">
				<h1>FITXA TÈCNICA</h1>
				<!-- edats escolar recomenades -->
				<div v-if="resource[0].age[0]" class="resource-extras-tag">
					<h3> <i class="fa fa-users" aria-hidden="true"></i> Edats recomenades</i></h3>
					<p v-for="r in resource[0].age">{{r.codiEdat}}</p>
				</div>
				<!-- data inici i final -->
				<div v-if="dateIni && dateEnd"class="resource-extras-tag">
					<h3><i class="fa fa-calendar" aria-hidden="true"></i> Data inicial i final </h3>
					<p>{{dateIni}}</p>
					<p>{{dateEnd}}</p>
				</div>
				<!-- preu -->
				<div v-if="resource[0].gratuit || (resource[0].preuInferior && resource[0].preuSuperior)" class="resource-extras-tag">
					<h3><i class="fa fa-eur" aria-hidden="true"></i> Preu </h3>
					<p v-if="resource[0].gratuit === 1">gratuït</p>
					<p v-if="resource[0].gratuit === 0">{{resource[0].preuInferior}} €</p>
					<p v-if="resource[0].gratuit === 0">{{resource[0].preuSuperior}} €</p>
				</div>
				<!-- categories -->
				<div v-if="resource[0].category[0]" class="resource-extras-tag">
					<h3><i class="fa fa-archive" aria-hidden="true"></i> Categoria/es </h3>
					<p v-for="r in resource[0].category">{{r.codiCategoria}}</p>
				</div>
				<!-- etiquetes o tags -->
				<div v-if="resource[0].tag[0]" class="resource-extras-tag">
					<h3><i class="fa fa-tags" aria-hidden="true"></i> Etiquetes </h3>
					<p v-for="r in resource[0].tag">{{r.nomTags}}</p>
				</div>
				<!-- Links relacionats -->
				<div v-if="resource[0].link[0]" class="extras">
					<h3><i class="fa fa-link" aria-hidden="true"></i> Relacionats </h3>
					<!-- <p v-for="r in resource[0].link">{{r.link}}</p> -->
					<h4 v-for="r in resource[0].link">
						<a class="links":href="r.link" target="_blank" :title="r.link">{{r.link}}</a>
					</h4>
				</div>
				<div v-if="resource[0].entity[0]" class="extras">
				<!-- Logo entitat ** sin arreglar -->
					<h3 v-if="resource[0].entity[0].nomEntitat"><i class="fa fa-building" aria-hidden="true"></i> {{resource[0].entity[0].nomEntitat}}</h3>
					<!-- </br> -->
					<h4 v-if="resource[0].entity[0].descEntitat">{{resource[0].entity[0].descEntitat}}</h4>
					<h4 v-if="resource[0].entity[0].adreca"><strong>Adreça:</strong></br>{{resource[0].entity[0].adreca}}</h4>
					<h4 v-if="resource[0].entity[0].telf1 !== 0 && resource[0].entity[0].telf2 !== 0"><strong>Telefóns: </strong></br>{{resource[0].entity[0].telf1}} / {{resource[0].entity[0].telf2}}</h4>
					<h4 v-if="resource[0].entity[0].telf1 !== 0 && resource[0].entity[0].telf2 === 0"><strong>Telefón: </strong></br>{{resource[0].entity[0].telf1}}</h4>
					<h4 v-if="resource[0].entity[0].telf1 === 0 && resource[0].entity[0].telf2 !== 0"><strong>Telefón: </strong></br>{{resource[0].entity[0].telf2}}</h4>
					<!-- plana web -->
					<h4 v-if="resource[0].entity[0].link"><strong>Plana web:</strong></br><a class="links":href="resource[0].entity[0].link" target="_blank" :title="resource[0].entity[0].link">{{resource[0].entity[0].link}}</a></h4>
					<!-- <h3>Xarxes Socials</h3> -->
					<a class="socialMedia" v-if="resource[0].entity[0].twitter" :href="'https://twitter.com/'+ resource[0].entity[0].twitter" target="_blank" :title="'https://twitter.com/'+ resource[0].entity[0].twitter">
					   <i class="fa fa-twitter fa-3x"></i>
					</a>
					<a class="socialMedia" v-if="resource[0].entity[0].facebook" :href="'https://www.facebook.com/'+ resource[0].entity[0].facebook" target="_blank" :title="'https://facebook.com/'+ resource[0].entity[0].facebook">
					  <i class="fa fa-facebook fa-3x"></i>
					</a>
					<a class="socialMedia" v-if="resource[0].entity[0].instagram" :href="'https://www.instagram.com/'+ resource[0].entity[0].instagram" target="_blank" :title="'https://instagram.com/'+ resource[0].entity[0].instagram">
						<i class="fa fa-instagram fa-3x"></i>
					</a>
				</br>
				</div>

				<div class="banners">
					<h1>Banner</h1>
				</div>
			</div>
		
			<!-- Mapa recurso -->
			<!-- <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 resource-body">
				<h2>{{formatedAddress}}</h2>
				<div id="map" ref="map"></div>
			</div> -->
		</div>
	</div>
</template>

<script>

	export default{
		data(){
			return{
				image:'',
				formatedAddress: '',
				resource:null,
				dateIni:null,
				dateEnd:null,
				datePub:null
			}
		},
		// created(){
		// 	this.fetchResource(this.$route.params.id);
		// },
        mounted: function() {
            this.initMap(this.$route.params.id);
        },
		methods:{
			// fetchResource: function(id){
			// 	this.$http.get('../api/recursos/'+id).then(function(response){
			// 		this.resource = response.data.resource;
			// 		this.dateIni = response.data.dateIni;
			// 		this.dateEnd = response.data.dateEnd;
			// 		this.datePub = response.data.datePub;
			// 		console.log(this.resource);
			// 		console.log(this.dateIni);
			// 		console.log(this.dateEnd);
			// 		console.log(this.datePub);
			// 	});

			// },
			initMap: function(id) {

                this.$http.get('../api/recursos/'+id).then(function(response){
					this.resource = response.data.resource;
					this.dateIni = response.data.dateIni;
					this.dateEnd = response.data.dateEnd;
					this.datePub = response.data.datePub;

                    var myLatLng = {lat: parseFloat(response.data.resource[0].location.latitud), lng: parseFloat(response.data.resource[0].location.longitud)};

                    console.log(myLatLng);

                    this.map = new google.maps.Map(this.$refs.map , {
                        center: myLatLng,
                        scrollwheel: true,
                        zoom: 16
                    })

                    var marker = new google.maps.Marker({
                        position: myLatLng,
                        map: this.map,
                        title: 'Hello World!'
                    });

                    var getAddress = this.getAddress;

                    var latlng = response.data.resource[0].location.latitud + ',' + response.data.resource[0].location.longitud;

                    var url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' + latlng + '&sensor=false';

                        $.getJSON(url, function (data) {

                            getAddress(data);
                        });
                });
            },
            getAddress(data){
                this.formatedAddress = data.results[0].formatted_address;
            }
		}
	}
</script>
