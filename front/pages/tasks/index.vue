<template>
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between justify-content-lg-between">
            <h3>Tasks</h3>
            <div class="button">
                <NuxtLink to="/tasks/add" class="btn btn-success btn-sm">
                    <Icon name="mdi:plus" width="24" height="24" style="color: white" /> Create New Task
                </NuxtLink>
            </div>
        </div>
        <div class="col-md-12">
            <div class="table">
                <table class="table table-stripped" style="font-size: 14px;">
                    <thead>
                        <tr>
                            <td>SN</td>
                            <td>Title</td>
                            <td>Description</td>
                            <td>Due</td>
                            <td>Owner</td>
                            <td>Created by</td>
                            <td>Status</td>
                            <td>Created at</td>
                            <td>Updated At</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="(task, index) in tasks" :key="task.id">
                            <td>{{ ++index }}</td>
                            <td>{{ task.title }}</td>
                            <td>{{ task.description }}</td>
                            <td>{{ task.deadline_formatted }}

                                <b-badge v-if="task.deadline_left === 'Today'" variant="warning">{{ task.deadline_left
                                    }}</b-badge>
                                <b-badge v-else-if="task.deadline_left === 'Overdue'" variant="danger">{{
                            task.deadline_left }}</b-badge>
                                <b-badge v-else variant="success">{{ task.deadline_left }}</b-badge>
                            </td>
                            <td>{{ task.user_name }}</td>
                            <td>{{ task.created_by_name }}</td>
                            <td>
                                <select name="" @change="updateTheStatus(task.uid, task.status, $event.target.value)"
                                    class="form-control">
                                    <option value="pending" :selected="task.status === 'pending'">pending</option>
                                    <option value="completed" :selected="task.status === 'completed'">completed</option>
                                    <option value="overdue" :selected="task.status === 'overdue'">overdue</option>
                                </select>
                            </td>
                            <td>{{ task.created_at }}</td>
                            <td>{{ task.updated_at }}</td>
                            <td>
                                <NuxtLink class="btn btn-primary btn-sm" :to="'/tasks/edit/' + task.uid">
                                    <Icon name="mdi:pencil" width="24" height="24" style="color: white" />
                                </NuxtLink>
                                <button class="btn btn-danger btn-sm" @click="deleteTheTask(task.uid)">
                                    <Icon name="mdi:trash" width="24" height="24" style="color: white" />
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <!-- Previous Page Link -->
                            <!-- Page Links -->
                            <li class="page-item" v-for="(link, index) in tasks_meta.links" :key="index"
                                :class="{ 'active': link.active }">
                                <a class="page-link" href="#" v-if="!link.active"
                                    @click.prevent="navigateToPage(link.label)" v-html="link.label">
                                </a>
                                <span class="page-link" v-else>{{ link.label }}</span>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
definePageMeta({
    layout: "custom",
    middleware: 'is-logged-out'
})
import { useTaskStore } from '~~/stores/task';
import { storeToRefs } from 'pinia';
import Swal from 'sweetalert2';
const taskStore = useTaskStore()
const { tasks, deleteTask, updateStatu, tasks_meta } = storeToRefs(taskStore)
const currentPage = ref(1); // Track the current page
onMounted(async () => {
    try {
        await taskStore.getTask(currentPage.value)
    } catch (error) {
        console.log(error)
    }
});

const navigateToPage = (val) => {

    if (val === '&laquo; Previous') {
        prevPage();
        return;
    }
    if (val === 'Next &raquo;') {
        nextPage();
        return;
    }

    currentPage.value = val;
    getTasks();
}

const nextPage = () => {
    console.log(tasks_meta.value.last_page, currentPage.value);
    if (currentPage.value === tasks_meta.value.last_page) {
        return;
    }
    currentPage.value++;
    getTasks();
};

const prevPage = () => {
    if (currentPage.value > 1) {
        currentPage.value--;
        getTasks();
    }
};

const getTasks = async () => {
    try {
        await taskStore.getTask(currentPage.value); // Pass current page to getTask method
    } catch (error) {
        console.log(error);
    }
};


const updateTheStatus = (taskUid, taskStatus, selectedValue) => {

    try {
        Swal.fire({
            title: "Are you sure?",
            text: "You want to change status",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Change it!"
        }).then(async (result) => {
            if (result.isConfirmed) {
                await taskStore.updateStatus(taskUid, {
                    old_status: taskStatus,
                    status: selectedValue
                });
                Swal.fire({
                    title: "Updated!",
                    text: "Your task has been updated.",
                    icon: "success"
                });
                await taskStore.getTask();
            }
        });
    }
    catch (error) {
        // console.log(error.response.data.message)
        Swal.fire(
            'Opps!',
            error.response.data.message,
            'error',
        );


    }


}

const deleteTheTask = async (id) => {
    // console.log('id', id);
    try {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then(async (result) => {
            if (result.isConfirmed) {
                await taskStore.deleteTask(id)
                Swal.fire({
                    title: "Deleted!",
                    text: "Your task has been deleted.",
                    icon: "success"
                });
                await taskStore.getTask();
            }
        });
    }
    catch (error) {
        // console.log(error.response.data.message)
        Swal.fire(
            'Opps!',
            error.response.data.message,
            'error',
        );


    }
}

</script>