<style scoped>
	img, p {
		position: absolute;
		/*overflow: hidden;*/
	}
</style>

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

		<div class="img">
			<transition
				v-bind:name="transitionName"
				tag="div"
				v-on:before-leave="beforeLeave"
				v-on:after-enter="afterEnter"
				>

				<img v-touch:swipe.right="previousPhoto" v-touch:swipe.left="nextPhoto" v-touch:swipe.up="nextProject" v-touch:swipe.bottom="previousProject" v-for="(image, index) in images" :src="getUrl(image)" :key="index" v-if="currentImage === index">

				<p v-touch:swipe.right="previousPhoto" v-touch:swipe.left="nextPhoto" class="projectDescription" v-if="currentImage + 1 === imagesQuantity" v-html="description"></p>

			</transition>
		</div>
	</div>

</template>

<script>
	export default {
		props: ['project', 'locale', 'baseUrl', 'ongoingParentNavigation'],
		
		data() {
			return {
				currentImage: 0,
				transitionName: '',
				ongoingAnimation: false,
			}
		},

		computed: {
			blockNavigation() {
				if (this.ongoingParentNavigation) return true;
				if (this.ongoingAnimation) return true;
				return false;
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

				if (event.keyCode == 38) { 
					vm.previousProject();
				}

				if (event.keyCode == 40) { 
					vm.nextProject();
				}

				if (event.keyCode == 37) { 
					vm.previousPhoto();
				}

				if (event.keyCode == 39) { 
					vm.nextPhoto();
				}

			});

			window.addEventListener('wheel', function(event) {

				if (event.deltaY < 0) {
				    vm.previousProject();
				}

				if (event.deltaY > 0) {
					vm.nextProject();
				}

			});
		},

		methods: {
			previousPhoto() {
				if (this.ongoingParentNavigation) return;
				this.transitionName = 'component-fade-left';

				if (this.currentImage > 0) {
					this.currentImage--;
				} else {
					this.currentImage = this.imagesQuantity - 1;
				}
			},

			nextPhoto() {
				if (this.ongoingParentNavigation) return;
				this.transitionName = 'component-fade-right';

				if (this.currentImage < this.imagesQuantity -1) {
					this.currentImage++;
				} else {
					this.currentImage = 0;
				}
			},

			previousProject() {
				if (this.blockNavigation) return;
				this.$emit('previous');
			},

			nextProject() {
				if (this.blockNavigation) return;
				this.$emit('next');
			},

			beforeLeave() {
				this.ongoingAnimation = true;
			},

			afterEnter() {
				this.ongoingAnimation = false;
			},

			getUrl(image) {
				return this.baseUrl + '/projects_files/' + image;
			}
		}
	}
</script>