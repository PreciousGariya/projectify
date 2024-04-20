import { useUserStore } from '~~/stores/user'

export default defineNuxtRouteMiddleware((to, from) => {
    const userStore = useUserStore()
    
    if (!userStore.id) {
        console.log('logout');
        return navigateTo('/login');
    }
})