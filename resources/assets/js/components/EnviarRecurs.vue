<template>
	<div class="content-bottom-header container content-send-resource">
		<h1>Enviar Recurs</h1>
		<form @submit.stop.prevent="submitForm" ref="enviarRecurs" method="post" enctype="multipart/form-data">
			<div class="form-group" :class="{'has-error' : errors.has('titolRecurs') }">
				<label for="titolRecurs">Títol:</label>
				<span v-show="errors.has('titolRecurs')" class="help is-danger">{{ errors.first('titolRecurs') }}</span>	
					<input v-validate="'required|max:90'" class="form-control title" type="text" id="titolRecurs" data-vv-as="Títol" name="titolRecurs" placeholder="Títol">
			</div>
			<div class="form-group" :class="{'has-error' : errors.has('subTitol') }">
				<label for="subTitol">Subtítol:</label>
				<span v-show="errors.has('subTitol')" class="help is-danger">{{ errors.first('subTitol') }}</span>	
					<input v-validate="'required|max:150'" class="form-control title" type="text" id="subTitol" data-vv-as="Subtítol" name="subTitol" placeholder="Subtítol">
			</div>
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
				</v-select>
			</div>
			<div class="row">
				<div class="col-md-6">
				<div class="form-group">
						<label for="categoria">Escull una categoria:</label>
						<select v-if="listCategories" class="form-control selectpicker" type="text" id="categoria" name="categoria">
						  <option v-for="ls in listCategories" :value="ls.categoria_id">{{ls.codiCategoria}}</option>
						</select>
				</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
							<label for="target">Aquí va dirigit:</label>
							<select class="form-control selectpicker" type="text" id="target" name="target">
							  <option>Estudiants</option>
							  <option>Professors</option>
							</select>
					</div>
				</div>
			</div>
			<div class="form-group">
			  <label for="descBreu" required>Descripció breu:</label>
			  <textarea class="form-control" type="text" id="descBreu" name="descBreu" placeholder="Descripció breu"></textarea>
			</div>
			<div class="form-group" :class="{'has-error' : errors.has('descDetaill1') }">
				<label for="descDetaill1">Descripció:</label>
				<span v-show="errors.has('descDetaill1')" class="help is-danger">{{ errors.first('descDetaill1') }}</span>	
					<textarea v-validate="'required|max:5000'" class="form-control title" type="text" id="descDetaill1" data-vv-as="Descripció" name="descDetaill1" placeholder="Descripció"></textarea>
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
							<img :src="image" />
							<button class="remove-image" @click="removeImage(1)">Eliminar imatge</button>
						</div>
						<input v-validate="'size:20'" name="image" data-vv-as="image" type="file" @change="onFileChange($event,1)">
						<span v-show="errors.has('image')" class="help is-danger">{{ errors.first('image') }}</span>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group" :class="{'has-error' : errors.has('image2') }">
						<div v-if="!image2">
							<h4>Selecciona la primera imatge que hi anirà dins de l'article:</h4>
						</div>
						<div v-if="image2">
							<img :src="image2" />
							<button class="remove-image" @click="removeImage(2)">Eliminar imatge</button>
						</div>
						<input v-validate="'size:2048'" name="image2" data-vv-as="image2" type="file" @change="onFileChange($event,2)">
						<span v-show="errors.has('image2')" class="help is-danger">{{ errors.first('image2') }}</span>	
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group" :class="{'has-error' : errors.has('image3') }">
						<div v-if="!image3">
							<h4>Selecciona la segona imatge que hi anirà dins de l'article:</h4>
						</div>
						<div v-if="image3">
							<img :src="image3" />
							<button class="remove-image" @click="removeImage(3)">Eliminar imatge</button>
						</div>
						<input v-validate="'size:2048'" name="image3" data-vv-as="image3" type="file" @change="onFileChange($event,3)">
						<span v-show="errors.has('image3')" class="help is-danger">{{ errors.first('image3') }}</span>	
					</div>
				</div>
			</div>
			<div class="col-md-12 button-send">
				<button class="btn btn-primary" type="submit">Enviar Recurs</button>
			</div>	
		</form>
	</div>
</template>

<script>

import vSelect from "vue-select";

	export default{
		components: {vSelect},
		data(){
			return{
				image:'',
				image2: '',
				image3: '',
				latitude: null,
				longitude: null,
				listCategories: [],
				selected: null,
				options:[],
				tagsSelected:[]
			}
		},
		created(){
            this.fetchEntities();
        },
        mounted: function() {
            this.initMap();
        },
		methods:{
			fetchEntities(){
	            this.$http.get('api/categories').then(response=>{
	                var p=[];
					response.data.categories.forEach(function(c){

						console.log(c.categoria_id !== 6);
							if(c.categoria_id !== 6){
								p.push(c);
							}
					});

					this.listCategories = p;
					console.log(this.listCategories);

	            })
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
			createImage(file, imgNum){
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

				if (v === 1) {
					this.image = '';
				};

				if (v === 2) {
					this.image2 = '';
				};

				if (v === 3) {
					this.image3 = '';
				};
				
			},
			submitForm: function(){
					var form = this.$refs.enviarRecurs;
					var formdata = new FormData(form);

					this.$validator.validateAll().then(() => {

						var concatIdTags = '';
						
						if(this.tagsSelected.length > 0){
							this.tagsSelected.forEach(function(data){
								concatIdTags += '#' + data.tags_id;
							});
							var splitPr = concatIdTags.substr(1).split('#');
						}

						this.$http.post('api/submit?tags='+ splitPr, formdata).then((response) =>{
							//this.$router.push({path:'/student/home', query:{alert:'User Create'}})
						},(response)=>{
							console.log(response);
						});		
						alert('Recurs enviat')
					}).catch((e) => {

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
			    this.$http.get('api/tags?q='+search, {
			       q: search
			    }).then(resp => {
			    	console.log(resp.data.tags);
			       this.options = resp.data.tags;
			       loading(false)
			    })
			},
			addTag (newTag) {
				console.log(newTag);
		      const tag = {
		        name: newTag,
		        code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
		      }
		      this.options.push(tag)
		      this.tagsSelected.push(tag);
		    }
		}
	}
</script>