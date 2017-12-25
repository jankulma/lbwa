<template>
    <div class="card">

        <div class="card-header">
            Add user
        </div>

        <div class="card-body">

            <form>
                <div class="form-group">
                    <label>Name</label>
                    <input v-model="name" type="text" class="form-control" placeholder="Enter user name">
                </div>
                <div class="form-group">
                    <label>E-mail address</label>
                    <input v-model="email" type="email" class="form-control" placeholder="Enter e-mail">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input v-model="password" type="password" class="form-control" placeholder="Enter password">
                </div>
                <div class="form-group">
                    <label>Repeat password</label>
                    <input v-model="passwordRepeat" type="password" class="form-control" placeholder="Repeat password">
                </div>

                <button @click.prevent="sendRequest" type="submit" class="btn btn-primary">Add <ajax-spinner v-show="ongoingAjax"></ajax-spinner></button>
            </form>


            <small class="form-text mt-3">
                {{ ajaxResult }}
            </small>

        </div>
        
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: '',
                email: '',
                password: '',
                passwordRepeat: '',
                ongoingAjax: false,
                ajaxResult: '',
            }
        },

        methods: {
            sendRequest() {

                let vm = this;

                vm.ongoingAjax = true;

                axios.post('settings', {
                        item: 'storeUser',
                        name: vm.name,
                        email: vm.email,
                        password: vm.password,
                        password_confirmation: vm.passwordRepeat,
                    }).then(function(response) {
                        vm.ongoingAjax = false;
                        vm.ajaxResult = response.data.message;
                        vm.clearInputs();
                    }).catch(function(error) {
                        vm.ongoingAjax = false;
                        vm.ajaxResult = error.response.data.message;
                    });
            },

            clearInputs() {
                this.name = '';
                this.email = '';
                this.password = '';
                this.passwordRepeat = '';
            }
        }
    }
</script>