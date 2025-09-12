<template>
    <form @submit.prevent="login" style="max-width: 300px; margin: auto; padding: 1rem; border: 1px solid #ccc; border-radius: 5px;">
        <h2>Login</h2>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" v-model="email" required />
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" v-model="password" required />
        </div>
        <button type="submit">Login</button>
    </form>
</template>
<script>
import axios from 'axios';


export default {
    data() {
        return {
            email: '',
            password: ''
        };
    },
    methods: {
        async login() {
            axios.post('http://localhost:8000/api/auth/login', {
                email: this.email,
                password: this.password
            })
            .then(response => {
                console.log('Login successful:', response.data);
                localStorage.setItem('token', response.data.token);
                localStorage.setItem('permisos', JSON.stringify(response.data.permisos));
                this.$router.push('/');
            })
            .catch(error => {
                // console.error('Error during login:', error);
                alert('Login failed: ' + (error.response?.data?.message || error.message));
            });
        }
    }
};
</script>