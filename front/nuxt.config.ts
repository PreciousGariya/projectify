// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },
  runtimeConfig : {
    public: {
      API_URL: process.env.SERVER_BASE_URL,
    }
  },
  modules: ['@bootstrap-vue-next/nuxt', 
  '@pinia/nuxt', // needed
  '@pinia-plugin-persistedstate/nuxt','nuxt-icon','nuxt-primevue',
  ],
    primevue: {
      options: {
          // unstyled: true
      }
  },
  css: ['primevue/resources/themes/aura-light-green/theme.css', 'bootstrap/dist/css/bootstrap.min.css'],

})
