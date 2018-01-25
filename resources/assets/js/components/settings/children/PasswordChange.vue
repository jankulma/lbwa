<template>
    <div class="card">

        <div class="card-header">
            Change password
        </div>

        <div class="card-body">

            <form>
                <div class="form-group">
                    <label>Current password</label>
                    <input v-model="currentPass" type="password" class="form-control" placeholder="Enter old password">
                </div>
                <div class="form-group">
                    <label>New password</label>
                    <input v-model="newPass" type="password" class="form-control" placeholder="Enter new password">
                </div>
                <div class="form-group">
                    <label>Repeat new password</label>
                    <input v-model="newPassRepeat" type="password" class="form-control" placeholder="Repeat new password">
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
        data() {
            return {
                currentPass: '',
                newPass: '',
                newPassRepeat: '',
                ongoingAjax: false,
                ajaxResult: '',
            }
        },

        methods: {
            sendRequest() {

                let vm = this;

                vm.ongoingAjax = true;

                axios.put('settings/updatePassword', {
                        current_password: vm.currentPass,
                        new_password: vm.newPass,
                        new_password_confirmation: vm.newPassRepeat,
                        _method: 'put'
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
                this.currentPass = '';
                this.newPass = '';
                this.newPassRepeat = '';
            }
        }
    }
</script>