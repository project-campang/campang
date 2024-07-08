<template>
<form class="admin-form"  @submit.prevent="adminLogin">
    <div class="row g-3 align-items-center ">
        <div class="col-auto">
        <label for="email" class="col-form-label">ID</label>
        </div>
        <div class="col-auto">
            <input type="email" v-model="loginForm.email" id="email" class="form-control" aria-describedby="passwordHelpInline">
        </div>
        <div class="col-auto">
            <label for="password"  class="col-form-label">PW</label>
        </div>
        <div class="col-auto">
            <input type="password" v-model="loginForm.password" id="password" class="form-control" aria-describedby="passwordHelpInline">
        </div>
        <div v-if="errorMessage" class="alert alert-danger" role="alert">
            {{ errorMessage }}
        </div>
    </div>    
    <button type="submit" class="btn btn-primary">로그인</button>
</form>
</template>
<script setup>
import { ref } from 'vue';
import { useStore } from 'vuex';
import axios from 'axios';
import { useRoute } from 'vue-router';

const store = useStore();

const errorMessage = ref(null);
const loginForm = ref({
    email: '',
    password: ''
});

async function adminLogin() {
    try {
        const response = await store.dispatch('adminLogin', loginForm.value);
        resetLoginForm();
        // closeLogin();
    } catch (error) {
        console.error('로그인 실패:', error);
        if (error.response && error.response.status === 401) {
            errorMessage.value = '아이디 혹은 비밀번호가 틀렸습니다.';
        } else {
            errorMessage.value = '로그인 중 오류가 발생했습니다. 다시 시도해주세요.';
        }
    }
}

function resetLoginForm() {
    loginForm.value = {
        email: '',
        password: ''
    };
}
</script>

<style scoped src="../css/admin.css"></style>