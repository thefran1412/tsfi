<template>
	<div class="content-bottom-header">
		<h1>Enviar Recurs</h1>
		<form @submit.prevent="submitForm" ref="enviarRecurs" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="titol">Títol:</label>
				<input class="form-control title" type="text" id="titol" name="titol" placeholder="Títol">
			</div>
			<div class="form-group">
				<label for="subtitol">Subtítol:</label>
				<input class="form-control title" type="text" id="subtitol" name="subtitol" placeholder="Subtítol">
			</div>
			<div class="form-group">
				<label for="categoria">Escull una categoria:</label>
				<select class="selectpicker" id="categoria">
				  <option>Events</option>
				  <option>Tallers</option>
				  <option>Conferencies</option>
				  <option>Noticies</option>
				</select>
			</div>
			<div class="form-group">
			  <label for="descripciobreu">Descripció breu:</label>
			  <textarea class="form-control" rows="5" id="descripciobreu"></textarea>
			</div>
			<div class="form-group">
			  <label for="descripcio">Descripció:</label>
			  <textarea class="form-control" rows="5" id="descripcio"></textarea>
			</div>
			<div class="form-group">
				<div v-if="!image">
					<h4>Selecciona la imatge de portada del recurs:</h4>
				</div>
				<div v-if="image">
					<img :src="image" />
					<button @click="removeImageOne">Remove image</button>
				</div>
				<input name="image" type="file" @change="onFileChange($event,1)">
			</div>
			<div class="form-group">
				<div v-if="!image2">
					<h4>Selecciona la imatge que hi anirà l'article:</h4>
				</div>
				<div v-if="image2">
					<img :src="image2" />
					<button @click="removeImageTwo">Remove image</button>
				</div>
				<input name="image2" type="file" @change="onFileChange($event,2)">
			</div>
			<button class="btn btn-primary" type="submit">Enviar Recurs</button>
		</form>
	</div>
</template>


<script>
	export default{
		data(){
			return{
				image:'',
				image2: ''
			}
		},
		methods:{
			onFileChange(e, imgNum){

				var files = e.target.files || e.dataTransfer.files;

				if(files.length===1){
					if(files[0].type === 'image/png' || files[0].type === 'image/jpg'){
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

				
				reader.readAsDataURL(file);
			},
			removeImageOne: function (e){
				this.image = '';
			},
			removeImageTwo: function (e){
				this.image2 = '';
			},
			submitForm: function(){
				var form = this.$refs.enviarRecurs;
				var formdata = new FormData(form);

				console.log(form);
				console.log(formdata);

				// this.$http.post('api/submit', formdata).then((response) =>{
				// 	this.$router.push({path:'/', query:{alert:'Resource Send'}})
				// },(response)=>{
					
				// });
			}
		}
	}
</script>