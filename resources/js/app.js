import Vue from 'vue';
import VueRouter from 'vue-router';
import Create from "./pages/Create";
import List from "./pages/List";
import Show from "./pages/Show";
import App from "./components/App";

require('./bootstrap');

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            name: 'List',
            path: '/',
            component: List
        },
        {
            name: 'Create',
            path: '/create',
            component: Create
        },
        {
            name: 'Show',
            path: '/:id',
            component: Show
        }
    ]
});

const app = new Vue({
    el: '#app',
    render: h => h(App),
    components: {
        App
    },
    router
});


