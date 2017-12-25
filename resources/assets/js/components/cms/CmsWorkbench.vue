<template>
	<component :is="workingOn" :file="file"></component>
</template>

<script>

	import CardWelcome from './children/CardWelcome.vue';
	import FileEditor from './children/FileEditor.vue';

	export default {

		data() {
			return {
			    workingOn: 'cardWelcome',
			    file: {
			    	id: '',
			    	contents: ''
			    },
			}
		},

		created() {
			this.eventHub.$on('workChanged', (newJob, fileId) => {
				this.workingOn = newJob;

				if (undefined !== fileId) {
					this.getFile(fileId);
				}
			});
		},

		methods: {
			getFile(id) {
				let vm = this;

				axios.get('cms/partial/' + id + '/edit')
					.then(function(response) {
						vm.file.id = id;
						vm.file.contents = response.data.file;
					})
					.catch(function(error) {
						console.log(error);
					});
			}
		},

		components: {
		    cardWelcome: CardWelcome,
		    fileEditor: FileEditor
		}
		
	}
</script>