
require('./bootstrap');

window.Vue = require('vue');

import store from "./store"
import VueRouter from "vue-router";
import routes from "./routes"

import CommentBoxComponent from "./components/CommentBoxComponent";


Vue.use(VueRouter);

Vue.component('comment-box', CommentBoxComponent);


const app = new Vue({
    el: '#app',
    store,
    router: new VueRouter(routes)
});
