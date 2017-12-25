<template>
	<div class="d-flex mx-auto">

		<li class="nav-item">
		    <a @click="welcomeCard" class="nav-link" href="#">
		        <i class="fa fa-smile-o" aria-hidden="true"></i> Start
		    </a>
		</li>

		<li class="nav-item dropdown">
		    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
		        <i class="fa fa-user-o" aria-hidden="true"></i> Account
		    </a>
		    <div class="dropdown-menu">
		        <a @click="changeEmail" class="dropdown-item" href="#">Change email</a>
		        <a @click="changePassword" class="dropdown-item" href="#">Change password</a>
		    </div>
		</li>

		<li class="nav-item dropdown">
		    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
		        <i class="fa fa-wrench" aria-hidden="true"></i> Backend
		    </a>
		    <div class="dropdown-menu">
		        <a @click="addUser" class="dropdown-item" href="#">Add user</a>
		    </div>
		</li>

	</div>
</template>

<script>
	export default {
		methods: {
		    changeEmail() {
		        this.eventHub.$emit('workChanged', 'emailChange');
		    },

		    changePassword() {
		        this.eventHub.$emit('workChanged', 'passwordChange');
		    },

		    addUser() {
		        this.eventHub.$emit('workChanged', 'userCreate');
		    },

		    welcomeCard() {
		        this.eventHub.$emit('workChanged', 'cardWelcome');
		    },
		},
	}
</script>