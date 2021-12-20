import CommentBoxComponent from "./components/CommentBoxComponent";
import RegisterComponent from "./components/RegisterComponent";
import LoginComponent from "./components/LoginComponent";

export default {
    mode: 'history',

    routes: [
        {
            path: '/',
            component: CommentBoxComponent
        },
        {
            path: '/home',
            component: CommentBoxComponent
        },
        {
            path: '/register',
            component: RegisterComponent
        },
        {
            path: '/login',
            component: LoginComponent
        }
    ]
}
