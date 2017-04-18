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
				prueba:'mensaje',
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
		render (createElement) {
    return createElement('h1', {}, 'Hello World')
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
						this.required = true;
						this.messageHeader = "Advertència!"
						this.messageBody = "L'Arxiu ha de ser JPG o PNG.";
						this.showModal = true;
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
							this.messageBody = "El recurs s'ha enviat correctament. El revisarem en 72h.";
							this.showModal = true;
						},(response)=>{
						});
						
					}).catch((e) => {
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