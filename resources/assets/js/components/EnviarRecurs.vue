<template>
	<div class="content-bottom-header container content-send-resource">
		<div class="col-md-offset-1 col-md-10">
			<div class="tags">
				<div class="panel">
					<h3>Enviar Recurs</h3>
					<hr>
					<form @submit.stop.prevent ref="enviarRecurs" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group" :class="{'has-error' : errors.has('titolRecurs') }">
									<label v-show="!errors.has('titolRecurs')" for="titolRecurs">Títol:</label>
									<span v-show="errors.has('titolRecurs')" class="help is-danger">{{ errors.first('titolRecurs') }}</span>	
										<input v-validate="'required|max:90'" class="form-control title" type="text" id="titolRecurs" data-vv-as="Títol" name="titolRecurs" placeholder="Títol">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group" :class="{'has-error' : errors.has('subTitol') }">
									<label v-show="!errors.has('subTitol')" for="subTitol">Subtítol:</label>
									<span v-show="errors.has('subTitol')" class="help is-danger">{{ errors.first('subTitol') }}</span>	
										<input v-validate="'required|max:150'" class="form-control title" type="text" id="subTitol" data-vv-as="Subtítol" name="subTitol" placeholder="Subtítol">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<v-select
										multiple
										:value="selected"
										:debounce="250"
										:on-search="getOptions"
										:options="options"
										v-model="tagsSelected"
										placeholder="Agrega tags relacionats amb el recurs..."
										label="nomTags"
									>
									<span slot="no-options">No coincideix cap opció. Cerca!</span>
									</v-select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
							<div class="form-group">
									<label for="categoria">Escull una categoria:</label>
									<select v-if="listCategories" class="form-control selectpicker" type="text" id="categoria" name="categoria">
									  <option v-for="ls in listCategories" :value="ls.categoria_id">{{ls.codiCategoria}}</option>
									</select>
							</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
										<label for="target">Aquí va dirigit:</label>
										<select class="form-control selectpicker" type="text" id="target" name="target">
										  <option v-for="lt in listTargets" :value="lt.targets_id">{{lt.target}}</option>
										</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group" :class="{'has-error' : errors.has('creatPer') }">
										<label v-show="!errors.has('creatPer')" for="creatPer">Escriu el teu nom:</label>
										<span v-show="errors.has('creatPer')" class="help is-danger">{{ errors.first('creatPer') }}</span>
										<input v-validate="'required'" class="form-control title" type="text" id="creatPer" data-vv-as="Nom" name="creatPer" placeholder="Nom">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Data que vols publicar:</label>
									<date-picker :date="date" :option="option" ></date-picker>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Data de Inici de l'event:</label>
									<date-picker :date="dateIn" :option="optionData" ></date-picker>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Data final de l'event:</label>
									<date-picker :date="dateEnd" :option="optionData" ></date-picker>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group" :class="{'has-error' : errors.has('preuInferior') }">
										<label v-show="!errors.has('preuInferior')" for="preuInferior">Escriu el preu si en té:</label>
										<span v-show="errors.has('preuInferior')" class="help is-danger">{{ errors.first('preuInferior') }}</span>
										<input v-validate="'decimal:2'" class="form-control title" type="text" id="preuInferior" data-vv-as="Preu" name="preuInferior" placeholder="Preu">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="rangEdat">Escull un rang d'Edat:</label>
									<select v-if="listCategories" class="form-control selectpicker" type="text" id="rangEdat" name="rangEdat">
									  <option v-for="la in listAges" :value="la.edats_id">{{la.descEdat}}</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  <label for="descBreu" required>Descripció breu:</label>
								  <textarea class="form-control" type="text" id="descBreu" name="descBreu" placeholder="Descripció breu"></textarea>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group" :class="{'has-error' : errors.has('descDetaill1') }">
									<label v-show="!errors.has('descDetaill1')" for="descDetaill1">Descripció:</label>
									<span v-show="errors.has('descDetaill1')" class="help is-danger">{{ errors.first('descDetaill1') }}</span>	
										<textarea v-validate="'required|max:5000'" class="form-control title" type="text" id="descDetaill1" data-vv-as="Descripció" name="descDetaill1" placeholder="Descripció"></textarea>
								</div>
							</div>
						</div>
						
						
						<div class="form-group">
							<label for="pac-input" required>Si l'event te una localització:</label>
							
							<input id="pac-input" class="form-control title" type="text"
				            placeholder="Introdueix la direcció">
				            <div id="map" ref="map" ></div>
						</div>
						<div class="form-group location-address">
							<input id="latitude" name="latitude" type="text" :value="latitude">
							<input id="longitude" name="longitude" type="text" :value="longitude">
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group" :class="{'has-error' : errors.has('image') }">
									<div v-if="!image">
										<h4>Selecciona l'imatge de portada del recurs:</h4>
									</div>
									<div v-if="image">
										<img :src="image" id="image1" />
										<button class="btn btn-default remove-image" @click="removeImage(1)">Eliminar imatge</button>
									</div>
									<input id="input1" v-validate="'size:2048'" name="image" data-vv-as="image" type="file" @change="onFileChange($event,1)">
									<span v-show="errors.has('image')" class="help is-danger">{{ errors.first('image') }}</span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group" :class="{'has-error' : errors.has('image2') }">
									<div v-if="!image2">
										<h4>Selecciona la primera imatge que hi anirà dins de l'article:</h4>
									</div>
									<div v-if="image2">
										<img :src="image2" id="image2" />
										<button class="btn btn-default remove-image" @click="removeImage(2)">Eliminar imatge</button>
									</div>
									<input id="input2" v-validate="'size:2048'" name="image2" data-vv-as="image2" type="file" @change="onFileChange($event,2)">
									<span v-show="errors.has('image2')" class="help is-danger">{{ errors.first('image2') }}</span>	
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group" :class="{'has-error' : errors.has('image3') }">
									<div v-if="!image3">
										<h4>Selecciona la segona imatge que hi anirà dins de l'article:</h4>
									</div>
									<div v-if="image3">
										<img :src="image3" id="image3" />
										<button class="btn btn-default remove-image" @click="removeImage(3)">Eliminar imatge</button>
									</div>
									<input id="input3" v-validate="'size:2048'" name="image3" data-vv-as="image3" type="file" @change="onFileChange($event,3)">
									<span v-show="errors.has('image3')" class="help is-danger">{{ errors.first('image3') }}</span>	
								</div>
							</div>
						</div>
					</form>
					<div class="col-md-12 button-send">
							<button @click="submitForm" class="btn btn-primary btn-send" type="submit">Enviar Recurs</button>
					</div>
				</div>
			</div>
		</div>
		
		<!-- template for the modal component -->
		<script type="text/x-template" id="modal-template">
		  <transition name="modal">
		    <div class="modal-mask">
		      <div class="modal-wrapper">
		        <div class="modal-container">

		          <div class="modal-header" >
		            <slot name="header">
		              default header
		            </slot>
		          </div>

		          <div class="modal-body">
		            <slot name="body" >
		              default body
		            </slot>
		          </div>

		          <div class="modal-footer">
		            <slot name="footer">
		              <button class="btn btn-default modal-default-button" @click="$emit('close')">
		                Tancar
		              </button>
		            </slot>
		          </div>
		        </div>
		      </div>
		    </div>
		  </transition>
		</script>
		<modal v-if="showModal" @close="showModal = false" >
			<h3 slot="header" :class="{'requiredModal' : required }" >{{messageHeader}}</h3>
			<span slot="body">{{messageBody}}</span>
			<span slot="footer" v-if="!required">
	              <button class="btn btn-default modal-default-button" @click="close($event)">
	                Tancar
	              </button>
		    </span>
		</modal>
</template>

<script>

import vSelect from "vue-select";
import myDatepicker from 'vue-datepicker';

	export default{
		components: {vSelect,'date-picker': myDatepicker},
		data(){
			return{
				image:'',
				image2: '',
				image3: '',
				latitude: null,
				longitude: null,
				listCategories: [],
				listTargets:[],
				listAges:[],
				selected: null,
				options:[],
				tagsSelected:[],
				showModal: false,
				required:false,
				messageBody:'',
				messageHeader:'',
				dateEnd:{
					time:''
				},
				dateIn:{
					time:''
				},
				date: {
				  time: '' // string 
				},
		      	option: {
			        type: 'day',
			        week: ['Dil', 'Dima', 'Dime', 'Dij', 'Div', 'Dis', 'Diu'],
			        month: ['Gener', 'Febrer', 'Març', 'Abril', 'Maig', 'Juny', 'Juliol', 'Agost', 'Setembre', 'Octubre', 'Novembre', 'Decembre'],
			        format: 'DD-MM-YYYY',
			        placeholder: 'Data de publicació',
			        inputStyle: {
			          'display':'block',
			          'width':'100%',
			          'height':'36px',
			          'padding': '6px 12px',
			          'line-height': '1.6',
			          'font-size': '14px',
			          'border': '1px solid #ccd0d2',
			          'background-color':'#fff',
			          'box-shadow': '0 1px 1px 0 rgba(0, 0, 0, 0.075)',
			          'border-radius': '2px',
			          'color': '#555555'
			        },
			        color: {
			          header: '#333333',
			          headerText: '#4FC08D'
			        },
			        buttons: {
			          ok: "",
			          cancel: ''
			        },
			        limit: {
					  type:'fromto',
					  from:'2017-04-15',
					  to:'2017-04-21'
					}
			      },
			      optionData: {
			        type: 'min',
			        week: ['Dil', 'Dima', 'Dime', 'Dij', 'Div', 'Dis', 'Diu'],
			        month: ['Gener', 'Febrer', 'Març', 'Abril', 'Maig', 'Juny', 'Juliol', 'Agost', 'Setembre', 'Octubre', 'Novembre', 'Decembre'],
			        format: 'DD-MM-YYYY HH:mm',
			        placeholder: 'Data de publicació',
			        inputStyle: {
			          'display':'block',
			          'width':'100%',
			          'height':'36px',
			          'padding': '6px 12px',
			          'line-height': '1.6',
			          'font-size': '14px',
			          'border': '1px solid #ccd0d2',
			          'background-color':'#fff',
			          'box-shadow': '0 1px 1px 0 rgba(0, 0, 0, 0.075)',
			          'border-radius': '2px',
			          'color': '#555555'
			        },
			        color: {
			          header: '#333333',
			          headerText: '#4FC08D'
			        },
			        buttons: {
			          ok: "D'acord",
			          cancel: 'Cancelar'
			        }
			      }
			}
		},
		created(){
            this.fetchEntities();
            this.fetchTargets();
            this.fetchAges();
        },
        mounted: function() {
            this.initMap();
        },
		methods:{
			fetchAges(){
				this.$http.get('../api/ages').then(response=>{
	                var p=[];
					response.data.ages.forEach(function(t){
						p.push(t);
					});
					this.listAges = p;
					console.log(this.listAges);
				})
			},
			fetchTargets(){
				this.$http.get('../api/targets').then(response=>{
	                var p=[];
					response.data.targets.forEach(function(t){
						p.push(t);
					});
					this.listTargets = p;
				})
			},
			fetchEntities(){
	            this.$http.get('../api/categories').then(response=>{
	                var p=[];
					response.data.categories.forEach(function(c){
							if(c.categoria_id !== 6){
								p.push(c);
							}
					});

					this.listCategories = p;

	            })
            },
		    close: function(e) {
		      	var typeUser = localStorage.getItem("typeUser");
				this.$router.push({path:'/'+typeUser+'/home'});
		    },
			onFileChange(e, imgNum){

				var files = e.target.files || e.dataTransfer.files;

				if(files.length===1){
					if(files[0].type === 'image/png' || files[0].type === 'image/jpeg'){
							return this.createImage(files[0], imgNum);
					}else{
						alert("L'arxiu a de ser .jpg o .png");
					}
					
				}
			},
			createImage(file, imgNum) {

				var image = new Image();
				var reader = new FileReader();
				var vm = this;

				if(imgNum === 1){
					reader.onload = (e) => {
						this.image = e.target.result;
					}
				}

				if(imgNum === 2){
					reader.onload = (e) => {
						this.image2 = e.target.result;
					}
				}

				if(imgNum === 3){
					reader.onload = (e) => {
						this.image3 = e.target.result;
					}
				}

				reader.readAsDataURL(file);
			},
			removeImage: function (v){

				if(v === 1){
					this.image = '';
				}

				if(v === 2){
					this.image2 = '';
				}

				if(v === 3){
					this.image3 = '';
				}

				$('#input' + v ).val("");
				$('#image' + v ).attr("src","");

				this.$validator.validateAll().then(() => {
				}).catch((e) => {});
			},
			submitForm: function(){
					var form = this.$refs.enviarRecurs;
					var formdata = new FormData(form);

					this.$validator.validateAll().then(() => {

						var concatIdTags = '';
						var splitPr,url,datePubli;

						
						if(this.tagsSelected.length > 0){
							this.tagsSelected.forEach(function(data){
								concatIdTags += '#' + data.tags_id;
							});
							splitPr = concatIdTags.substr(1).split('#');
							url = '../api/submit?tags='+ splitPr;
						}else{
							url = '../api/submit';
						}

						if(this.date.time !== ''){
							var arr = this.date.time.split('-');
							datePubli = arr[2]+'-'+arr[1]+'-'+arr[0];

							if(url.indexOf('tags') > 0){
								url += '&date='+datePubli;
							}else{
								url += '?date='+datePubli;
							}
						}

						if(this.date.time === ''){
							var today = new Date();
							var tomorrow = new Date(today.getTime() + (24 * 60 * 60 * 3000));
							var res = tomorrow.toISOString().slice(0,10).replace(/-/g,"-");
							
							if(url.indexOf('tags') > 0){
								url += '&date='+res;
							}else{
								url += '?date='+res;
							}
						}

						if(this.dateIn.time !== '' && this.dateEnd.time !== ''){
								var dateStart = this.dateIn.time.split(' ');
								var dateEnd = this.dateEnd.time.split(' ');
								var arrStart = dateStart[0].split('-');
								var arrEnd = dateEnd[0].split('-');
								var dateS = arrStart[2]+'-'+arrStart[1]+'-'+arrStart[0] +' '+ dateStart[1]+':'+'00';
								var dateE = arrEnd[2]+'-'+arrEnd[1]+'-'+arrEnd[0] +' ' + dateEnd[1]+':'+'00';

								if(url.indexOf('tags') > 0 || url.indexOf('date') > 0){
									url += '&dateStart=' + dateS + '&dateEnd=' + dateE;
								}else{
									url += '?dateStart=' + dateS + '&dateEnd=' + dateE;
								}

						}else if(this.dateIn.time !== ''){
								var dateStart = this.dateIn.time.split(' ');
								var arrStart = dateStart[0].split('-');
								var dateS = arrStart[2]+'-'+arrStart[1]+'-'+arrStart[0] +' '+ dateStart[1]+':'+'00';

								if(url.indexOf('tags') > 0 || url.indexOf('date') > 0){
									url += '&dateStart=' + dateS;
								}else{
									url += '?dateStart=' + dateS;
								}
						}

						this.$http.post(url, formdata).then((response) =>{
							this.required = false;
							this.messageHeader = "Tot correcte!"
							this.messageBody = "El recurs s'ha enviat correctament. El revisarem en 48h.";
							this.showModal = true;
						},(response)=>{
						});
						
					}).catch((e) => {
						console.log(e);
							this.required = true;
							this.messageHeader = "Advertència!"
							this.messageBody = "T'has deixat un dels camps requerids sence completar o l'imatge es massa gran.";
							this.showModal = true;
					});
				
			},
			initMap: function(event) {

                 var myLatLng = {lat: 41.366438452538, lng: 2.0970153808594};

                 var map = new google.maps.Map(this.$refs.map , {
                    center: myLatLng,
                    scrollwheel: false,
                    zoom: 16
                 })

                  var input = document.getElementById('pac-input');

                  google.maps.event.addDomListener(input, 'keydown', function(e) { 
				    if (e.keyCode == 13) { 
				        e.preventDefault();
				        e.stopPropagation(); 
				    }
				});

                  var autocomplete = new google.maps.places.Autocomplete(input);
                  autocomplete.bindTo('bounds', map);

                  var infowindow = new google.maps.InfoWindow();

                  var marker = new google.maps.Marker({
                    map: map
                  });

                  marker.addListener('click', function() {
                    infowindow.open(map, marker);
                  });

                  var getLocation = this.getLocation;

                  autocomplete.addListener('place_changed', function() {

                    infowindow.close();
                    var place = autocomplete.getPlace();

                    if (!place.geometry) {
                      return;
                    }

                    if (place.geometry.viewport) {
                      map.fitBounds(place.geometry.viewport);
                    } else {
                      map.setCenter(place.geometry.location);
                      map.setZoom(17);
                    }

                    marker.setPlace({
                      placeId: place.place_id,
                      location: place.geometry.location
                    });

                    marker.setVisible(true);

                    getLocation(place);

                    infowindow.setContent('<div><strong>' + place.name + '</strong><br>'+ '<br>' +
                        place.formatted_address);
                    infowindow.open(map, marker);
                  });
            },
            getLocation(place){
            	this.latitude = place.geometry.location.lat();
                this.longitude = place.geometry.location.lng();
            },
            getOptions(search, loading) {
			    loading(true)
			    this.$http.get('../api/tags?q='+search, {
			       q: search
			    }).then(resp => {
			       this.options = resp.data.tags;
			       loading(false)
			    })
			}
		}
	}
</script>