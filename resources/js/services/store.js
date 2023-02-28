import _ from "lodash";
import Vuex from "vuex";
import axios from "./axios";
import router from "../routes/router";

export default new Vuex.Store({
    state: {
        session: {
            authenticated: null,
            user: null,
            token: null,
        },
        error: {
            message: null,
        },
    },
    mutations: {
        authenticateUser(state, data) {
            sessionStorage.setItem("session", JSON.stringify(data));
            state.session.authenticated = data.authenticated;
            state.session.token = data.token;
            state.session.user = data.user;
        },
        unauthenticateUser(state) {
            sessionStorage.clear();
            state.session.authenticated = null;
            state.session.token = null;
            state.session.user = null;
        },
        setError(state, message) {
            state.error.message = message;
        },
    },
    actions: {
        async login({ commit }, credentials) {
            try {
                await axios.get("../../sanctum/csrf-cookie");

                const res = await axios.post("login", credentials);

                res.data.authenticated = true;

                commit("authenticateUser", res.data);

                router.push("/dashboard");
            } catch (error) {
                commit("setError", error.response.data.message);
            }
        },
        async logout({ commit }) {
            axios.post("logout");
            commit("unauthenticateUser");
            router.push("/login");
        },
        initState({ commit }) {
            const session = sessionStorage.getItem("session");
            if (session && typeof session === "string" && session !== "") {
                commit("authenticateUser", JSON.parse(session));
            }
        },
    },
    getters: {
        isAuthenticated(state) {
            const session = sessionStorage.getItem("session");
            let data = null;

            if (session && typeof session === "string" && session !== "") {
                data = JSON.parse(session);
            }
            
            state.session.authenticated = _.isEqual(data, state.session);
            return state.session.authenticated;
        },
        user(state) {
            return state.session.user;
        },
        userToken(state) {
            return state.session.token;
        },
        errors(state) {
            return state.error.message;
        },
    },
    modules: {},
});
