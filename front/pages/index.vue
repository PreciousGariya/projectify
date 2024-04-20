<template>
    <section class="login mt-4">
        <div class="container">
            <div class="row justify-content-center"> <!-- Add justify-content-center to center the columns -->
                <h1>Auth</h1>
            </div>
        </div>
    </section>
</template>


<script setup>
 definePageMeta({
        layout: "custom",
        middleware: 'is-logged-out'
    })
</script>