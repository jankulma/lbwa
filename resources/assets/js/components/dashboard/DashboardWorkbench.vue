<template>
	<component :is="workingOn" :project="project"></component>
</template>

<script>

	import CardWelcome from './children/CardWelcome.vue';
	import ProjectCreator from './children/ProjectCreator.vue';
	import ProjectCreated from './children/ProjectCreated.vue';
	import ProjectManager from './children/ProjectManager.vue';
	import FirstPageImage from './children/FirstPageImage.vue';

	export default {
		data() {
			return {
			    workingOn: 'projectsManage',
			    project: {},
			}
		},

		created() {
			this.eventHub.$on('workChanged', workLoad => {
				this.workingOn = workLoad.newJob;

				if (undefined !== workLoad.project) {
					this.project = workLoad.project;
				}
			});
		},

		components: {
		    projectCreate: ProjectCreator,
		    projectCreated: ProjectCreated,
		    projectsManage: ProjectManager,
		    projectEdit: ProjectCreator,
		    firstPageImage: FirstPageImage,
		}
	}
</script>