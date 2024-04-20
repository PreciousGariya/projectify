<template>
    <div class="container">

        <div class="col-md-12 box">
            <div class="d-flex flex-wrap align-items-center justify-content-between justify-content-lg-between">
                <h3>Create Tasks</h3>
                <NuxtLink to="/tasks" class="btn btn-success btn-sm blue_gradient">
                    <Icon name="ion:list" width="24" height="24" style="color: white" /> Tasks
                </NuxtLink>
            </div>

            <form @submit.prevent="createTask">
                <div class="form-group mt-3">
                    <label for="title">Title</label>
                    <input v-model="formData.title" class="form-control" type="text" id="title">
                    <small class="text-danger" for="" v-if="errors && errors.title">{{ errors.title[0] }}</small>

                </div>
                <div class="form-group mt-3">
                    <label for="description">Description</label>
                    <textarea v-model="formData.description" class="form-control" id="description"></textarea>
                    <small class="text-danger" for="" v-if="errors && errors.description">{{ errors.description[0]
                        }}</small>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mt-3">
                            <label for="status">Asign To</label>
                            <select v-model="formData.user_id" class="form-control" id="status">
                                <option value="" selected>--Select user--</option>
                                <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
                            </select>
                            <small class="text-danger" for="" v-if="errors && errors.user_id">{{ errors.user_id[0]
                                }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mt-3">
                            <label for="deadline">Deadline</label>
                        </div>
                        <div class="card flex justify-content-center">
                        <Calendar dateFormat="dd/mm/yy" v-model="formData.deadline" :minDate="today" showButtonBar
                            :manualInput="false" placeholder="d-m-y" style="border: none;" />
                        <small class="text-danger" for="" v-if="errors && errors.deadline">{{errors.deadline[0]
                            }}</small>
                            </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-success mt-4 green_gradient" type="submit" :disabled="isButtonDisabled">
                        <Icon name="material-symbols:save-outline" width="24" height="24" style="color: white" />
                        Create Task
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { useTaskStore } from '~~/stores/task';
import { storeToRefs } from 'pinia';
import Swal from 'sweetalert2';
import Calendar from 'primevue/calendar';

definePageMeta({
    layout: "custom",
    middleware: 'is-logged-out'
})
let today = new Date();


const formData = ref({
    title: '',
    description: '',
    // status: '',
    user_id: '',
    deadline: ''
});

const errors = ref(null)

const router = useRouter()
const isButtonDisabled = ref(false);
const taskStore = useTaskStore()
const { tasks, users } = storeToRefs(taskStore)

onMounted(async () => {
    try {
        await taskStore.getUsers()
    } catch (error) {
        console.log(error)
    }
});
const createTask = async () => {
    errors.value = null;
    isButtonDisabled.value=true;
    try {
        console.log('formData.value', formData.value);
        await taskStore.createTask(formData.value);
        isButtonDisabled.value=false;
        Swal.fire(
            'Awesome!',
            "Task Created Successfully",
            'success',
        );
        router.push('/tasks');
    } catch (error) {
        isButtonDisabled.value=false;
        if (error.response && error.response.status === 422) {
            // Validation errors returned from the backend
            errors.value = error.response.data.errors;
        } else {
            // Other errors
            console.error('Error:', error);
            Swal.fire(
                'Opps!',
                "Something went wrong, please try again!",
                'error',
            );
        }
    }
};



</script>