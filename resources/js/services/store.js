import Vuex from 'vuex';
import axios from './axios'
import router from '../routes/router'

export default new Vuex.Store({
    state: {
        authenticated: false,
        user: null,
        token: null
    },
    mutations: {
        authenticateUser(state, data) {
            state.authenticated = true;
            state.token = data.token;
            state.user = data.user;
        },
        unauthenticateUser(state) {
            state.authenticated = false;
            state.token = null;
            state.user = null
         }
    },
    actions: {
        async login({ commit }, credentials) {
            await axios.get('../../sanctum/csrf-cookie');

            const res = await axios.post('login', credentials);
            commit('authenticateUser', res.data);

            router.push('/');
        },
        async logout({ commit }) {
            axios.post('logout');

            commit('unauthenticateUser');

            router.push('/login');
        }
    },
    getters: {
        isAuthenticated(state) {
            return state.authenticated;
        },
        user(state) {
            return state.user;
        },
        userToken(state) {
            return state.token;
        }
    },
    modules: {}
})