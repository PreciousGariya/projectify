<template>
    <section class="login d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center"> 
                <div class="col-md-6"> 
                    <form @submit.prevent="register()">
                        <h3>Register</h3>
                        <div class="form-group mt-4">
                            <label for="exampleInputEmail1">Name</label>
                            <input v-model="name" type="text" class="form-control" id="exampleInputName1"
                                aria-describedby="nameHelp" placeholder="Enter Name">
                                <small id="nameHelp" v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</small>
                        </div>
                        <div class="form-group mt-4">
                            <label for="exampleInputEmail1">Email address</label>
                            <input v-model="email" type="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter email">
                                <small id="emailHelp" v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</small>
                        </div>
                        <div class="form-group mt-4">
                            <label for="exampleInputPassword1">Password</label>
                            <input v-model="password" type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Password">
                            <small id="emailHelp" v-if="errors && errors.password" class="text-danger">{{ errors.password[0] }}</small>
                        </div>
                        <div class="form-group mt-4">
                            <label for="exampleInputPassword1">Confirm Password</label>
                            <input v-model="password_confirmation" type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Confirm Password">
                            <small id="emailHelp" v-if="errors && errors.password_confirmation" class="text-danger">{{ errors.password_confirmation[0] }}</small>

                        </div>
                        <button type="submit" class="btn btn-primary mt-4 gradient-button" :disabled="isButtonDisabled">Register</button>
                        <NuxtLink class="btn btn-default mt-4" to="/login">Already have an account?</NuxtLink>
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
    let name = ref(null)
    let password_confirmation = ref(null)

    let errors = ref(null)

    const register = async () => {
        isButtonDisabled.value=true;
        errors.value = null
        try {
            await userStore.register({
                name: name.value,    
                email: email.value,
                password: password.value,
                password_confirmation: password_confirmation.value
            });
            isButtonDisabled.value=false;
            const token = window.localStorage.getItem('projectify_token');
            if (token) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + userStore.api_token;
            }
            router.push('/tasks')
        } catch (error) {
            isButtonDisabled.value=false;
            if (error.response && error.response.status === 422) {
            // Validation errors returned from the backend
            errors.value = error.response.data.errors;
           
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
