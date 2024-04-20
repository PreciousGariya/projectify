<template>
    <section class="login mt-4">
        <div class="container">
            <div class="row justify-content-center"> <!-- Add justify-content-center to center the columns -->
                <div class="col-md-6"> <!-- Remove mr-auto to center the column -->
                    <form @submit.prevent="login()">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input v-model="email" type="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                                else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input v-model="password" type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Password">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        {{ form }}
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
    import axios from 'axios';
    import { useUserStore } from '~~/stores/user';

    const userStore = useUserStore()
    const router = useRouter()
  
    definePageMeta({
        middleware: 'is-logged-in'
    })

    let email = ref(null)
    let password = ref(null)
    let errors = ref(null)

    const login = async () => {
        errors.value = null
        try {
            console.log('login', email.value, password.value);
            await userStore.login(email.value, password.value);
            const token = window.localStorage.getItem('token');
            if (token) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + userStore.api_token;
            }
            router.push('/home')
        } catch (error) {
            errors.value = error.response.data.errors
        }
    }
</script>