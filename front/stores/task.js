import { defineStore } from "pinia";
import axios from "~/plugins/axios";
const $axios = axios().provide.axios;

export const useTaskStore = defineStore('task', {
    state: () => ({
        tasks: {},
        task: {},
        users: {},
        tasks_meta:{},
        isLoading: false,
    }),
    actions: {
        async getTask(pageno, offset) {
            try {
                const pageSize = 10; 
                const calculatedOffset = (pageno - 1) * pageSize + (offset || 0);
                let res = await $axios.get('tasks', {
                    params: {
                        offset: calculatedOffset,
                        per_page: pageSize, 
                        page: pageno,
                    }
                });
        
                this.$state.tasks = res.data.data;
                this.$state.tasks_meta = res.data.meta;   
            } catch (error) {
                console.error("Error fetching tasks:", error);
            }
        },

        async getTaskByid(uid) {
            let res = await $axios.get(`tasks/${uid}`)
            this.$state.task = res.data.data;
        },

        async getUsers() {
            let res = await $axios.get('users')
            this.$state.users = res.data.data;
        },

        async createTask(data){
            console.log('data', data);
            let res = await $axios.post('tasks',data)
            console.log('res', res);
            // this.$state.users = res.data.data;
        },
        async updateTask(data, id){
            let res = await $axios.put(`tasks/${id}`,data)
        },
        async deleteTask(id){
            let res = await $axios.delete(`tasks/${id}`)
        },
        async updateStatus(id,data){
            let res = await $axios.put(`tasks/status/${id}`,data)
        }
    },
    persist: true,
})