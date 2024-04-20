import axios from "axios"

export default defineNuxtPlugin((NuxtApp) => {
    // console.log('NuxtApp', NuxtApp);
    axios.defaults.baseURL ='http://127.0.0.1:8000/api/';
    axios.defaults.withCredentials = false;
    axios.defaults.proxyHeaders = false;
    if(process.client){
        const token = window.localStorage.getItem('projectify_token');
        if(token){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
        }
    }
    return {
        provide: { 
            axios: axios
        },
    }
})