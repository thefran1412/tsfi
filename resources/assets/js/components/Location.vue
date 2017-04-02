<template>
    <div class="content-bottom-header container">
        <div><h1>{{formatedAddress}}</h1></div>
        <div id="map" ref="map"></div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                formatedAddress: '',
            }
        },
        mounted: function() {
            this.initMap(1);
        },
        methods: {
            initMap: function(id) {

                this.$http.get('../api/recursos/'+id).then(function(response){

                    console.log(parseFloat(response.data.resource[0].location.latitud));

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

<style type="text/css">
   #map {height:300px;width:500px;}
 </style>