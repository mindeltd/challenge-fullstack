<template>
    <div class="bg-white p-2">
        <div class="d-flex flex-row user-info">
            <img class="rounded-circle" src="../../assets/images/avatar.png" width="45" alt="user-photo">
            <div class="d-flex flex-column justify-content-start ml-2">
                <span class="d-block font-weight-bold name">
                    {{comment.user.first_name + ' ' + comment.user.last_name}}
                </span>
                <span class="date text-black-50">
                    {{formatDate(comment.created_at)}}
                    <i class="fa fa-pencil"></i>
                </span>
            </div>
        </div>
        <div class="mt-2">
            <p class="comment-text">{{comment.comment_text}}</p>
        </div>
        <div v-if="currentUser.id === comment.user.id" @click="removeComment()" class="remove-comment text-danger">
            remove
        </div>
    </div>
</template>

<script>
    import moment from "moment";
    export default {
        computed: {
            currentUser: {
                get() {
                    return this.$store.state.currentUser.user;
                }
            }
        },
        props: [
            'comment'
        ],
        methods: {
            removeComment (){
                axios.delete('api/comment/' + this.comment.id).then(response =>{
                    this.$emit('reloadlist')
                });
            },
            formatDate(date){
                if(date){
                    return moment(date).format('hh:mm A');
                }
            }
        }
    }
</script>
<style>
    .comment-text{
        margin-bottom: 0;
    }
    .bg-white.p-2{
        margin-top: 20px;
        padding-top: 0!important;
        padding-bottom: 0!important;
    }
    .comment-section{
        background-color: #ffffff;
    }
    .remove-comment{
        font-size:11px;
        cursor: pointer;
    }
</style>
