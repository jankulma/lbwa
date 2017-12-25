<style scoped>
</style>

<template>

	<transition v-bind:name="transitionName" mode="out-in">

		<project-item v-for="(project, index) in projects" v-if="index === currentProject" :project="project" :locale="locale" :baseUrl="baseUrl" :key="project.id" v-on:previous="previousProject" v-on:next="nextProject"></project-item>

	</transition>

</template>

<script>
	import ProjectItem from './ProjectItem.vue';

	export default {
		data() {
			return {
				projects: [],
				locale: '',
				baseUrl: '',
				currentProject: 0,
				transitionName: '',
			}
		},

		created() {
			this.getProjects();
		},

		methods: {
			getProjects() {
				let vm = this;

				axios.get('project')
					.then(function(response) {
						vm.projects = response.data.projects;
						vm.locale = response.data.locale;
						vm.baseUrl = response.data.baseUrl;
					})
					.catch(function(error) {
						console.log(error);
					});
			},

			previousProject() {
				this.transitionName = 'component-fade-down';

				if (0 === this.currentProject) {
					this.currentProject = this.projects.length - 1;
				} else {
				 	this.currentProject--;
				}
			},

			nextProject() {
				this.transitionName = 'component-fade-up';

				if (this.projects.length - 1 === this.currentProject) {
					this.currentProject = 0;
				} else {
					this.currentProject++;
				}
			}


		}
	}
</script>