<style scoped>
	.card {
		margin-bottom: 2rem;
	}
	img {
		max-width: 100%;
		margin: 1rem 0;
	}
</style>

<template>
	<div class="col-12 col-lg-6 mb-5 pb-5">
		
		<div class="card">

			<div class="card-header">
				First Page Image
			</div>

			<div class="card-body">

				<a href="#" @click.prevent="addPhoto">Change Photo</a>
				<input type="file" class="d-none" ref="fileInput" @change="fileInserted($event)">

				<div>
					<img :src="imageUrl">					
				</div>

			</div>

		</div>

		<div>
			<button @click="update" class="btn btn-primary pull-right">Update <ajax-spinner v-show="ongoingAjax"></ajax-spinner></button>
		</div>

		<small class="form-text" :class="ajaxResultClass">
		    {{ ajaxResult }}
		</small>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				imageUrl: '',
				file: '',
				ongoingAjax: false,
				ajaxResult: '',
				ajaxResultClass: '',
			}
		},

		created() {
			this.imageUrl = this.getImage();
		},

		methods: {
			addPhoto() {
				this.$refs.fileInput.click();
			},

			fileInserted(e) {
				let file = e.target.files[0];
				this.createPreview(file);
				this.file = file;
			},

			createPreview(file) {
				let reader = new FileReader();
				let vm = this;

				reader.onload = (e) => {
					vm.imageUrl = e.target.result;
				};

				reader.readAsDataURL(file);
			},

			getImage() {
				let vm = this;

				axios.get('/backend/first_page_image')
					.then(function(response) {
						console.log(response);
						vm.imageUrl = response.data.image;
					})
					.catch(function(error) {
						console.log(error);
					});
			},

			update() {
				let formData = new FormData();
				formData.append('image', this.file);
				this.saveFile(formData);
			},

			saveFile(formData) {
				this.ongoingAjax = true;
				this.ajaxResult = '';
				let vm = this;

				axios.post('/backend/first_page_image', formData)
					.then(function(response) {
						console.log(response);
						vm.ongoingAjax = false;
						vm.ajaxResult = 'Updated succesfully.';
						vm.ajaxResultClass = 'text-success';
					})
					.catch(function(error) {
						console.log(error);
						vm.ongoingAjax = false;
						vm.ajaxResult = error.response.data.message;
						vm.ajaxResultClass = 'text-danger';
					});
			}
		}
	}
</script>