<template>
    <div class="section">
        <div class="row mt-5">
            <div class="col-md-10 offset-md-1 text-center">
                <h1>Welcome to Projectify</h1>
                <p>A powerful project management system to streamline your workflow and collaboration.</p>
                <div class="mt-4">
                    <NuxtLink to="/login" class="btn btn-primary mr-3 gradient-button">
                        <Icon name="material-symbols:login" width="24" height="24"  style="color: white" />
                        Login</NuxtLink>
                    <NuxtLink to="/register" class="btn btn-secondary mx-3 gradient-button">
                        <Icon name="mdi:register" width="24" height="24"  style="color: white" />
                        Register</NuxtLink>
                </div>
            </div>
        </div>
    </div>
</template>

<style scopped>
.section {
    width: 100%;
    height: 100vh; /* Set container height to viewport height */
    display: flex; /* Use flexbox */
    justify-content: center; /* Center content horizontally */
    align-items: center; /* Center content vertically */
    background: linear-gradient(45deg, #405DE6, #5851DB, #833AB4, #C13584, #E1306C, #FD1D1D, #F56040, #F77737, #FCAF45, #FFDC80); /* Instagram-like gradient */
}

.content {
    text-align: center; /* Center text horizontally */
    color: #fff; /* Text color */
}

h1{
    font-size: 2.5rem;
    color: #ffff;
    font-weight: 800;
}

p{
    color: #fff;
    /* font-size: 20px; */
}
.gradient-button {
    padding: 10px 20px; /* Adjust padding as needed */
    font-size: 16px; /* Adjust font size as needed */
    color: #fff; /* Text color */
    border: none; /* Remove border */
    border-radius: 5px; /* Add border radius */
    cursor: pointer; /* Change cursor on hover */
    background: linear-gradient(to right, #ff416c, #ff4b1f); /* Gradient background */
}

.gradient-button:hover {
    opacity: 0.8; /* Reduce opacity on hover */
}


</style>