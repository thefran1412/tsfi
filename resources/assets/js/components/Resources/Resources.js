export default{
		data(){
			return{
				image:'',
				formatedAddress: '',
				resource:null,
				dateIni:null,
				dateEnd:null,
				datePub:null,
				gallery:[],
				hours:{
					start:'',
					end:''
				},
				isMap:true,
				entity:true,
				imgMeta: '',
				urlMeta: '',
				descriptionMeta:'',
				titleMeta:''
			}
		},
		metaInfo() {
			return {
				meta: [
	              { name: 'twitter:title', content: this.titleMeta },
	              { name: 'twitter:description', content: this.descriptionMeta },
	              { name: 'twitter:creator', content:'@TSFI'},
	              { name: 'twitter:image', content: this.imgMeta },
	              { name: 'twitter:url', content: this.urlMeta },
	              { name: 'twitter:card', content: 'summary_large_image' }
	            ]
	        }
        },
        mounted: function() {
            this.initMap(this.$route.params.id);
        },
		methods:{
			initMap: function(id) {

                this.$http.get('api/recursos/'+id).then(function(response){
					
					this.resource = response.data.resource;
					this.dateIni = response.data.dateIni;
					this.dateEnd = response.data.dateEnd;
					this.datePub = response.data.datePub;

					var URLactual = window.location;

					this.imgMeta = URLactual.origin+'/projects/ts/img/image/'+this.resource[0].fotoResum;
					this.urlMeta = URLactual.href;
					this.descriptionMeta = this.resource[0].descDetaill1;
					this.titleMeta = this.resource[0].titolRecurs;

					if(this.resource[0].entity[0]){
						this.entity=true;
					}else{
						this.entity=false;
					}

					if(this.resource[0].dataInici && this.resource[0].dataFinal){
						var hourStart = this.resource[0].dataInici.split(' ')[1].split(':');
						var hourEnd = this.resource[0].dataFinal.split(' ')[1].split(':');
						this.hours.start = hourStart[0]+ ':' + hourStart[1];
						this.hours.end = hourEnd[0]+ ':' + hourEnd[1];

					} else if (this.resource[0].dataInici) {
						var hourStart = this.resource[0].dataInici.split(' ')[1].split(':');
						this.hours.start = hourStart[0]+ ':' + hourStart[1];
					} else if(this.resource[0].dataFinal){
						var hourEnd = this.resource[0].dataFinal.split(' ')[1].split(':');
						this.hours.end = hourEnd[0]+ ':' + hourEnd[1];
					}

					if(this.resource[0].location){

						var myLatLng = {lat: parseFloat(this.resource[0].location.latitud), lng: parseFloat(this.resource[0].location.longitud)};

						var map = new google.maps.Map(this.$refs.map , {
	                        center: myLatLng,
	                        scrollwheel: true,
	                        zoom: 16
	                    })

	                    var marker = new google.maps.Marker({
	                        position: myLatLng,
	                        map: map,
	                        title: 'Hello World!'
	                    });

	                    var getAddress = this.getAddress;

	                    var latlng = this.resource[0].location.latitud + ',' + this.resource[0].location.longitud;

	                    var url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' + latlng + '&sensor=false';

	                        $.getJSON(url, function (data) {

	                            getAddress(data);
	                        });
					}else{
						this.isMap = false;
					}
                });
            },
            getAddress(data){
                this.formatedAddress = data.results[0].formatted_address;
            }
		}
	}