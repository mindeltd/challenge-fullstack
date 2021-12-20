<template>
    <nav style="background-color: #212529" class="site-header sticky-top py-1">
        <div style="color: #999999!important" class="container d-flex flex-column flex-md-row justify-content-between">
            <a class="py-2 d-none d-md-inline-block" href="/home">Home</a>
            <a v-if="currentUser.id" style="float: right; cursor: pointer" class="py-2 d-none d-md-inline-block" @click="logout()">Logout</a>
            <div style="float: right" v-if="!currentUser.id">
                <a style="padding-right: 15px" class="py-2 d-none d-md-inline-block" href="/login">Login</a>
                <a class="py-2 d-none d-md-inline-block" href="/register">Register</a>
            </div>

        </div>
    </nav>
</template>

<script>
    export default {
        computed: {
            currentUser: {
                get() {
                    return this.$store.state.currentUser.user;
                }
            }
        },
        methods: {
            logout() {
                this.$store.dispatch('currentUser/logout');
            }
        }
    }
</script>
<style>
    .d-md-inline-block{
        color: #999999
    }
</style>
