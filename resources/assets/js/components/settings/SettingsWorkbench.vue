<template>

	<component :is="workingOn" :user="user"></component>

</template>

<script>
	import PasswordChange from './children/PasswordChange.vue';
	import EmailChange from './children/EmailChange.vue';
	import UserCreate from './children/UserCreate.vue';
	import CardWelcome from './children/CardWelcome.vue';

	export default {
		props: ['user'],

		data() {
			return {
			    workingOn: 'cardWelcome',
			}
		},

		created() {
			this.eventHub.$on('workChanged', newJob => {
				this.workingOn = newJob;
			});
		},

		components: {
		    cardWelcome: CardWelcome,
		    passwordChange: PasswordChange,
		    emailChange: EmailChange,
		    userCreate: UserCreate,
		}
	}
</script>