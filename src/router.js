import Vue from 'vue'
import Router from 'vue-router'
import Authentication from "./components/Authentication";
import Recover from "./components/updateUser";
import CreateUser from "./components/CreateUser";

Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Authentication
        },
        {
            path: '/recover',
            component: Recover
        },
        {
            path: '/create',
            component: CreateUser
        }
    ]
})




