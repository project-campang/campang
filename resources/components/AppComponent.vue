<template>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <router-link to="/" class="navbar-brand my-logo-img"></router-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">캠핑장 모아보기 |</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                캠핑Talk 
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">가입인사</a></li>
                                <li><a class="dropdown-item" href="#">자유게시판</a></li>
                                <li><a class="dropdown-item" href="#">랭킹</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">리뷰 모아보기</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">FAQ</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <div v-if="!$store.state.authFlg">
                            <button @click.prevent="openLogin" class="btn btn-outline-success me-2">로그인</button>
                            <button @click.prevent="openRegistration" class="btn btn-outline-success me-2">가입하기</button>
                        </div>
                        <div v-else>
                            <button @click.prevent="logout" class="btn btn-outline-success">로그아웃</button>
                            <button type="button" class="btn btn-outline-success">마이페이지</button>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <!-- loginModal -->
    <div v-show="loginFlg" class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="loginModalLabel">로그인</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="login">
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">이메일</label>
                            <input type="email" v-model="loginForm.email" class="form-control" id="loginEmail" autocomplete="email">
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">비밀번호</label>
                            <input type="password" v-model="loginForm.password" class="form-control" id="loginPassword" autocomplete="password">
                        </div>
                        <div class="mb-3">
                            <p>혹시 가입한 적 없으신가요?</p>
                            <a href="#" @click.prevent="goToRegistration">회원가입하러가기</a>
                        </div>
                        <div class="modal-footer">
                            <button @click="closeLogin" type="button" class="btn btn-secondary">취소</button>
                            <button type="submit" class="btn btn-primary">로그인</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- registrationModal -->
    <div v-show="registrationFlg" class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="registrationModalLabel">회원가입</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="register">
                        <div class="mb-3">
                            <label for="name" class="form-label">이름</label>
                            <input type="text" v-model="registerForm.name" class="form-control" id="name" autocomplete="name">
                        </div>
                        <div class="mb-3">
                            <label for="id" class="form-label">아이디</label>
                            <input type="text" v-model="registerForm.id" class="form-control"  id="id"  required autocomplete="id"/>
                        </div>    
                        <div class="mb-3">
                            <label for="email" class="form-label">이메일</label>
                            <input type="email" v-model="registerForm.email" class="form-control" id="email" autocomplete="email">
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-outline-secondary">이메일 중복 확인</button>
                        </div>
                        <div class="mb-3">
                            <label for="nickname" class="form-label">닉네임</label>
                            <input type="text" v-model="registerForm.nickname" class="form-control" id="nickname" autocomplete="nickname">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">비밀번호</label>
                            <input type="password" v-model="registerForm.password" class="form-control" id="password" autocomplete="password">
                        </div>
                        <div class="mb-3">
                            <label for="ps_chk" class="form-label">비밀번호 확인</label>
                            <input type="password" v-model="registerForm.ps_chk" class="form-control" id="ps_chk" autocomplete="ps_chk">
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">휴대폰 번호</label>
                            <input type="text"  v-model="registerForm.phone_number" class="form-control"  id="phone_num" @input="oninputPhone" maxlength="14" autocomplete="user_num"/>
                        </div>
                        <div class="modal-footer">
                            <button @click="closeRegistration" type="button" class="btn btn-secondary">취소</button>
                            <button type="submit" class="btn btn-primary">회원가입</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <main>
        <router-view></router-view>
    </main>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useStore } from 'vuex';
import axios from 'axios';

const loginForm = ref({
    email: '',
    password: ''
});

const registerForm = ref({
    name: '',
    email: '',
    nickname: '',
    password: '',
    ps_chk: '',
    id:'',
});

const loginFlg = ref(false);
let loginModal;

const registrationFlg = ref(false);
let registrationModal;

const store = useStore();

onMounted(() => {
    const loginModalElement = document.getElementById('loginModal');
    if (loginModalElement) {
        import('bootstrap').then(({ Modal }) => {
            loginModal = new Modal(loginModalElement);
        }).catch(err => {
            console.error('Bootstrap Modal import error:', err);
        });
    }

    const registrationModalElement = document.getElementById('registrationModal');
    if (registrationModalElement) {
        import('bootstrap').then(({ Modal }) => {
            registrationModal = new Modal(registrationModalElement);
        }).catch(err => {
            console.error('Bootstrap Modal import error:', err);
        });
    }
});

function openLogin() {
    if (loginModal) {
        loginFlg.value = true;
        loginModal.show();
    }
}

function closeLogin() {
    if (loginModal) {
        loginFlg.value = false;
        loginModal.hide();
    }
}

function openRegistration() {
    if (registrationModal) {
        registrationFlg.value = true;
        registrationModal.show();
    }
}

function closeRegistration() {
    if (registrationModal) {
        registrationFlg.value = false;
        registrationModal.hide();
    }
}

function goToRegistration() {
    closeLogin();
    openRegistration();
}

function logout() {
    store.dispatch('logout');
}

function login() {
    store.dispatch('login', loginForm.value).then(() => {
        closeLogin();
    });
}

function register() {
    store.dispatch('register', registerForm.value).then(() => {
        closeRegistration();
    });
}

// 휴대폰
function oninputPhone(event) {
    event.target.value = event.target.value
        .replace(/[^0-9]/g, '')
        .replace(/(^02.{0}|^01.{1}|[0-9]{3,4})([0-9]{3,4})([0-9]{4})/g, "$1-$2-$3");
}
</script>
  
  <style>
  @import url('../css/main.css');
  </style>
  