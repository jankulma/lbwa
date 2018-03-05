<template>

	<swiper :options="swiperOptions" ref="projectsSwiper">
        <swiper-slide v-for="(project, key) in projects" :key="key">

        	<project-item :project="project" :locale="locale" :baseUrl="baseUrl" v-on:previous="previousProject" v-on:next="nextProject"></project-item>
        	
        </swiper-slide>
    </swiper>

</template>

<script>
	import ProjectItem from './ProjectItem.vue';
	import 'swiper/dist/css/swiper.css'
	import { swiper, swiperSlide } from 'vue-awesome-swiper'

	export default {
		components: {
			swiper,
		    swiperSlide
		},

		data() {
			return {
				swiperOptions: {
					direction: 'vertical',
					speed: 1000
				},
				projects: [],
				locale: '',
				baseUrl: '',
				currentProject: 0
			}
		},

		created() {
			this.getProjects();

			window.addEventListener('keyup', event => {

				if (event.keyCode == 38) { 
					this.previousProject();
				}

				if (event.keyCode == 40) { 
					this.nextProject();
				}
			});

			window.addEventListener('wheel', event => {

				if (event.deltaY < 0) {
				    this.previousProject();
				}

				if (event.deltaY > 0) {
					this.nextProject();
				}

			});
		},

		computed: {
			swiper() {
				return this.$refs.projectsSwiper.swiper
			}
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
				this.swiper.slidePrev();
			},

			nextProject() {
				this.swiper.slideNext();
			}
		}
	}
</script>