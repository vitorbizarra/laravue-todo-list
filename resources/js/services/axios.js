import axios from 'axios'
import store from './store'

const instance = axios.create({
    baseURL: 'http://127.0.0.1:8000/api/v1',
    withCredentials: true
});

instance.interceptors.request.use(
    config => {
        if (store.getters.userToken) {
            config.headers['Authorization'] = `Bearer ${store.getters.userToken}`;
        }
        return config;
    },
    error => {
        Promise.reject(error);
    }
);

export default instance;