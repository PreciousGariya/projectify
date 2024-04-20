import { defineStore } from "pinia";
import axios from "~/plugins/axios";

const $axios = axios().provide.axios;

export const useUserStore = defineStore('user', {
    state: () => ({
        id: '',
        full_name: '',
        email: '',
        email_verified_at: '',
        created_at : '',
        updated_at : '',
        api_token: '',
        token_type: '',
        expires_at: '',
        isLoggedIn: false,
    }),
    actions: {
        async login(email, password) {
            console.log('email',email);
            await $axios.post('login', {
              email: email,
              password: password,
            }).then((result) => {
                console.log('result',result.data);
                localStorage.setItem('projectify_token',result.data.access_token)
                this.$state.api_token = result.data.access_token
                this.$state.email = result.data.user.email
                this.$state.full_name = result.data.user.name
                this.$state.id = result.data.user.id
                this.$state.token_type = result.data.token_type,
                this.$state.expires_at = result.data.expires_at
                this.$state.email_verified_at = result.data.user.email_verified_at
                this.$state.isLoggedIn = true;
                
            });
        },
        
        async register(name, email, password, confirmPassword) {
            await $axios.post('/api/register', {
              full_name: name,
              email: email,
              password: password,
              password_confirmation: confirmPassword
            })
        },

        async getUser() {
            let res = await $axios.get('/api/user')
            this.$state.id = res.data.data.id
            this.$state.full_name = res.data.data.full_name
            this.$state.email = res.data.data.email      
            this.$state.isLoggedIn = true
        },
      
        async logout() {
            await $axios.post('/api/logout')
            this.resetState()
        },

        resetState() {      
            this.$state.id = ''
            this.$state.full_name = ''
            this.$state.email = ''
            this.$state.api_token = ''
            this.$state.isLoggedIn = false
        },
    },
    persist: true,
})