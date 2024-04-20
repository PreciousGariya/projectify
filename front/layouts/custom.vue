<template>
    <div>
        <Header />
        <slot />
        <Footer />
    </div>
</template>

<script setup>
import Header from '../components/Header.vue';
import Footer from '../components/Footer.vue'
</script>


<style>

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.box {
    background-color: #fff;
    /* Set form background color */
    padding: 30px;
    /* Add padding around the form */
    border-radius: 8px;
    /* Add border radius to form */
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

h3 {
    font-size: 24px;
    margin-bottom: 20px;
}

.table {
    margin-top: 20px;
}

.table thead th {
    font-weight: bold;
}

.table tbody td {
    vertical-align: middle;
}

.pagination {
    margin-top: 20px;
}

.pagination li {
    display: inline-block;
    margin-right: 5px;
}

.pagination li:last-child {
    margin-right: 0;
}

.pagination a,
.pagination span {
    display: inline-block;
    padding: 5px 10px;
    color: #333;
    border: 1px solid #ccc;
    border-radius: 3px;
    text-decoration: none;
    cursor: pointer;
}

.pagination a:hover {
    background-color: #f0f0f0;
}

.pagination .active {
    background-color: #007bff;
    color: #fff;
    border-color: #007bff;
}

@media (max-width: 768px) {
    .container {
        padding: 10px;
    }
}

@media (max-width: 576px) {
    h3 {
        font-size: 20px;
    }
}

.blue_gradient  {
    color: #fff; 
    border: none; 
    border-radius: 5px; 
    cursor: pointer;
    background: linear-gradient(to right, #007bff, #00bfff);
}

.blue_gradient :hover {
    opacity: 0.8;
    border: none; 
}
.red_gradient {
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    background: linear-gradient(to right, #ff4d4d, #ff6666); /* Red Gradient */
}

.red_gradient:hover {
    opacity: 0.8;
    border: none;
}

/* Yellow Gradient Button */
.yellow_gradient {
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    background: linear-gradient(to right, #ffd633, #ffdb4d); /* Yellow Gradient */
}

.yellow_gradient:hover {
    opacity: 0.8;
    border: none;
}

/* Green Gradient Button */
.green_gradient {
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    background: linear-gradient(to right, #00cc66, #00e673); /* Green Gradient */
}

.green_gradient:hover {
    opacity: 0.8;
    border: none;
}

.form-group label {
    font-weight: bold;
}


thead td{
    font-weight: bold;
}
</style>