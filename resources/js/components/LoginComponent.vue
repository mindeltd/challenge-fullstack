<template>
    <div>
        <nav-bar-component></nav-bar-component>
        <div class="container login-container">
            <div class="row mt-4">
                <div class="col-6 offset-3">
                    <div class="header">
                        Login
                    </div>
                    <form @submit.prevent="submit()">
                        <div class="form-row">
                            <input v-model="user.username" type="text" min="1" name="username" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-row">
                            <input v-model="user.password" type="password" min="6" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div v-if="this.error" class="alert alert-danger" role="alert">
                            Invalid username or password
                        </div>
                        <div class="form-row">
                            <button type="submit" class="btn btn-primary">Login</button>
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
                    password: '',
                },
                error: false
            }
        },
        methods: {
            submit() {
                this.$store.dispatch('currentUser/login', this.user).then(() =>{
                }).catch(error =>{
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
    .login-container{
        margin-top: 150px;
    }
    .form-row{
        margin-bottom: 10px;
    }
</style>
