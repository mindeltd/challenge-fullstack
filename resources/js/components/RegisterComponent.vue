<template>
    <div>
        <nav-bar-component></nav-bar-component>
        <div class="container register-container">
            <div class="row mt-4">
                <div class="col-6 offset-3">
                    <div class="header">
                        Register
                    </div>
                    <form @submit.prevent="register()">
                        <div class="form-row">
                            <input v-model="user.username" type="text" name="username" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-row">
                            <input v-model="user.first_name" type="text" name="first_name" class="form-control" placeholder="First Name">
                        </div>
                        <div class="form-row">
                            <input v-model="user.last_name" type="text" name="last_name" class="form-control" placeholder="Last Name">
                        </div>
                        <div class="form-row">
                            <input v-model="user.password" type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-row">
                            <input v-model="user.password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                        </div>
                        <div v-if="this.error" class="alert alert-danger" role="alert">
                            The given data was invalid
                        </div>
                        <div class="form-row">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import NavBarComponent from "./NavBarComponent";

    export default {
        components: {
            NavBarComponent
        },
        data() {
            return {
                user: {
                    username: '',
                    first_name: '',
                    last_name: '',
                    password: '',
                    password_confirmation: '',
                },
                error: false
            }
        },
        methods: {
            register() {
                this.$store.dispatch('currentUser/registerUser', this.user).then(succeess => {
                }).catch(error => {
                    this.error = true;
                });
            }
        }
    }
</script>
<style>
    .header{
        text-align: center;
        font-size: 30px;
        padding-bottom: 30px;
        color: #999999;
    }
    .register-container{
        margin-top: 150px;
    }
    .form-row{
        margin-bottom: 10px;
    }
</style>
