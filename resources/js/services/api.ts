import axios, { AxiosInstance } from "axios";

const api: AxiosInstance = axios.create({
    baseURL: process.env.APP_URL + '/api/v1/'
});

export default api;