import './bootstrap';
import { createApp } from 'vue';
import App from './views/App.vue'
import router from './routes/router.js';

const app = createApp({
    components: { App }
});

// import ExampleComponent from './components/ExampleComponent.vue';
// app.component('example-component', ExampleComponent);

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