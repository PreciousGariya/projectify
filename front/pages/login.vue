<template>
    <section class="login d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form @submit.prevent="login()">
                        <h3>Login</h3>
                        <div class="form-group mt-4">
                            <label for="exampleInputEmail1">Email address</label>
                            <input v-model="email" type="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" v-if="errors && errors.email" class="text-danger">{{ errors.email[0]
                                }}</small>
                        </div>
                        <div class="form-group mt-4">
                            <label for="exampleInputPassword1">Password</label>
                            <input v-model="password" type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Password">
                            <small id="emailHelp" v-if="errors && errors.password" class="text-danger">{{ errors.password[0]
                                }}</small>
                        </div>
                        <div class="row">
                            <button type="submit" class="btn btn-primary mt-4 gradient-button"
                                :disabled="isButtonDisabled">Login</button>
                            <NuxtLink class="btn btn-default mt-4" to="/register">Create a new account</NuxtLink>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
import axios from 'axios';
import { useUserStore } from '~~/stores/user';
import Swal from 'sweetalert2';

const userStore = useUserStore()
const router = useRouter()

definePageMeta({
    middleware: 'is-logged-in',
    layout:'login'
})
let isButtonDisabled = ref(false);
let email = ref(null)
let password = ref(null)
let errors = ref(null)

const login = async () => {
    errors.value = null
    isButtonDisabled.value = true;
    try {
        await userStore.login(email.value, password.value);
        const token = window.localStorage.getItem('projectify_token');
        if (token) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + userStore.api_token;
        }
        isButtonDisabled.value = false;
        router.push('/tasks')
    } catch (error) {
        isButtonDisabled.value = false;
        if (error.response && error.response.status === 422) {
            // Validation errors returned from the backend
            errors.value = error.response.data.errors;
            // Swal.fire(
            //     'Opps!',
            //     "Unauthenticate!! Please login again",
            //     'error',
            // );
        } else {
            // Other errors
            console.error('Error:', error.response.data.error);
            Swal.fire(
                'Opps!',
                error.response.data.error,
                'error',
            );
        }
    }
}
</script>

