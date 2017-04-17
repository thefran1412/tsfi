<template>
	<div class="content-bottom-header-resource" >
		<div id="resource" class="container">
			<div class="row">
				<!-- Columna principal -->
			<div  v-if="resource" class="col-xs-12 col-sm-8 col-md-8 col-lg-8 resource-body">
 				<!--  Foto resum-->
				<div v-if="resource[0].fotoResum" class="resource-img-resum" :style="{ backgroundImage: 'url(/img/image/' + resource[0].fotoResum + ')' }">
					<div class="resource-title-sub">
						<h1 v-if="resource[0].titolRecurs" >{{resource[0].titolRecurs}}</h1>
						<h3 v-if="resource[0].subTitol" >{{resource[0].subTitol}}</h3>
					</div>
				</div>
				<!-- autor i data publicació-->
				<div class="autor">
					<h5><strong>Autor: </strong> {{resource[0].creatPer}} <p><strong class="publish-date"> Publicat el:</strong> {{datePub}}</p></h5>
				</div>
				<h2>{{resource[0].subtitol}}</h2>
				<p><strong>{{resource[0].descBreu}}</strong></p>
					<div v-if="resource[0].image_resource > 0" class="col-md-10 col-md-offset-2 img-resource">
						<img class="img-responsive" :src="'/img/image/'+resource[0].image_resource[0].imatge" :alt="resource[0].image_resource[0].descImatge" :title="resource[0].image_resource[0].descImatge"></img>
					</div>
				<p>{{resource[0].descDetaill1}}</p>
					<div v-if="resource[0].image_resource.length > 0" class="col-md-10 col-md-offset-2 img-resource">
						<img class="img-responsive" :src="'/img/image/'+resource[0].image_resource[1].imatge" :alt="resource[0].image_resource[1].descImatge" :title="resource[0].image_resource[1].descImatge"></img>
					</div>
				<p>{{resource[0].descDetaill2}}</p>
				
				<div class="row">
					<div class="col-md-12 videos-list-resource">
					<iframe v-for="r in resource[0].video_resource" width="100%" height="315" :src="r.urlVideo" frameborder="0" allowfullscreen></iframe>
					</div>
				</div>
			</div>
			<!-- Columna secundaria -->
			<div v-if="resource" class="col-xs-12 col-sm-4 col-md-4 col-lg-4 resource-extras">
				<!-- edats escolar recomenades -->
				<div v-if="resource[0].age[0]" class="resource-extras-tag">
					<span>Edats recomenades:</span>
					<p v-for="r in resource[0].age">{{r.descEdat}}</p>
				</div>
				<!-- data inici i final -->
				<div v-if="dateIni || dateEnd"class="resource-extras-tag">
					<span>Data:</span>
					<p>{{dateIni}}</p>
					<p v-if="dateEnd" >al</p>
					<p v-if="dateEnd">{{dateEnd}}</p>
				</div>
				<div v-if="resource[0].dataInici || resource[0].dataFinal"class="resource-extras-tag">
					<span>Horari de l'event:</span>
					<p v-if="resource[0].dataInici" >{{hours.start}}</p>
					<p v-if="resource[0].dataFinal" >a</p>
					<p v-if="resource[0].dataFinal" >{{hours.end}}</p>
				</div>
				<!-- preu -->
				<div v-if="resource[0].gratuit || resource[0].preuInferior" class="resource-extras-tag">
					<span>Preu:</span>
					<p v-if="resource[0].gratuit === 1">Gratuït</p>
					<p v-if="resource[0].gratuit === 0">{{resource[0].preuInferior}} €</p>
				</div>
				<!-- categories -->
				<div v-if="resource[0].category[0]" class="resource-extras-tag">
					<span>Categoria:</span>
					<p v-for="r in resource[0].category">{{r.codiCategoria}}</p>
				</div>
				<!-- etiquetes o tags -->
				<div v-if="resource[0].tag[0]" class="resource-extras-tag">
					<span>Tags:</span>
					<a v-bind:href="'#/search?tag='+ r.tags_id" v-for="r in resource[0].tag" ><p class="tag-rounded-resource">{{r.nomTags}}</p></a>
				</div>
				<!-- Links relacionats -->
				<div v-if="resource[0].link[0]" class="resource-extras-tag links-extra-tags">
					<span>Links Relacionats:</span>
					<span v-for="r in resource[0].link">
						<a class="links":href="r.link" target="_blank" :title="r.link">{{r.descLink}}</a>
					</span>
				</div>
				<div v-if="resource[0].entity[0]" class="extras">
					<a class="socialMedia" v-if="resource[0].entity[0].twitter" :href="'https://twitter.com/'+ resource[0].entity[0].twitter" target="_blank" :title="'https://twitter.com/'+ resource[0].entity[0].twitter">
					   <i class="fa fa-twitter fa-3x"></i>
					</a>
					<a class="socialMedia" v-if="resource[0].entity[0].facebook" :href="'https://www.facebook.com/'+ resource[0].entity[0].facebook" target="_blank" :title="'https://facebook.com/'+ resource[0].entity[0].facebook">
					  <i class="fa fa-facebook fa-3x"></i>
					</a>
					<a class="socialMedia" v-if="resource[0].entity[0].instagram" :href="'https://www.instagram.com/'+ resource[0].entity[0].instagram" target="_blank" :title="'https://instagram.com/'+ resource[0].entity[0].instagram">
						<i class="fa fa-instagram fa-3x"></i>
					</a>
				</div>
			</div>

			<div v-show="entity" v-if="resource" class="col-xs-12 col-sm-4 col-md-4 col-lg-4 resource-extras">
				<div v-if="resource[0].entity[0]" class="resource-extras-tag">
					<span>Entitat:</span>
					<p>{{resource[0].entity[0].nomEntitat}}</p>
				</div>

				<div v-if="resource[0].entity[0]" class="resource-extras-tag">
					<span>Adreça:</span>
					<p v-if="resource[0].entity[0].adreca">{{resource[0].entity[0].adreca}}</p>
				</div>

				<div v-if="resource[0].entity[0]" class="resource-extras-tag">
					<span>Telefons:</span>
					<p v-if="resource[0].entity[0].telf1 !== 0 && resource[0].entity[0].telf2 !== 0">{{resource[0].entity[0].telf1}} / {{resource[0].entity[0].telf2}}</p>
				</div>

				<div v-if="resource[0].entity[0]" class="resource-extras-tag">
					<span>Web:</span>
					<p v-if="resource[0].entity[0].link" >
						<a class="links":href="resource[0].entity[0].link" target="_blank" :title="resource[0].entity[0].link">{{resource[0].entity[0].link}}</a>
					</p>
				</div>
			</div>

			<!-- Mapa recurso -->
			<div  v-show="isMap" class="col-xs-12 col-sm-4 col-md-4 col-lg-4 resource-extras">
				<span>Localització de l'Event:</span>
				<p >{{formatedAddress}}</p>
				<div id="map" ref="map"></div>
			</div>
			</div>
		</div>
	</div>
</template>

<script src="./Resources.js" ></script>