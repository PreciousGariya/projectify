<template>
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between justify-content-lg-between">
            <h3>Create Tasks</h3>
            <NuxtLink to="/tasks" class="btn btn-success btn-sm">
                <Icon name="ion:list" width="24" height="24"  style="color: white" /> Tasks
            </NuxtLink>

            
        </div>
        <div class="col-md-12">
            <form @submit.prevent="createTask">
                <div class="form-group mt-3">
                    <label for="title">Title</label>
                    <input v-model="formData.title" class="form-control" type="text" id="title" required>
                </div>
                <div class="form-group mt-3">
                    <label for="description">Description</label>
                    <textarea v-model="formData.description" class="form-control" id="description"></textarea>
                </div>
                <div class="form-group mt-3">
                    <label for="status">Asign To</label>
                    <select v-model="formData.user_id" class="form-control" id="status" required>
                        <option value="" selected>--Select user--</option>
                        <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="deadline">Deadline</label>
                </div>
                <div class="form-group mt-3">
                    <Calendar dateFormat="dd/mm/yy" v-model="formData.deadline" :minDate="today" showButtonBar  :manualInput="false" placeholder="Select Date" />
                </div>

                <button class="btn btn-success mt-4" type="submit">
                    <Icon name="material-symbols:save-outline" width="24" height="24"  style="color: white" />
                    Create Task</button>
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
    errors.value = null
    try {
        console.log('formData.value', formData.value);
        await taskStore.createTask(formData.value);
        Swal.fire(
            'Awesome!',
            "Task Created Successfully",
            'success',
        );
        router.push('/tasks')
    } catch (error) {
        errors.value = error;
        Swal.fire(
            'Opps!',
            "Something went wrong please try again!",
            'error',
        );
    }
}


</script>