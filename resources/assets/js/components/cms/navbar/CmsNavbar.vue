<template>

	<div class="d-flex mx-auto">

		<li class="nav-item">
		    <a @click="welcomeCard" class="nav-link" href="#">
		        <i class="fa fa-smile-o" aria-hidden="true"></i> Start
		    </a>
		</li>

		<li class="nav-item dropdown">

		    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
		        <i class="fa fa-cube" aria-hidden="true"></i> Partials
		    </a>
		    <div class="dropdown-menu">


				<div v-for="(partial, partialName) in this.partials.en">

		        <h6 class="dropdown-header">EN {{ _.startCase(partialName) }}</h6>
					
					<a v-for="(path, partialPiece) in partial" :id="'en.' + partialName + '.' + partialPiece" @click="edit($event)" href="#" class="dropdown-item">
					    {{ _.startCase(partialPiece) }}						
					</a>

				</div>

		        <div class="dropdown-divider"></div>


		        <div v-for="(partial, partialName) in this.partials.pl">

		        <h6 class="dropdown-header">PL {{ _.startCase(partialName) }}</h6>
		        	
		        	<a v-for="(path, partialPiece) in partial" :id="'pl.' + partialName + '.' + partialPiece" @click="edit($event)" href="#" class="dropdown-item">
		        	    {{ _.startCase(partialPiece) }}						
		        	</a>

		        </div>

		    </div>

		</li>

	</div>
</template>

<script>
	export default {

		data() {
			return {

				partials: [],
			}
		},

		created() {
			this.getFiles();
		},

		methods: {
			
		    welcomeCard() {
		        this.eventHub.$emit('workChanged', 'cardWelcome');
		    },

		    edit(event) {
		    	this.eventHub.$emit('workChanged', 'fileEditor', event.target.id);
		    },

		    getFiles() {

		    	let vm = this;

		    	axios.get('cms/partial')
		    		.then(function(response) {
			    	    vm.partials = response.data.partials;
		    		})
		    		.catch(function(error) {

		    		});
		    }
		},
	}
</script>