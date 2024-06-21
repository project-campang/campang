<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary my-nav-header">
        <div class="container-fluid main-header">
            <router-link to="/main" class="navbar-brand my-logo-img"></router-link>
            <button @click="toggleMenu" class="navbar-toggler" type="button" data-bs-toggle="collapse" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">캠핑장 모아보기</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a @click="toggleDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            캠핑Talk 
                        </a>
                        <ul v-if="showDropdown" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li v-for="communityType in communityTypes" :key="communityType.type">
                                <a class="dropdown-item" :href="`/community/${communityType.type}`">{{ communityType.name }}</a>
                            </li>
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
                        <router-link to="/mypage" class="btn btn-outline-success">마이페이지</router-link>
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
                    <button type="button" class="btn-close" @click="closeLogin" aria-label="Close"></button>
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
                    <button type="button" class="btn-close" @click="closeRegistration" aria-label="Close"></button>
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

    <div class="router-view-container">
        <router-view></router-view>
    </div>

    <!-- 푸터 -->
    <div class="main-footer">
        <div class="main-footer-content">
            <h2>CAMPANG <img src="/img/logo-ko3.png" alt=""></h2>
            <p>개인정보처리방침 | 전자우편무단수집거부 | 캠핑장 | 등록안내 | 미등록야영장불법영업신고</p>
            <p>
                대구시 달서구 남일동 109-2 그린컴퓨터아트학원 
                <hr>
                대구캠퍼스 TEL : 0507-1414-1018 (상담시간 : 평일 10:00~18:00)EMAIL : green@gampang.or.kr
                <hr>
                <br>
                Copyrights(c) 2024 GREEN COMPUTER ACADEMY DAEGU BRANCH 2ND PROJECT TEAM 3.
            </p>
        </div>
   </div>
   <button @click="backToTop" ref="btnBackToTop" id="btn-back-to-top" title="위로 가기">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="50"
            height="50"
            fill="currentColor"
            class="bi bi-caret-up-square-fill"
            viewBox="0 0 16 16"
        >
            <path
                d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm4 9h8a.5.5 0 0 0 .374-.832l-4-4.5a.5.5 0 0 0-.748 0l-4 4.5A.5.5 0 0 0 4 11"
            />
        </svg>
    </button>
</template>


<script setup>
import { ref, onMounted, computed } from 'vue';
import { useStore } from 'vuex';
import axios from 'axios';
import { useBackToTop } from "../js/scrolltop.js";

// 드롭다운
// const communityTypes = ref([]);
// const showDropdown = ref(false);

// onMounted(async () => {
//     try {
//         const response = await axios.get('/api/community_types'); // API 호출
//         communityTypes.value = response.data; // 데이터 설정
//     } catch (error) {
//         console.error('Error fetching community types:', error); // 오류 처리
//     }
// });

// function toggleDropdown() {
//     showDropdown.value = !showDropdown.value;
// }

// 스크롤 탑 함수 사용
const { btnBackToTop, backToTop } = useBackToTop();

// 상태 정의
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
    tel: ''
});

const emailCheckResult = ref(null);

const loginFlg = ref(false);
const registrationFlg = ref(false);

// Vuex 스토어 사용
const store = useStore();

// 모달 초기화
let loginModal;
let registrationModal;

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

// 메뉴 토글 함수
function toggleMenu() {
    const navbarCollapse = document.getElementById('navbarSupportedContent');
    navbarCollapse.classList.toggle('show');
}

// 모달 열기/닫기 함수
function openLogin() {
    loginFlg.value = true;
    resetLoginForm();
    loginModal.show();
}

function closeLogin() {
    loginFlg.value = false;
    resetLoginForm(); // 폼 초기화
    loginModal.hide();
}

function openRegistration() {
    registrationFlg.value = true;
    resetRegisterForm();
    registrationModal.show();
}

function closeRegistration() {
    registrationFlg.value = false;
    resetRegisterForm(); // 폼 초기화
    registrationModal.hide();
}

// 로그인 처리 함수
function login() {
    store.dispatch('login', loginForm.value)
        .then(() => {
            resetLoginForm();
            closeLogin();
        })
        .catch(error => {
            console.error('로그인 실패:', error);
        });
}

// 로그아웃 처리 함수
function logout() {
    store.dispatch('logout')
        .then(() => {
            resetLoginForm();
            closeLogin();
        })
        .catch(error => {
            console.error('로그아웃 실패:', error);
        });
}

// 회원가입 처리 함수
function register() {
    store.dispatch('register', registerForm.value)
        .then(() => {
            // 회원가입 성공 후 환영 메시지 표시
            alert(`${registerForm.value.name}님 환영합니다!`);
            resetRegisterForm();
            closeRegistration();
        })
        .catch(error => {
            console.error('회원가입 실패:', error);
        });
}

// 폼 초기화 함수
function resetLoginForm() {
    loginForm.value = {
        email: '',
        password: ''
    };
}

function resetRegisterForm() {
    registerForm.value = {
        name: '',
        email: '',
        nick_name: '',
        password: '',
        ps_chk: '',
        tel: ''
    };
    emailCheckResult.value = null; // 이메일 확인 결과 초기화
    
}

// 이메일 중복 확인 함수
async function checkEmail() {
    const email = registerForm.value.email;
    if (!email) {
        alert('이메일을 입력해주세요.');
        emailCheckResult.value = null;
        return;
    }

    try {
        const response = await axios.post('/api/check-email', { email });
        emailCheckResult.value = response.data.duplicate;
        console.log('Checking email:', email);
    } catch (error) {
        console.error('이메일 중복 확인 실패:', error);
        emailCheckResult.value = true; // 기본적으로 중복된 것으로 간주
    }
}

// 전화번호 입력 처리 함수
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

// 카카오 로그인 함수
function kakao_login() {
    const client_id = 'd7c42425629cbc0e91436aca75ca6fcc';
    const redirect_uri = 'http://127.0.0.1:8000/oauth/kakao';
    const KAKAO_AUTH_URL = `https://kauth.kakao.com/oauth/authorize?client_id=${client_id}&redirect_uri=${encodeURIComponent(redirect_uri)}&response_type=code`;
    window.location.href = KAKAO_AUTH_URL;
}

// 회원가입 이동 함수
function goToRegistration() {
    closeLogin();
    openRegistration();
}

// 게시판 이름
const communityTypes = computed(() => store.state.communityTypes);

// 게시판 데이터 가져오기
onMounted(() => {
    // store.dispatch('fetchCommunityTypes'); // community_types 데이터 가져오기
});

// 헤더 스크롤
// window.addEventListener('scroll', function() {
//     var scrollPosition = window.scrollY;

//     if (scrollPosition > 100) { // 스크롤 위치가 100px 이상일 때
//         document.querySelector('.my-nav-header').style.backgroundColor = 'rgba(255, 255, 255, 0.7)'; // 투명도 조정
//     } else {
//         document.querySelector('.my-nav-header').style.backgroundColor = 'rgba(255, 255, 255, 0.9)'; // 기본 배경색 복원
//     }
// });

</script>

<style scoped src="../css/main.css">
/* @import url(../css/main.css); */
</style>

