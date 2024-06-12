<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <router-link to="/" class="navbar-brand my-logo-img"></router-link>
            <button @click="toggleMenu" class="navbar-toggler" type="button" data-bs-toggle="collapse"  aria-label="Toggle navigation">
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
                                <button @click="kakao_login" class="btn"><img src="/img/kakao-login.png" alt="카카오 로그인"></button>
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
                                <label for="email" class="form-label">이메일</label>
                                <input type="email" v-model="registerForm.email" class="form-control" id="email" autocomplete="email">
                                <div v-if="emailCheckResult !== null" class="alert" :class="[emailCheckResult ? 'alert-danger' : 'alert-success']">
                                    {{ emailCheckResult ? '중복된 이메일입니다.' : '사용 가능한 이메일입니다.' }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="button" @click="checkEmail" class="btn btn-outline-secondary">이메일 중복 확인</button>
                            </div>
                            <div class="mb-3">
                                <label for="nick_name" class="form-label">닉네임</label>
                                <input type="text" v-model="registerForm.nick_name" class="form-control" id="nick_name" autocomplete="nickname">
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
                                <label for="tel" class="form-label">휴대폰 번호</label>
                                <input type="text" v-model="registerForm.tel" class="form-control" id="tel" @input="oninputPhone" maxlength="14" autocomplete="user_num"/>
                            </div>
                            <div class="modal-footer">
                                <button @click="kakao_login" class="btn"><img src="/img/kakao-login.png" alt="카카오 로그인"></button>
                                <button @click="closeRegistration" type="button" class="btn btn-secondary">취소</button>
                                <button type="submit" class="btn btn-primary">회원가입</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
        <div>
            <router-view></router-view>
        </div>
    </template>
    
    <script setup>
    import { ref, onMounted } from 'vue';
    import { useStore } from 'vuex';
    import axios from 'axios';
    
    // 카카오 로그인
    const client_id = 'd7c42425629cbc0e91436aca75ca6fcc';
    const redirect_uri = 'http://127.0.0.1:8000/oauth/kakao';
    
    const KAKAO_AUTH_URL = `https://kauth.kakao.com/oauth/authorize?client_id=${client_id}&redirect_uri=${encodeURIComponent(redirect_uri)}&response_type=code`;
    
    const loginForm = ref({
        email: '',
        password: ''
    });
    
    const registerForm = ref({
        name: '',
        email: '',
        nick_name: '',
        password: '',
        ps_chk: '',
        tel: '',
    });
    
    const loginFlg = ref(false);
    let loginModal;
    
    const registrationFlg = ref(false);
    let registrationModal;
    
    const store = useStore();
    
    // 햄버거바
    function toggleMenu() {
    const navbarCollapse = document.getElementById('navbarSupportedContent');
    
        navbarCollapse.classList.toggle('show');
    }



    
    onMounted(() => {
        const loginModalElement = document.getElementById('loginModal');
        if (loginModalElement) {
            import('bootstrap').then(({ Modal }) => {
                loginModal = new Modal(loginModalElement);
            });
        }
    
        const registrationModalElement = document.getElementById('registrationModal');
        if (registrationModalElement) {
            import('bootstrap').then(({ Modal }) => {
                registrationModal = new Modal(registrationModalElement);
            });
        }
    });
    
    function openLogin() {
        loginFlg.value = true;
        loginModal.show();
    }
    
    function closeLogin() {
        loginFlg.value = false;
        loginModal.hide();
    }
    
    function openRegistration() {
        registrationFlg.value = true;
        registrationModal.show();
    }
    
    function closeRegistration() {
        registrationFlg.value = false;
        registrationModal.hide();
    }
    
    // 로그인 폼 초기화 함수
    function resetLoginForm() {
        loginForm.value = {
            email: '',
            password: ''
        };
    }
    
    // 회원가입 폼 초기화 함수
    function resetRegisterForm() {
        registerForm.value = {
            name: '',
            email: '',
            nick_name: '',
            password: '',
            ps_chk: '',
            tel: '',
        };
    }
    
    // 로그인 후 폼 초기화
    function login() {
        store.dispatch('login', loginForm.value)
            .then(() => {
                resetLoginForm(); // 폼 초기화
                closeLogin();
            })
            .catch(error => {
                console.error('로그인 실패:', error);
            });
    }
    
    // 로그아웃 후 처리
    function logout() {
        store.dispatch('logout')
            .then(() => {
                resetLoginForm(); // 폼 초기화
                closeLogin();
            })
            .catch(error => {
                console.error('로그아웃 실패:', error);
            });
    }
    
    // 회원가입 후 폼 초기화
    function register() {
        store.dispatch('register', registerForm.value)
            .then(() => {
                resetRegisterForm(); // 폼 초기화
                closeRegistration();
            })
            .catch(error => {
                console.error('회원가입 실패:', error);
            });
    }
    
    // 이메일을 저장할 변수
    const emailToCheck = ref('');
    // 이메일 중복 확인 결과를 저장할 변수
    const emailCheckResult = ref(null);

    // 이메일 중복 확인 메서드
    async function checkEmail() {
        // 이메일이 비어있는지 확인
        if (!emailToCheck.value) {
            // 이메일이 비어있으면 에러 메시지 표시
            emailCheckResult.value = true; // true는 중복된 이메일임을 나타냄
            return;
        }

        // 이메일 중복 확인 요청 보내기
        try {
            const response = await axios.post('/api/check-email', { email: emailToCheck.value });
            // 중복된 이메일인지 확인하고 결과 표시
            emailCheckResult.value = response.data.duplicate;
        } catch (error) {
            console.error('이메일 중복 확인 실패:', error);
            // 에러 발생 시 기본적으로 중복된 이메일로 처리
            emailCheckResult.value = true;
        }
    }




    function goToRegistration() {
        closeLogin();
        openRegistration();
    }
    
    function oninputPhone() {
        const phone = registerForm.value.tel.replace(/[^0-9]/g, '');
        const phoneLength = phone.length;
    
        if (phoneLength < 4) {
            registerForm.value.tel = phone;
        } else if (phoneLength < 7) {
            registerForm.value.tel = phone.slice(0, 3) + '-' + phone.slice(3);
        } else if (phoneLength < 11) {
            registerForm.value.tel = phone.slice(0, 3) + '-' + phone.slice(3, 6) + '-' + phone.slice(6);
        } else {
            registerForm.value.tel = phone.slice(0, 3) + '-' + phone.slice(3, 7) + '-' + phone.slice(7);
        }
    }
    
    function kakao_login() {
      window.location.href = KAKAO_AUTH_URL;
    //   store.dispatch('kakao_login');
    }
    </script>
    
    <style>
    @import url(../css/main.css);
    </style>
    