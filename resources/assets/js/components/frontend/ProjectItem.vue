<template>

	<div class="project">

		<div class="desktopNavigator">
			<div @click="previousProject" class="top"></div>
			<div @click="previousPhoto" class="left"></div><div @click="nextPhoto" class="right"></div>
			<div @click="nextProject" class="bottom"></div>
		</div>

		<div class="projectHeader">
			<h2>{{ title }}</h2>
			<span class="counter">{{ currentImage + 1 }}/{{ imagesQuantity }}</span>
		</div>

		<swiper :options="swiperOptions" @slideChange="slideChanged" ref="mySwiper">
	        <swiper-slide v-for="(image, key) in images" :key="key">
	        	<img class="imgInsideSwiper" :src="getUrl(image)">
	        </swiper-slide>
	        <swiper-slide>
	        	<p class="projectDescription" v-html="description"></p>
	        </swiper-slide>
	    </swiper>

	</div>

</template>

<script>
	import 'swiper/dist/css/swiper.css';
	import { swiper, swiperSlide } from 'vue-awesome-swiper';

	export default {
		components: {
			swiper,
		    swiperSlide
		},

		props: ['project', 'locale', 'baseUrl'],
		
		data() {
			return {
				swiperOptions: {
					speed: 1000,
					spaceBetween: 50
				},
				currentImage: 0
			}
		},

		computed: {
			swiper() {
				return this.$refs.mySwiper.swiper
			},

			images() {
				return JSON.parse(this.project.images);
			},

			imagesQuantity() {
				// adding one for description
				return Object.keys(this.images).length + 1;
			},

			title() {
				if ('pl' === this.locale) {
					return this.project.title_pl;
				}

				return this.project.title_en;
			},

			description() {
				if ('pl' === this.locale) {
					return this.project.description_pl;
				}

				return this.project.description_en;
			}

		},

		mounted() {
			var vm = this;

			window.addEventListener('keyup', function(event) {

				if (event.keyCode == 37) { 
					vm.previousPhoto();
				}

				if (event.keyCode == 39) { 
					vm.nextPhoto();
				}

			});
		},

		methods: {
			slideChanged() {
				this.currentImage = this.swiper.activeIndex;
			},

			previousPhoto() {
				this.swiper.slidePrev();
			},

			nextPhoto() {
				this.swiper.slideNext();
			},

			previousProject() {
				this.$emit('previous');
			},

			nextProject() {
				this.$emit('next');
			},

			getUrl(image) {
				return this.baseUrl + '/projects_files/' + image;
			}
		}
	}
</script>