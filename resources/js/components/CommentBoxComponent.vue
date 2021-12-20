<template>
    <div>
        <nav-bar-component></nav-bar-component>
        <div class="container mt-5">
            <div class="d-flex justify-content-center row">
                <div class="col-md-8">
                    <div class="d-flex flex-column comment-section">
                        <div v-if="totalNumberOfComments > this.comments.length" @click="getComments(true)" class="earlier-comments">
                            {{this.totalNumberOfComments - this.comments.length}} earlier comments
                        </div>
                        <div v-for="(comment, index) in comments" :key="index">
                            <comment-box-item-component :comment="comment" v-on:reloadlist="getComments()"></comment-box-item-component>
                        </div>
                        <comment-create-component v-on:reloadlist="getComments()"> </comment-create-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CommentBoxItemComponent from "./CommentBoxItemComponent";
    import CommentCreateComponent from "./CommentCreateComponent";
    import RegisterComponent from "./RegisterComponent";
    import NavBarComponent from "./NavBarComponent";

    export default {
        components: {
            CommentBoxItemComponent,
            CommentCreateComponent,
            RegisterComponent,
            NavBarComponent
        },
        data() {
            return {
                comments: [],
                totalNumberOfComments: null,
                allComments: false,
            }
        },
        computed: {
          currentUser: {
              get() {
                  return this.$store.state.currentUser.user;
              }
          }
        },
        created() {
            axios.defaults.headers.common["Authorization"] = "Bearer " + localStorage.getItem("commentbox_token");
            this.$store.dispatch('currentUser/getUser');
            this.getComments();
        },
        methods: {
            getComments(all = null) {
                axios.get('api/comments', {
                    params: {
                        'allComments': all
                    }
                }).then(response => {
                    this.comments = response.data.comments;
                    this.comments.reverse();
                    this.totalNumberOfComments = response.data.commentCount;
                    this.allComments = true;
                });
            }
        }
    }
</script>
<style>
    .earlier-comments{
        margin: 15px 0 0 15px;
        cursor: pointer;
    }
</style>
