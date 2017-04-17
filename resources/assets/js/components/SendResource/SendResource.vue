<template>
	<div class="content-bottom-header container content-send-resource">
		<div class="col-md-offset-1 col-md-10">
			<div class="tags">
				<div class="panel">
					<h3 v-html="rawHtml" >Enviar Recurs</h3>
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

<script src="./SendResource.js" ></script>