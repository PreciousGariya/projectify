<template>
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between justify-content-lg-between">
            <h3>Edit Tasks</h3>
            <div class="button">
                <NuxtLink to="/tasks" class="btn btn-success btn-sm">
                    <Icon name="ion:list" width="24" height="24"  style="color: white" /> Tasks
                </NuxtLink>
            </div>
        </div>
        <div class="col-md-12">
            <form @submit.prevent="UpdateTask">
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
                    <label for="status">Status</label>
                    <select v-model="formData.status" class="form-control" id="status" required>
                        <option value="" selected>--Select Default Status--</option>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                        <option value="overdue">Overdue</option>
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="deadline">Deadline</label>
                </div>
                <div class="form-group mt-3">
                    <Calendar dateFormat="dd/mm/yy" v-model="formData.deadline" :minDate="today" showButtonBar  :manualInput="false" />
                </div>
                <button class="btn btn-success mt-4" type="submit">
                    <Icon name="material-symbols:save-outline" width="24" height="24"  style="color: white" />
                    Update Task</button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { useTaskStore } from '~~/stores/task';
import { storeToRefs } from 'pinia';
import Swal from 'sweetalert2'

definePageMeta({
    layout: "custom",
    middleware: 'is-logged-out'
})
const errors = ref(null);
const { $toaster } = useNuxtApp()
const router = useRouter();
let today = new Date();

const route = useRoute();
const taskStore = useTaskStore();
const { task, users } = storeToRefs(taskStore);
const formData = ref({
    title: '',
    description: '',
    status: '',
    user_id: '',
    deadline: ''
});

watch(task, (newValue) => {
    // If taskData has values, assign them to formData
    if (newValue) {
        formData.value.title = newValue.title;
        formData.value.description = newValue.description;
        formData.value.status = newValue.status;
        formData.value.user_id = newValue.user_id;
        formData.value.deadline = newValue.deadline_formatted;
    }
});



onMounted(async () => {
    try {
        await taskStore.getUsers();
        await taskStore.getTaskByid(route.params.id)
        // taskData.value = task;
    } catch (error) {
        console.log(error)
    }
});

const UpdateTask = async () => {
    errors.value = null
    try {
        console.log('formData.value', formData.value);
        await taskStore.updateTask(formData.value, route.params.id);
        Swal.fire(
            'Awesome!',
            "Task updated Successfully",
            'success',
            );
        router.push('/tasks')
    } catch (error) {
        errors.value = error;
        Swal.fire(
            'Opps!',
            "Something Went Wrong Please try again!!",
            'error',
        );
        console.log('error',error);
    }
}


</script>