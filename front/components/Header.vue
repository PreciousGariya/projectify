<template>
    <div>
        <header class="p-3 mb-3 border-bottom">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-between justify-content-lg-between">
                    <NuxtLink href="/tasks"
                        class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                        <span class="fs-4">Taskify</span>
                    </NuxtLink>

                    <div class="dropdown text-end">
                        <a href="#" @click="showDrop = !showDrop" :title="email"
                            class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ full_name }}
                        </a>
                        <ul v-if="showDrop" class="dropdown-menu text-small" aria-labelledby="dropdownUser1"
                            style="display: block;">
                            <li>
                                <NuxtLink class="dropdown-item" to="/profile">Profile</NuxtLink>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#" @click="logout()">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
    </div>
</template>

<script setup>
import { useUserStore } from '~~/stores/user'
import { storeToRefs } from 'pinia';
import Swal from 'sweetalert2'

const router = useRouter()
const userStore = useUserStore()
const showDrop = ref(false)
const { email, id,
    full_name } = storeToRefs(userStore)



const logout = async () => {
    Swal.fire({
        title: "Are you sure?",
        text: "You want to logout!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Log me out!"
    }).then(async (result) => {
        if (result.isConfirmed) {
            await userStore.logout();
            localStorage.removeItem('token');
            await Swal.fire({
                title: "Logout!",
                text: "You are logged out successfully.",
                icon: "success"
            });
            router.push('/');
        }
    });

}


</script>