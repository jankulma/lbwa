<style scoped>
	.card {
		margin-bottom: 2rem;
	}
</style>

<template>

	<div class="col-12 col-lg-6 mb-5 pb-5">
		
			<div class="card">

				<div class="card-header">
					Polski
				</div>

				<div class="card-body">

					<form>
						<div class="row">
							<div class="form-group col">
								<input v-model="project.title_pl" type="text" class="form-control" placeholder="Tytuł">
							</div>
						</div>
						<div class="row">
							<div class="form-group col">
								<vue-editor id="editorPl" v-model="project.description_pl" :placeholder="'Opis'" maxlength="50"></vue-editor>
							</div>
						</div>
					</form>

				</div>

			</div>

			<div class="card">

				<div class="card-header">
					English
				</div>

				<div class="card-body">

					<form>
						<div class="row">
							<div class="form-group col">
								<input v-model="project.title_en" type="text" class="form-control" placeholder="Title">
							</div>
						</div>
						<div class="row">
							<div class="form-group col">
								<vue-editor id="editorEn" v-model="project.description_en" :placeholder="'Description'"></vue-editor>
							</div>
						</div>
					</form>

				</div>

			</div>

			<div class="card">

				<div class="card-header">
					Photos
				</div>

				<div class="card-body">

					<image-manager :wantImages="askForImages" :project="project" @sendingFiles="receiveImages"></image-manager>

				</div>

			</div>

			<div>
				<button @click="wantToSave" class="btn btn-primary pull-right">Save Project <ajax-spinner v-show="ongoingAjax"></ajax-spinner></button>
			</div>

			<small class="form-text text-danger">
			    {{ ajaxResult }}
			</small>
	
		</div>
					
</template>

<script>
import { VueEditor } from 'vue2-editor';

export default {
	props: ['project'],

	components: {
		VueEditor
	},

	data() {
		return {
			askForImages: false,
			ongoingAjax: false,
			ajaxResult: '',
			images: [],
			formData: {},
		}
	},

	methods: {

		wantToSave() {
			this.ongoingAjax = true;
			this.askForImages = true;
		},

		receiveImages(images) {
			this.askForImages = false;
			this.images = images;
			this.formRequestData();
			this.sendProject();
		},

		formRequestData() {
			let formData = new FormData();

			formData.append('title_pl', this.project.title_pl);
			formData.append('description_pl', this.project.description_pl);
			formData.append('title_en', this.project.title_en);
			formData.append('description_en', this.project.description_en);
			for (var i = this.images.length - 1; i >= 0; i--) {
				formData.append(i, this.images[i].file);
			}

			if (this.project.hasOwnProperty('id')) {
				formData.append('id', this.project.id);
			}

			this.formData = formData;
		},

		sendProject() {
			let vm = this;

			axios.post('/project', this.formData, {
				headers: {
					'Content-Type': 'multipart/form-data'
				}
			})
			.then(function(response) {
				vm.ongoingAjax = false;
				vm.eventHub.$emit('workChanged', {newJob: 'projectCreated'});
			})
			.catch(function(error) {
				console.log(error);
				vm.ongoingAjax = false;
				vm.ajaxResult = error.response.data.message;
			});
		}
	}
}
</script>