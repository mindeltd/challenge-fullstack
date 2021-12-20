<template>
    <div class="bg-light p-2">
        <div class="d-flex flex-row align-items-start">
            <textarea v-model="comment.comment_text" class="form-control ml-1 shadow-none textarea"></textarea>
        </div>
        <div class="mt-2 text-left">
            <button v-if="currentUser.id" @click="createComment()" class="btn btn-success btn-sm shadow-none" type="button">Post</button>
            <div v-if="!currentUser.id" class="button-login-text">
                Before you leave a comment, you'll need to <a href="/login">log in</a>
            </div>
        </div>
    </div>
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
        data() {
            return {
                comment: {
                    comment_text: ""
                }
            }
        },
        methods: {
            createComment() {
                if(this.comment.comment_text === ''){
                    return;
                }
                axios.post('api/comment/create', {
                    comment: {
                        comment_text: this.comment.comment_text
                    }
                }).then(()=>{
                    this.$emit('reloadlist');
                    this.comment.comment_text = '';
                });
            }
        }
    }
</script>
<style>
    .textarea{
        margin-left: 0!important;
    }
    .bg-light{
        padding-left: 0!important;
    }
    .btn-success{
        width: 75px;
    }
</style>
