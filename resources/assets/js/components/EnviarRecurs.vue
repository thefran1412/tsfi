<template>
	<div class="content-bottom-header">
		<h1>Enviar Recurs</h1>
		<form @submit.prevent="submitForm" ref="enviarRecurs" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="titolRecurs">Títol:</label>
				<input class="form-control title" type="text" id="titolRecurs" name="titolRecurs" placeholder="Títol" required>
			</div>
			<div class="form-group">
				<label for="subTitol">Subtítol:</label>
				<input class="form-control title" type="text" id="subTitol" name="subTitol" placeholder="Subtítol" required>
			</div>
			<div class="form-group">
				<label for="categoria">Escull una categoria:</label>
				<select v-if="listCategories" class="form-control selectpicker" type="text" id="categoria" name="categoria">
				  <option v-for="ls in listCategories" :value="ls.categoria_id">{{ls.codiCategoria}}</option>
				</select>
			</div>
			<div class="form-group">
				<label for="target">Aquí va dirigit:</label>
				<select class="form-control selectpicker" type="text" id="target" name="target">
				  <option>Estudiants</option>
				  <option>Professors</option>
				</select>
			</div>
			<div class="form-group">
			  <label for="descBreu" required>Descripció breu:</label>
			  <textarea class="form-control" type="text" id="descBreu" name="descBreu"></textarea>
			</div>
			<div class="form-group">
			  <label for="descDetaill1">Descripció:</label>
			  <textarea class="form-control" type="text" id="descDetaill1" name="descDetaill1"></textarea>
			</div>
			<div class="form-group">
				<div v-if="!image">
					<h4>Selecciona l'imatge de portada del recurs:</h4>
				</div>
				<div v-if="image">
					<img :src="image" />
					<button @click="removeImage(1)">Remove image</button>
				</div>
				<input name="image" type="file" @change="onFileChange($event,1)">
			</div>
			<div class="form-group">
				<div v-if="!image2">
					<h4>Selecciona la primera imatge que hi anirà dins de l'article:</h4>
				</div>
				<div v-if="image2">
					<img :src="image2" />
					<button @click="removeImage(2)">Remove image</button>
				</div>
				<input name="image2" type="file" @change="onFileChange($event,2)">
			</div>
			<div class="form-group">
				<div v-if="!image3">
					<h4>Selecciona la segona imatge que hi anirà dins de l'article:</h4>
				</div>
				<div v-if="image3">
					<img :src="image3" />
					<button @click="removeImage(3)">Remove image</button>
				</div>
				<input name="image3" type="file" @change="onFileChange($event,3)">
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
				image2: '',
				image3: '',
				listCategories: []
			}
		},
		created(){
            this.fetchEntities();
        },
		methods:{
			fetchEntities(){
	            this.$http.get('../api/categories').then(response=>{
	                var p=[];
					response.data.categories.forEach(function(c){
						//console.log(this.listCategories);
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

				console.log(form);
				console.log(formdata);

				this.$http.post('../api/submit', formdata).then((response) =>{
					//this.$router.push({path:'/student/home', query:{alert:'User Create'}})
				},(response)=>{
					console.log(response);
				});
			}
		}
	}
</script>