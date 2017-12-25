<template>
	<div class="d-flex flex-column justify-content-center align-items-center">
		<a @click="forgotPassword" class="forgot-password" href="#">Forgot password?</a>

	    <form class="login-form" v-show="forgottenPassword">

	        <input v-model="email" class="" type="email" placeholder="email">

	        <button @click.prevent="sendReset" type="submit">
	            send reset <i class="fa fa-angle-right" aria-hidden="true"></i>
	        </button>
	    </form>

	    <span class="ajax-status" v-show="ongoingAjax">
	        <ajax-spinner v-show="spinner"></ajax-spinner>
	        {{ ajaxResult }}
	    </span>
	</div>
</template>

<script>
	export default {
	    props: ['email'],

		data() {
			return {
				forgottenPassword: false,
				ongoingAjax: false,
				spinner: false,
				ajaxResult: '',
			}
		},

		methods: {
	    	forgotPassword() {
	    		if (true === this.forgottenPassword) {
		    		this.forgottenPassword = false;
	    		} else {
		    		this.forgottenPassword = true;
	    		}
	    	},

	    	sendReset() {
		    	const vm = this;

		    	vm.ajaxResult = '';
	    		vm.ongoingAjax = true;
	    		vm.spinner = true;

	    		axios.post('backend/send_reset_email', {
	    			email: this.email,
	    		})
	    		.then(function (response) {
		    		vm.spinner = false;
		    		vm.ajaxResult = 'Email sent!';
	    		})
	    		.catch(function (error) {
		    		vm.spinner = false;
		    		vm.ajaxResult = error.response.data.message;
	    		});
	    	},
		}
	}
</script>