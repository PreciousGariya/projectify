<template>
    <div class="container">
        <h3 class="title">Profile</h3>
        <div class="col-md-6">
            <form action="">
                <div class="form-group mt-4">
                    <input class="form-control" type="text" name="name" :value="full_name" placeholder="Name" readonly>
                </div>

                <div class="form-group mt-4">
                    <input class="form-control" type="text" name="name" :value="email" placeholder="Email" readonly>
                </div>

                <div class="form-group">
                    <input v-if="email_verified_at" class="form-control" type="text" name="name" value="Verified"
                        placeholder="Email verify">
                    <div class="mt-4" v-else>
                        <Button class="btn btn-success green_gradient" disabled>Resend verification email</Button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</template>

<script setup>

import { useUserStore } from '~~/stores/user'
import { storeToRefs } from 'pinia';
const router = useRouter()
const userStore = useUserStore()
const showDrop = ref(false)
const { email, id,
    full_name, email_verified_at } = storeToRefs(userStore)
definePageMeta({
    layout: "custom",
    middleware: 'is-logged-out'
})
</script>