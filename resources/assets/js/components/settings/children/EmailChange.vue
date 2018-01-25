<template>
    <div class="card">
        <div class="card-header">
            Change e-mail
        </div>

        <div class="card-body">

            <p>Current address: <strong>{{ currentEmail }}</strong></p>

            <form>
                <div class="form-group">
                    <label>Password</label>
                    <input v-model="password" type="password" class="form-control" placeholder="Enter your password">
                </div>
                <div class="form-group">
                    <label>New e-mail</label>
                    <input v-model="newEmail" type="email" class="form-control" placeholder="Enter new e-mail address">
                </div>

                <button @click.prevent="sendRequest" type="submit" class="btn btn-primary">Submit <ajax-spinner v-show="ongoingAjax"></ajax-spinner></button>
            </form>

            <small class="form-text mt-3">
                {{ ajaxResult }}
            </small>

        </div>
    </div>
</template>

<script>
    export default {

        props: ['user'],

        data() {
            return {
                password: '',
                newEmail: '',
                ongoingAjax: false,
                ajaxResult: '',
                currentEmail: this.user.email,
            }
        },

        methods: {
            sendRequest() {

                let vm = this;

                vm.ongoingAjax = true;

                axios.put('settings/updateEmail', {
                        password: vm.password,
                        new_email: vm.newEmail,
                        _method: 'put'
                    }).then(function(response) {
                        vm.ongoingAjax = false;
                        vm.ajaxResult = response.data.message;
                        vm.clearInputs();
                        vm.currentEmail = response.data.newEmail;
                    }).catch(function(error) {
                        vm.ongoingAjax = false;
                        vm.ajaxResult = error.response.data.message;
                    });
            },

            clearInputs() {
                this.password = '';
                this.newEmail = '';
            }
        }
    }
</script>