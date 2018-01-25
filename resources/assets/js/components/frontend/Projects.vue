<style>
	body {
		overflow: hidden;
	}
</style>

<template>

	<transition
		v-bind:name="transitionName"
		mode="out-in"
		v-on:before-leave="beforeLeave"
		v-on:after-enter="afterEnter"
		>

		<project-item v-for="(project, index) in projects" v-if="index === currentProject" :project="project" :locale="locale" :baseUrl="baseUrl" :key="project.id" :ongoingParentNavigation="ongoingNavigation" v-on:previous="previousProject" v-on:next="nextProject"></project-item>

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
				ongoingNavigation: false,
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
				if (this.ongoingNavigation) return;
				this.transitionName = 'component-fade-down';

				if (0 === this.currentProject) {
					this.currentProject = this.projects.length - 1;
				} else {
				 	this.currentProject--;
				}
			},

			nextProject() {
				if (this.ongoingNavigation) return;
				this.transitionName = 'component-fade-up';

				if (this.projects.length - 1 === this.currentProject) {
					this.currentProject = 0;
				} else {
					this.currentProject++;
				}
			},

			beforeLeave() {
				this.ongoingNavigation = true;
			},

			afterEnter() {
				this.ongoingNavigation = false;
			}


		}
	}
</script>