import './bootstrap';
import { createApp } from 'vue';
import App from './views/App.vue'
import router from './routes/router.js';

const app = createApp({
    components: { App }
});

import Navbar from './components/Navbar.vue';
app.component('navbar-component', Navbar);

app.use(router)

app.mount('#app');

// Vue.use(VueRouter);
// const router = new VueRouter({
//     mode: 'history',
//     base: process.env.BASE_URL,
//     routes
// });


// const app = new Vue({
//     el: '#app',
//     components: { App },
//     router
// })