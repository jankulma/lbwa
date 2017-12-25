<template>

	<div>
		
		<a href="#" @click.prevent="addPhoto">Add Photo(s)</a>
		<input multiple type="file" class="d-none" ref="fileInput" @change="fileInserted($event)">

		<div class="mt-3">

			<draggable :list="this.images">

				<div v-for="(object, index) in this.images" id="draggablePhotos" :style="{backgroundImage: 'url(' + object.image + ')'}" :key="index">
					<button @click="removeImage(index)" class="btn btn-sm pull-right removeDraggable">
						<i class="fa fa-times" aria-hidden="true"></i>
					</button>
				</div>

			</draggable>

		</div>

		<small class="form-text text-muted mt-3">
			Hint! Drag and drop photos to sort them as you wish.
		</small>

	</div>

</template>

<script>
import draggable from 'vuedraggable'

export default {
	props: ['wantImages', 'project'],

	data() {
		return {
			images: [],
		}
	},

	created() {
		if (this.project.hasOwnProperty('images')) {
			let images = JSON.parse(this.project.images);
			let length = Object.keys(images).length;

			for (var i = 0; i < length; i++) {
				this.images.push({
					image: window.baseUrl + '/projects_files/' + images[i],
					file: images[i],
					uploaded: true,
				});
			}
		}
	},

	watch: {
		wantImages(want) {
			if (want) {
				this.passImages();
				console.log('Passing images.');
			}
		}
	},

	methods: {
		passImages() {
			this.$emit('sendingFiles', this.images);
		},

		addPhoto() {
			this.$refs.fileInput.click();
		},

		fileInserted(e) {
			let files = e.target.files;

			for (var i = 0; i < files.length; i++) {
				this.createImageObject(files[i]);
			}	
		},

		createImageObject(file) {
			let reader = new FileReader();
			let vm = this;

			reader.onload = (e) => {
				vm.images.push({
					file: file,
					image: e.target.result,
					uploaded: false
				});
			};

			reader.readAsDataURL(file);
		},

		removeImage(index) {
			this.images.splice(index, 1);
		}
	},

	components: {
		draggable
	}
}
</script>