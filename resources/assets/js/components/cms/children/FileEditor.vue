<style scoped>
	.card {
		margin-bottom: 2rem;
	}
</style>

<template>

	<div class="col-12 col-xl-6 mb-5 pb-5">
		
			<div class="card">

				<div class="card-header">
					File Editor <strong>{{ fileName }}</strong>
				</div>

				<div class="card-body">

					<form>
						<div class="row">
							<div class="form-group col">
								<vue-editor v-model="file.contents" :editorToolbar="customToolbar"></vue-editor>
							</div>
						</div>
					</form>

				</div>

			</div>

			<div>
				<button @click="save" class="btn btn-primary pull-right">Save File <ajax-spinner v-show="ongoingAjax"></ajax-spinner></button>
			</div>

			<small class="form-text" :class="ajaxResultClass">
			    {{ ajaxResult }}
			</small>

	</div>

</template>

<script>
	import { VueEditor } from 'vue2-editor';

	export default {
		props: ['file'],

		data() {
			return {
				ongoingAjax: false,
				ajaxResult: '',
				ajaxResultClass: '',
				customToolbar: [
					['bold', 'italic', 'underline', 'strike'],        // toggled buttons
					['blockquote', 'code-block'],

					[{ 'header': 1 }, { 'header': 2 }],               // custom button values
					[{ 'list': 'ordered'}, { 'list': 'bullet' }],
					[{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
					[{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
					[{ 'direction': 'rtl' }],                         // text direction

					[{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
					[{ 'header': [1, 2, 3, 4, 5, 6, false] }],

					[{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
					[{ 'font': [] }],
					[{ 'align': [] }],

				    ['link'],
					['clean']     
			    ]
			}
		},

		computed: {
			fileName() {
				return this.file.id.split('.').join('/');
			}
		},

		created() {
			this.eventHub.$on('workChanged', () => {
				this.ajaxResult = '';
			});
		},

		components: {
			VueEditor
		},

		methods: {
			save() {
				let vm = this;

				vm.ongoingAjax = true;

				axios.post('/backend/cms/partial', {
					id: vm.file.id,
					fileContents: vm.file.contents
				})
				.then(function(response) {
					console.log(response);
					vm.ongoingAjax = false;
					vm.ajaxResult = 'New content saved.';	
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