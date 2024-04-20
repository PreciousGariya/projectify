<template>
    <div>
        <slot/>
    </div>
</template>


<style >
/* Custom CSS for login section */
.login {
    background-color: #f8f9fa;
    /* Set background color */
    height: 100vh;
    /* Set height to fill viewport */
}

.login h3 {
    color: #333;
    /* Set heading color */
    text-align: center;
    /* Center align heading */
}

.login form {
    background-color: #fff;
    /* Set form background color */
    padding: 30px;
    /* Add padding around the form */
    border-radius: 8px;
    /* Add border radius to form */
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    /* Add box shadow for depth */
}

.login form label {
    font-weight: bold;
    /* Set label font weight */
}

.login form input[type="email"],
.login form input[type="password"] {
    width: 100%;
    /* Set input width to fill container */
}

.login form .btn {
    width: 100%;
    /* Set button width to fill container */
}

.login form .btn-default {
    display: block;
    /* Make link button full width */
    text-align: center;
    /* Center align link button text */
    margin-top: 20px;
    /* Add margin above link button */
}

/* Responsive styles */
@media (max-width: 768px) {
    .login {
        padding-top: 50px;
        /* Add space at the top on smaller screens */
    }

    .login form {
        padding: 20px;
        /* Reduce padding for smaller screens */
    }
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
    border: none
}
</style>