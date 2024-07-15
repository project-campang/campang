<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary my-nav-header" v-if="!isAdminRoute">
        <div class="container-fluid main-header">
            <router-link to="/main" class="navbar-brand my-logo-img"></router-link>
            <button @click="toggleMenu" class="navbar-toggler" type="button" data-bs-toggle="collapse" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link to="/search"class="nav-link active" aria-current="page">캠핑장 모아보기</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/community/1" class="nav-link active" aria-current="page">
                            캠핑Talk 
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/faq" class="nav-link active" aria-current="page">FAQ</router-link>
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
                    <!-- 오류 메시지를 여기에 추가 -->
                    <div v-if="errorMessage" class="alert alert-danger" role="alert">
                        {{ errorMessage }}
                    </div>
                    <div class="mb-3">
                        <p>혹시 가입한 적 없으신가요?</p>
                        <a href="#" @click.prevent="goToRegistration">회원가입하러가기</a>
                    </div>
                    <div class="modal-footer">
                        <button @click="kakao_login" class="btn" type="button"><img src="/img/kakao-login.png" alt="카카오 로그인"></button>
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
                <div class="modal-body ">
                    <div class="mb-3 register-modal" id="register-radio-group">
                        <label for="registerRadio-0" class="me-1">일반</label>
                        <input type="radio" name="registerRadio" id="registerRadio-0" value="0" class="me-3" v-model="registerForm.business" @click="updateOption('1')" checked="checked">
                        <label for="registerRadio-1" class="me-1">사업자</label>
                        <input type="radio" name="registerRadio" id="registerRadio-1" value="1" v-modal="bizRegisterForm.business" @click="updateOption('2')">
                    </div>
                    <form @submit.prevent="register" v-show="selectedOption === '1'">
                        <div class="mb-3 register-modal">
                            <label for="name" class="form-label">이름</label>
                            <input type="text" v-model="registerForm.name" class="form-control" id="name" autocomplete="name">
                            <div v-if="validationErrors.name" class="alert alert-danger">{{ validationErrors.name }}</div>
                        </div>
                        <div class="mb-3 register-modal">
                            <label for="email" class="form-label">이메일</label>
                            <input type="email" v-model="registerForm.email" class="form-control" id="email" autocomplete="email">
                                <div v-if="emailCheckResult !== null" class="alert" :class="[emailCheckResult ? 'alert-danger' : 'alert-success']">
                                    {{ emailCheckResult ? '중복된 이메일입니다.' : '사용 가능한 이메일입니다.' }}
                                </div>
                            <div v-if="validationErrors.email" class="alert alert-danger">{{ validationErrors.email }}</div>
                        </div>
                        <div class="mb-3 register-modal">
                            <button type="button" @click="checkEmail" class="btn btn-outline-secondary" >이메일 중복 확인</button>
                        </div>
                        <div class="mb-3 register-modal">
                            <label for="nick_name" class="form-label">닉네임</label>
                            <input type="text" v-model="registerForm.nick_name" class="form-control" id="nick_name" autocomplete="nickname">
                            <div v-if="validationErrors.nick_name" class="alert alert-danger">{{ validationErrors.nick_name }}</div>
                        </div>
                        <div class="mb-3 register-modal">
                            <label for="password" class="form-label">비밀번호</label>
                            <input type="password" v-model="registerForm.password" class="form-control" id="password" autocomplete="password">
                            <div v-if="validationErrors.password" class="alert alert-danger">{{ validationErrors.password }}</div>
                        </div>
                        <div class="mb-3 register-modal">
                            <label for="ps_chk" class="form-label">비밀번호 확인</label>
                            <input type="password" v-model="registerForm.ps_chk" class="form-control" id="ps_chk" autocomplete="ps_chk">
                            <div v-if="validationErrors.ps_chk" class="alert alert-danger">{{ validationErrors.ps_chk }}</div>
                        </div>
                        <div class="mb-3 register-modal">
                            <label for="tel" class="form-label">휴대폰 번호</label>
                            <input type="text" v-model="registerForm.tel" class="form-control" id="tel" @input="oninputPhone" maxlength="14" autocomplete="user_num"/>
                            <div v-if="validationErrors.tel" class="alert alert-danger">{{ validationErrors.tel }}</div>
                        </div>
                        <div class="mb-3 register-modal">
                            <label  class="suite">
                                <input type="checkbox" class="suite" name="agree_personal" required> 개인정보 수집 및 이용 동의 <span class="text-danger suite">(필수)</span>ㅤ<button type="button" class="agree-btn" @click="toggleAgree1">보기></button>
                                <p v-if="agreeFlg1"class="suite">● 이름, 전화번호, 닉네임, 이메일</p>
                            </label>
                            <br>
                            <label  class="suite">
                                <input type="checkbox" class="suite" name="agree_purpose" required> 개인정보 이용 목적 동의 <span class="text-danger suite">(필수)</span>ㅤ<button type="button" class="agree-btn" @click="toggleAgree2">보기></button>
                                <p v-if="agreeFlg2"class="suite">● 회원 관리, 고객 상담 및 민원 처리, 서비스 제공 및 운영, 마케팅 및 광고에의 활용</p>
                            </label>
                            <br>
                            <label  class="suite">
                                <input type="checkbox" class="suite" name="agree_retention" required> 개인정보 보유 및 이용 기간 동의 <span class="text-danger suite">(필수)</span>ㅤ<button type="button" class="agree-btn" @click="toggleAgree3">보기></button>
                                <p v-if="agreeFlg3"class="suite">● 회원 탈퇴 시까지 보유 및 이용. 단, 관련 법령에 따라 일정 기간 보유</p>
                            </label>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
                        <button type="submit" class="btn btn-primary" >가입하기</button>
                    </form>
                    <!-- 사업자 회원가입 폼 -->
                    <form @submit.prevent="bizRegister" id="bizRegisterForm" v-show="selectedOption === '2'">
                        <div class="mb-3 register-modal">
                            <label for="business_code" class="form-label">사업자번호(하이픈 으로 구분 '-')</label>
                            <input type="text" v-model="bizRegisterForm.business_code" class="form-control" id="business_code" autocomplete="off">
                            <div v-if="validationErrors.business_code" class="alert alert-danger">{{ validationErrors.business_code }}</div>
                        </div>
                        <div class="mb-3 register-modal">
                            <label for="business_name" class="form-label">사업장명 (캠핑장 이름)</label>
                            <input type="text" v-model="bizRegisterForm.business_name" class="form-control" id="business_name" autocomplete="off">
                            <div v-if="validationErrors.business_name" class="alert alert-danger">{{ validationErrors.business_name }}</div>
                        </div>
                        <div class="mb-3 register-modal">
                            <label for="bizName" class="form-label">이름</label>
                            <input type="text" v-model="bizRegisterForm.name" class="form-control" id="bizName" autocomplete="name">
                            <div v-if="validationErrors.name" class="alert alert-danger">{{ validationErrors.name }}</div>
                        </div>
                        <div class="mb-3 register-modal">
                            <label for="bizEmail" class="form-label">이메일</label>
                            <input type="email" v-model="bizRegisterForm.email" class="form-control" id="bizEmail" autocomplete="email">
                                <div v-if="emailCheckResult !== null" class="alert" :class="[emailCheckResult ? 'alert-danger' : 'alert-success']">
                                    {{ emailCheckResult ? '중복된 이메일입니다.' : '사용 가능한 이메일입니다.' }}
                                </div>
                            <div v-if="validationErrors.email" class="alert alert-danger">{{ validationErrors.email }}</div>
                        </div>
                        <div class="mb-3 register-modal">
                            <button type="button" @click="BizCheckEmail" class="btn btn-outline-secondary" >이메일 중복 확인</button>
                        </div>
                        <div class="mb-3 register-modal">
                            <label for="biz_nick_name" class="form-label">닉네임</label>
                            <input type="text" v-model="bizRegisterForm.nick_name" class="form-control" id="biz_nick_name" autocomplete="nickname">
                            <div v-if="validationErrors.nick_name" class="alert alert-danger">{{ validationErrors.nick_name }}</div>
                        </div>
                        <div class="mb-3 register-modal">
                            <label for="bizPassword" class="form-label">비밀번호</label>
                            <input type="password" v-model="bizRegisterForm.password" class="form-control" id="bizPassword" autocomplete="off">
                            <div v-if="validationErrors.password" class="alert alert-danger">{{ validationErrors.password }}</div>
                        </div>
                        <div class="mb-3 register-modal">
                            <label for="biz_ps_chk" class="form-label">비밀번호 확인</label>
                            <input type="password" v-model="bizRegisterForm.ps_chk" class="form-control" id="biz_ps_chk" autocomplete="off">
                            <div v-if="validationErrors.ps_chk" class="alert alert-danger">{{ validationErrors.ps_chk }}</div>
                        </div>
                        <div class="mb-3 register-modal">
                            <label for="bizTel" class="form-label">휴대폰 번호</label>
                            <input type="text" v-model="bizRegisterForm.tel" class="form-control" id="bizTel" @input="bizOninputPhone" maxlength="14" autocomplete="tel"/>
                            <div v-if="validationErrors.tel" class="alert alert-danger">{{ validationErrors.tel }}</div>
                        </div>
                        <div class="mb-3 register-modal">
                            <label  class="suite">
                                <input type="checkbox" class="suite" name="agree_personal" required> 개인정보 수집 및 이용 동의 <span class="text-danger suite">(필수)</span>ㅤ<button type="button" class="agree-btn" @click="toggleAgree1">보기></button>
                                <p v-if="agreeFlg1"class="suite">● 이름, 전화번호, 닉네임, 이메일</p>
                            </label>
                            <br>
                            <label  class="suite">
                                <input type="checkbox" class="suite" name="agree_business" required> 사업자 정보 수집 및 이용 동의 <span class="text-danger suite">(필수)</span>ㅤ<button type="button" class="agree-btn" @click="toggleAgree2">보기></button>
                                <p v-if="agreeFlg2"class="suite">● 사업자번호, 사업장 이름</p>
                            </label>
                            <br>
                            <label  class="suite">
                                <input type="checkbox" class="suite" name="agree_purpose" required> 개인정보 이용 목적 동의 <span class="text-danger suite">(필수)</span>ㅤ<button type="button" class="agree-btn" @click="toggleAgree3">보기></button>
                                <p v-if="agreeFlg3"class="suite">● 회원 관리, 고객 상담 및 민원 처리, 서비스 제공 및 운영, 마케팅 및 광고에의 활용</p>
                            </label>
                            <br>
                            <label class="suite">
                                <input type="checkbox" class="suite" name="agree_retention" required> 개인정보 보유 및 이용 기간 동의 <span class="text-danger suite">(필수)</span>ㅤ<button type="button" class="agree-btn" @click="toggleAgree4">보기></button>
                                <p v-if="agreeFlg4"class="suite">● 회원 탈퇴 시까지 보유 및 이용. 단, 관련 법령에 따라 일정 기간 보유</p>
                            </label>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
                        <button type="submit" class="btn btn-primary" >가입하기</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- campRegisterModal -->
    <div v-show="campRegisterFlg" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="router-view-container">
        <router-view></router-view>
    </div>

    <!-- 푸터 -->
    <div class="main-footer" v-if="!isAdminRoute">
        <div class="main-footer-content">
            <h2>CAMPANG <img src="/img/logo-ko3.png" alt=""></h2>
            <div class="footer-btn-con">
                <!-- <button class="footer-btn" @click.prevent="openCampRegister">캠핑장 등록 신청하기</button> -->
                <button type="button" class="footer-btn"  @click="openAdModal">광고 게시 신청하기</button>
            </div>
            <!-- <p>3조 :: 사서고생하조</p> -->
            <p class="aggroL">
                3조 :: 사서고생하조  //  팀장 :: 정보배  //  팀원 :: 이나라  //  팀원 :: 이서린
                <hr>
                대구캠퍼스 TEL : 053-719-0574 (상담시간 : 평일 10:00~18:00) EMAIL : green@campang.or.kr
                <br>
                Copyrights(c) 2024 GREEN COMPUTER ACADEMY DAEGU BRANCH 2ND PROJECT TEAM 3.
            </p>
        </div>
   </div>
    <!-- advertiseModal -->
    <!-- Vue의 조건부 렌더링 사용 -->
    <!-- 광고Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">광고 신청하기</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submitAdForm" id="adForm">
                    <input type="hidden" name="user_id" id="user_id" :value="form.user_id">
                    <div class="mb-3 row">
                        <label for="businessName" class="col-sm-3 col-form-label">광고할 상호명 <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control aggroL" v-model="form.title" placeholder="상호명을 입력하세요">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label">광고 유형 <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <div class="btn-group" role="group1">
                            <button type="button" class="btn btn-outline-primary aggroL" :class="{ active: form.ad_type === 0 }" @click="form.ad_type = 0">캠핑장</button>
                            <button type="button" class="btn btn-outline-primary aggroL" :class="{ active: form.ad_type === 1 }" @click="form.ad_type = 1">캠핑용품</button>
                        </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="adPeriod" class="col-sm-3 col-form-label">광고 기간 <span class="text-danger">*</span></label>
                        <div class="col-sm-9 d-flex align-items-center">
                        <input type="date" class="form-control me-2" v-model="form.start_date" @change="updateAmount">
                        <span>~</span>
                        <input type="date" class="form-control ms-2" v-model="form.end_date" @change="updateAmount">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9 text-end">
                        <span id="adPeriodTotal">총 {{ calculateDays }}일</span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="adAmount" class="col-sm-3 col-form-label">금액</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" v-model="form.amount" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="adSentence" class="col-sm-3 col-form-label">희망 문구</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control aggroL" v-model="form.content" placeholder="최대 40글자" maxlength="40">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="adImage" class="col-sm-3 col-form-label">희망 이미지</label>
                        <div class="col-sm-9">
                        <input type="file" class="form-control aggroL"  @change="handleFileUpload">
                        <div class="form-text aggroL">미첨부시 기존 캠핑장의 메인 이미지가 게시됩니다. (높이:너비 = 3:4 권장)</div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <p>결제</p>
                        <p>-----------------------------------------------------------------</p>
                        <div class="form-text">캠팡은 무통장입금만 지원 하고 있습니다. 더 많은 결제서비스는 조금만 기다려 주세요 :)</div>
                        <label for="name" class="col-sm-3 col-form-label">입금자명 <span class="text-danger">*</span></label>
                        <div class="col-sm-9"><input type="text" class="form-control aggroL" v-model="form.name" placeholder="입금자명을 입력하세요"></div>
                        <label for="account" class="col-sm-3 col-form-label">입금계좌 <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <select class="form-select aggroL" v-model="form.account">
                            <option value=""  class="aggroL">::선택:: 예약자명과 입금자명이 다른경우 고객센터로 연락주세요</option>
                            <option value="1" class="aggroL">카카오뱅크 3333-05-8145823 이서린</option>
                            <option value="2" class="aggroL">토스뱅크 1000-6514-4505 이나라</option>
                            <option value="3" class="aggroL">신한은행 110-499-353214 정보배</option>
                        </select>
                        </div>
                        <p>-----------------------------------------------------------------</p>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label">채널플러스 수신 동의 <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <div class="btn-group" role="group2">
                            <button type="button" class="btn btn-outline-primary me-2 aggroL" :class="{ active: form.agree === true }" @click="form.agree = true">동의함</button>
                            <button type="button" class="btn btn-outline-primary aggroL" :class="{ active: form.agree === false }" @click="form.agree = false">동의 안함</button>
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
                        <button type="submit" class="btn btn-primary">신청</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- 사업자 아닐경우 Modal -->
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAADo0lEQVR4nO2ZPWxbVRiGn6ogYAAqWAqqyo8ECwMCJDoxVCBRMZSFARZgACHBwI8ETAyIpQNiZOhYAYKwJChIKfY9N3EqQqsQ35u4dpqmokoDSkVpEvVcO3Zqv+haTpqmTnDq+9OIfNK3ZXiec77Xx/4CO/U/Lk3zvM7xkf7gENut6pMcbUyhxlnUmEb1aXokdrEdShMcVBE1SqgxiRpnUCijaV7iVqq/T3B3YHim7PCaNXwSGN61Lm/WRjGNcaTTKBRZkVGJj9NmRi53ll1etYafrEMtMGijruRQ7SRalSlwOFX4wOUVazi/GXS7toZGdYQluexJBXxhgPsCw/Gtggc39mglw6OJwpcdHgocihHAq9kO81eyHEwE3rrstQ4XIoM3q71oHZ6MFV497A4c3Bjg1crFn3aIB2ITCBw+jws+uNbfxgJfzrDfOlTiFrAOjXKW5yIXsIavEjh9tUKdifyhChwuJyVgDVeDX3gw0scqsdM3rc7yQWQC1tCXtIA1fBcJ/GKG+62hmvgNGH6PRCAwvJcCvALDQiQC1nAyFQGHy13DLw3yWPi5nIaAdZjpWiAwfJHS+ChwmOgKPvytag3nUhMwXX6lCJ/zFOEVGN7pSiAwHE0L3hrqXb3Era8O8ynOf6Zz2AJ7VeQtFfk07HqJI/UCX5eHmGyeRDo38EZn8FPcoQnON7cD69Yd4e6mfhrVxlB5aPNNQ8TwQbia6Uwgz8MK1xsTrS60RFZkStdkrhZQ7VRTJu7x+abz8RG75PODfNQUGV8jspFMCS2Po+pvKHBjuYEXOxZYcxNPyOOIPOZWZSbayBTbyHho6dfIZObkctuWBVZFetitMV5QnmPysdfdSrsRa5OXynBX4/PlTcPfIDPKvfJ4XR4ZeTQ6HrEu8mLjWqvIZ5983peHF2NeCrHAb5SX+hgXt5KXehHV8q28mLann+yWeraP8zO9jMy7DNXzN5eX8hCLrU+eeuCyL1EBm2V+/ji6+DOa7WPhr35y9gT+VvOyPE6lOkJv4v+pqQ3TvzyMlgbRlSz6ZwDN9aPZXi5cyvK9PCY3zUtx3YiVOKZRbk9MoDrIU7VhlkKJlS67aCFD9dIAz173vvgd5yWrKe5JTGI5x6HlHGfXSPi1HAfW/114svI5rDw/yqPyH3k5pRnuSkyiCTjMfnW4VVaePcrztvLkNsnLy2yHkscj8vhMPmdWR8ynKo/H2W4ljwPK86F8nk6bZad2ilu8/gUxZMZ9CcOCcQAAAABJRU5ErkJggg==">
        <br>
        사업자 회원에 한해 제공되는 서비스 입니다.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!-- 광고신청완료Modal -->
<div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 " id="exampleModalLabel">광고신청하기</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAACXBIWXMAAAsTAAALEwEAmpwYAAACtUlEQVR4nN2Yz28SQRTHe/DY/hvaQ03/BP+B7nuQyslEEw/eC2iM/5BaE2+1RxNvarxVZrZahfZUxYNlhaRCvubNiM7ShV22swvpJJMQdpj98J33a97KylUdCKubCLkBxftQ3IbmX9A0tFM+V76aZ5rqsrYcKEVr+MiPoOgEiiMoHkAzZk/qQ8taOoaqPJQ9/IO9vnUNipvQ3IMSddKgOHna38oeDdnTD5zeWoeiQ6NCXjB9QVVRNISiG5eEC9iC0cgfHI/VHBlFFVE+uLByD8rYj18wPQlKfXlXDuVKgNMOpOIgI9zWug0TJcFpx4FalesZvJUOjX2UDkhD4zizvNsEXgkDZcNp17u5MT0IlwEXbgOf789ac4aD2upFQJMhCra9cBvovQXOvwFHD6atiyTjJCl4Ujzce/wb56fApzvT7PF4wvaqmya3Fq2cO368TLPFm4563ISiwXLAsYScPjTtuID7SwOnjYJyzK+c4Ezt5YHjsYpHLmC0VHDazJ7rwcNMPzp+Avx8YwGyequM7os8f/T3fICdx8Cob96H6AMQ3i5KuQTALEf8/Wn8xb13cSX9KZdwxFmdpPs8DhCJkjXfyiU4yTxhRlSZVLLnVblxmNlzMkkg18dBbkivcEmBOk+q6+7GuLzB2RmhVd2I5+M8wbr7zJ/NxRXsJFQzcqnOUW51d30qZwuFkJtJ5dYaFC2wmubZBas95kodeqGQEVpUT4RzLk3hQi5NOpBsplNbItKOKLz019PUS7l2OpBUSldB57i4L6b1Ub07F9x/JTmwDZ4ibDIQm4vmVi7ZJin0WtQqs5fObHOpkOLdJgTx2SX7hJHdg3a8NTBjoAe1VZNxNHesoiRJPaUqkcTPkh3akiGmBmHvsK3qhlFC0R5a/OVv11QaQNJIj8x38kzWTCb+qzT+AOBirQV35C3MAAAAAElFTkSuQmCC">
        <p class="complete-title">신청 완료!</p>
        <br>
        <div class="footer-complete">
            <img src="/img/logo-ko3.png" alt="">
            <p>고객님의 광고 신청이 정상적으로 접수되었습니다. 
                캠팡의 카카오톡 채널 플러스로 승인 진행상황을 안내받으세요!</p>
        </div>  
        <a href="#" class="complete-footer">캠팡 채널 플러스 바로가기 ></a>  
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">완료</button>
      </div>
    </div>
  </div>
</div>
<!-- 두번째광고모달 -->
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel3">신청 완료되었습니다</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- 신청 완료 메시지 내용 -->
                        광고 신청이 성공적으로 완료되었습니다.
                    </div>
                </div>
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
   <a href="http://pf.kakao.com/_wIPpG" id="csButton" ><img src="../../public/img/CS.png" alt="" v-if="!isAdminRoute"></a>


</template>



<script setup>
import { ref, onMounted, watch, computed } from 'vue';
import { useStore } from 'vuex';
import axios from 'axios';
import { useBackToTop } from "../js/scrolltop.js";
import { useRoute } from 'vue-router';

let agreeFlg1 = ref(false);
let agreeFlg2 = ref(false);
let agreeFlg3 = ref(false);
let agreeFlg4 = ref(false);

const toggleAgree1 = () => {
    agreeFlg1.value = !agreeFlg1.value;
};
const toggleAgree2 = () => {
    agreeFlg2.value = !agreeFlg2.value;
};
const toggleAgree3 = () => {
    agreeFlg3.value = !agreeFlg3.value;
};
const toggleAgree4 = () => {
    agreeFlg4.value = !agreeFlg4.value;
};


const selectedOption = ref('1'); // 기본 선택 옵션

const updateOption = (option) => {
  selectedOption.value = option;
};

// 이메일 중복 체크 상태 추가
const emailChecked = ref(false);

// 유효성 검사 함수들
const validateEmail = (email) => {
    const regex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
    return regex.test(email);
};
const validateBizEmail = (bizEmail) => {
    const regex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
    return regex.test(bizEmail);
};

const validatePassword = (password) => {
    const regex = /^[a-zA-Z0-9!@*]+$/;
    return regex.test(password);
};
const validateBizPassword = (bizPassword) => {
    const regex = /^[a-zA-Z0-9!@*]+$/;
    return regex.test(bizPassword);
};

const validateNickName = (nick_name) => {
    const regex = /^[가-힣a-zA-Z]+$/u;
    return regex.test(nick_name);
};
const validateBizNickName = (biz_nick_name) => {
    const regex = /^[가-힣a-zA-Z]+$/u;
    return regex.test(biz_nick_name);
};

const validateName = (name) => {
    const regex = /^[가-힣]+$/u;
    return regex.test(name);
};
const validateBizName = (bizName) => {
    const regex = /^[가-힣]+$/u;
    return regex.test(bizName);
};

const validateTel = (tel) => {
    const regex = /^(\d{2,3}-\d{3,4}-\d{4})|(\d{10,11})$/;
    return regex.test(tel);
};
const validateBizTel = (bizTel) => {
    const regex = /^(\d{2,3}-\d{3,4}-\d{4})|(\d{10,11})$/;
    return regex.test(bizTel);
};

const validateBusiness_code = (business_code) => {
    const regex = /^\d{3}-\d{2}-\d{5}$/;
    return regex.test(business_code);
}

const validateBusiness_name = (business_name) => {
    const regex = /^[가-힣a-zA-Z0-9()&,\s]+$/u;
    return regex.test(business_name);
}

// 상태 관리 및 유효성 검사 결과
// const store = useStore();
const loginFlg = ref(false);
const registrationFlg = ref(false);
const campRegisterFlg = ref(false);
const advertiseFlg = ref(false);



const registerForm = ref({
    business: selectedOption,
    email: '',
    password: '',
    ps_chk: '',
    nick_name: '',
    name: '',
    tel: ''
});
const bizRegisterForm = ref({
    business: selectedOption,
    business_code: '',
    business_name: '',
    email: '',
    password: '',
    ps_chk: '',
    nick_name: '',
    name: '',
    tel: ''
});
const validationErrors = ref({
    business_code: '',
    business_name: '',
    email: '',
    password: '',
    ps_chk: '',
    nick_name: '',
    name: '',
    tel: ''
});

// 이메일 유효성 검사
watch(() => registerForm.value.email, (newEmail) => {
    emailChecked.value = false; // 이메일이 변경될 때마다 중복 체크 상태 초기화
    if (!validateEmail(newEmail)) {
        validationErrors.value.email = '유효한 이메일을 입력해주세요.';
    } else {
        validationErrors.value.email = '';
    }
});
watch(() => bizRegisterForm.value.email, (newEmail) => {
    emailChecked.value = false; // 이메일이 변경될 때마다 중복 체크 상태 초기화
    if (!validateBizEmail(newEmail)) {
        validationErrors.value.email = '유효한 이메일을 입력해주세요.';
    } else {
        validationErrors.value.email = '';
    }
});

// 비밀번호 유효성 검사
watch(() => registerForm.value.password, (newPassword) => {
    if (!validatePassword(newPassword)) {
        validationErrors.value.password = '영문, 숫자, 특수문자(!@*)만 사용 가능합니다.';
    } else if (newPassword.length < 2 || newPassword.length > 20) {
        validationErrors.value.password = '비밀번호는 2자 이상, 20자 이하이어야 합니다.';
    } else {
        validationErrors.value.password = '';
    }
});
watch(() => bizRegisterForm.value.password, (newPassword) => {
    if (!validateBizPassword(newPassword)) {
        validationErrors.value.password = '영문, 숫자, 특수문자(!@*)만 사용 가능합니다.';
    } else if (newPassword.length < 2 || newPassword.length > 20) {
        validationErrors.value.password = '비밀번호는 2자 이상, 20자 이하이어야 합니다.';
    } else {
        validationErrors.value.password = '';
    }
});

// 비밀번호 확인 유효성 검사
watch(() => registerForm.value.ps_chk, (newPsChk) => {
    if (newPsChk !== registerForm.value.password) {
        validationErrors.value.ps_chk = '비밀번호가 일치하지 않습니다.';
    } else {
        validationErrors.value.ps_chk = '';
    }
});
watch(() => bizRegisterForm.value.ps_chk, (newPsChk) => {
    if (newPsChk !== bizRegisterForm.value.password) {
        validationErrors.value.ps_chk = '비밀번호가 일치하지 않습니다.';
    } else {
        validationErrors.value.ps_chk = '';
    }
});

// 닉네임 유효성 검사
watch(() => registerForm.value.nick_name, (newNickName) => {
    if (!validateNickName(newNickName)) {
        validationErrors.value.nick_name = '한글 또는 영문만 사용 가능합니다.';
    } else if (newNickName.length < 2 || newNickName.length > 10) {
        validationErrors.value.nick_name = '닉네임은 2자 이상, 10자 이하이어야 합니다.';
    } else {
        validationErrors.value.nick_name = '';
    }
});
watch(() => bizRegisterForm.value.nick_name, (newNickName) => {
    if (!validateBizNickName(newNickName)) {
        validationErrors.value.nick_name = '한글 또는 영문만 사용 가능합니다.';
    } else if (newNickName.length < 2 || newNickName.length > 10) {
        validationErrors.value.nick_name = '닉네임은 2자 이상, 10자 이하이어야 합니다.';
    } else {
        validationErrors.value.nick_name = '';
    }
});

// 이름 유효성 검사
watch(() => registerForm.value.name, (newName) => {
    if (!validateName(newName)) {
        validationErrors.value.name = '한글만 사용 가능합니다.';
    } else if (newName.length < 2 || newName.length > 20) {
        validationErrors.value.name = '이름은 2자 이상, 20자 이하이어야 합니다.';
    } else {
        validationErrors.value.name = '';
    }
});
watch(() => bizRegisterForm.value.name, (newName) => {
    if (!validateBizName(newName)) {
        validationErrors.value.name = '한글만 사용 가능합니다.';
    } else if (newName.length < 2 || newName.length > 20) {
        validationErrors.value.name = '이름은 2자 이상, 20자 이하이어야 합니다.';
    } else {
        validationErrors.value.name = '';
    }
});

// 전화번호 유효성 검사
watch(() => registerForm.value.tel, (newTel) => {
    if (!validateTel(newTel)) {
        validationErrors.value.tel = '유효한 전화번호 형식이 아닙니다.'; 
    } else {
        validationErrors.value.tel = '';
    }
});
watch(() => bizRegisterForm.value.tel, (newTel) => {
    if (!validateBizTel(newTel)) {
        validationErrors.value.tel = '유효한 전화번호 형식이 아닙니다.'; 
    } else {
        validationErrors.value.tel = '';
    }
});

// 사업자 번호 유효성 검사
watch(() => bizRegisterForm.value.business_code, (newBusiness_code) => {
    if(!validateBusiness_code(newBusiness_code)){
        validationErrors.value.business_code = '사업자번호 형식에 맞지 않습니다.';
    } else {
        validationErrors.value.business_code = '';
    }
})

// 캠핑장 이름 유효성 검사
watch(() => bizRegisterForm.value.business_name, (newBusiness_name) => {
    if(!validateBusiness_name(newBusiness_name)){
        validationErrors.value.business_name = '한글,영문,숫자,특수문자[ ()&, ] 만 가능합니다.';
    } else {
        validationErrors.value.business_name = '';
    }
})


// 회원가입 처리 함수
function register() {
    // 이메일 중복 체크를 하지 않았거나 중복된 이메일일 경우 경고 메시지 표시
    if (!emailChecked.value) {
        alert('이메일 중복 체크를 해주세요.');
        return;
    }

    // 데이터가 비어 있는지 검사
    const isEmpty = Object.values(registerForm.value).some(value => value === '');

    if (isEmpty) {
        alert('내용을 입력해주세요.');
        console.log(registerForm.value);

        return;
    }

    // 최종 폼 유효성 검사
    if (Object.values(validationErrors.value).some(error => error)) {
        alert('입력한 정보를 확인해주세요.');
        return;
    }

    store.dispatch('register', registerForm.value)
        .then(() => {
            alert(`${registerForm.value.name}님 환영합니다!`);
            resetRegisterForm();
            closeRegistration();
        })
        .catch(error => {
            console.error('회원가입 실패:', error);
        });
}


function resetRegisterForm() {
    registerForm.value = {
        business: '',
        email: '',
        password: '',
        ps_chk: '',
        nick_name: '',
        name: '',
        tel: ''
    };
    validationErrors.value = {
        business_code: '',
        business_name: '',
        email: '',
        password: '',
        ps_chk: '',
        nick_name: '',
        name: '',
        tel: ''
    };

    emailCheckResult.value = null;
}

// 사업자 회원가입 처리
function bizRegister() {
    // 이메일 중복 체크를 하지 않았거나 중복된 이메일일 경우 경고 메시지 표시
    if (!emailChecked.value) {
        alert('이메일 중복 체크를 해주세요.');
        return;
    }

    // 데이터가 비어 있는지 검사
    const isEmpty = Object.values(bizRegisterForm.value).some(value => value === '');

    if (isEmpty) {
        alert('내용을 입력해주세요.');
        console.log(bizRegisterForm.value);
        return;
    }

    // 최종 폼 유효성 검사
    if (Object.values(validationErrors.value).some(error => error)) {
        alert('입력한 정보를 확인해주세요.');
        return;
    }

    store.dispatch('bizRegister', bizRegisterForm.value)
        .then(() => {
            alert(`${bizRegisterForm.value.name}님 환영합니다!`);
            resetBizRegisterForm();
            closeRegistration();
        })
        .catch(error => {
            console.error('회원가입 실패:', error);
        });
}


function resetBizRegisterForm() {
    bizRegisterForm.value = {
        business: '',
        business_code: '',
        business_name: '',
        email: '',
        password: '',
        ps_chk: '',
        nick_name: '',
        name: '',
        tel: ''
    };
    validationErrors.value = {
        business_code: '',
        business_name: '',
        email: '',
        password: '',
        ps_chk: '',
        nick_name: '',
        name: '',
        tel: ''
    };

    emailCheckResult.value = null;
}


// 스크롤 탑 함수 사용
const { btnBackToTop, backToTop } = useBackToTop();

// 상태 정의
const loginForm = ref({
    email: '',
    password: ''
});

const emailCheckResult = ref(null);

// Vuex 스토어 사용
const store = useStore();

// 모달 초기화
let loginModal;
let registrationModal;
let campRegisterModal;
let advertiseModal;

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

    const campRegisterModalElement = document.getElementById('campRegisterModal');
    if (campRegisterModalElement) {
        import('bootstrap').then(({ Modal }) => {
            campRegisterModal = new Modal(campRegisterModalElement);
        });
    }

    const advertiseModalElement = document.getElementById('advertiseModal');
    if (advertiseModalElement) {
        import('bootstrap').then(({ Modal }) => {
            advertiseModal = new Modal(advertiseModalElement);
        });
    }

    // const modalElement = document.getElementById('advertiseModal');
    // if (modalElement) {
    //     const myModal = new bootstrap.Modal(modalElement);
    //     myModal.show();
    // }

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
    resetvalidation();
}

function closeLogin() {
    loginFlg.value = false;
    resetLoginForm(); // 폼 초기화
    loginModal.hide();
    resetvalidation();
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

// ------푸터 모달

function openCampRegister() {
    campRegisterFlg.value = true;
    resetRegisterForm();
    campRegisterModal.show();
}

function closeCampRegister() {
    campRegisterFlg.value = false;
    campRegisterModal.hide();
}

function openAdvertise() {
    advertiseFlg.value = true;
    resetRegisterForm();
    advertiseModal.show();
}

function closeAdvertise() {
    advertiseFlg.value = false;
    advertiseModal.hide();
}

// --------

// 로그인 처리 함수
const errorMessage = ref(null);


async function login() {
    try {
        const response = await store.dispatch('login', loginForm.value);
        resetLoginForm();
        closeLogin();
        location.reload(); // 페이지 새로고침
    } catch (error) {
        console.error('로그인 실패:', error);
        if (error.response && error.response.status === 401) {
            errorMessage.value = '아이디 혹은 비밀번호가 틀렸습니다.';
        } else {
            errorMessage.value = '로그인 중 오류가 발생했습니다. 다시 시도해주세요.';
        }
    }
}

// 로그아웃 처리 함수
function logout() {
    store.dispatch('logout')
        .then(() => {
            resetLoginForm();
            closeLogin();
            // location.reload(); // 페이지 새로고침
            router.replace('/main');
        })
        .catch(error => {
            console.error('로그아웃 실패:', error);
        });
}

// 폼 초기화 함수
function resetLoginForm() {
    loginForm.value = {
        email: '',
        password: ''
    };
}

function resetvalidation() {
    validationErrors.value = {
        email: '',
        password: '',
        ps_chk: '',
        nick_name: '',
        name: '',
        tel: ''
    };
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
        emailChecked.value = true; // 이메일 중복 체크 완료로 설정
        console.log('Checking email:', email);
    } catch (error) {
        console.error('이메일 중복 확인 실패:', error);
        emailCheckResult.value = true;
    }
}
async function BizCheckEmail() {
    const email = bizRegisterForm.value.email;
    if (!email) {
        alert('이메일을 입력해주세요.');
        emailCheckResult.value = null;
        return;
    }

    try {
        const response = await axios.post('/api/check-email', { email });
        emailCheckResult.value = response.data.duplicate;
        emailChecked.value = true; // 이메일 중복 체크 완료로 설정
        console.log('Checking email:', email);
    } catch (error) {
        console.error('이메일 중복 확인 실패:', error);
        emailCheckResult.value = true;
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
function bizOninputPhone() {
    const phone = bizRegisterForm.value.tel.replace(/[^0-9]/g, '');
    const phoneLength = phone.length;

    if (phoneLength < 4) {
        bizRegisterForm.value.tel = phone;
    } else if (phoneLength < 7) {
        bizRegisterForm.value.tel = phone.slice(0, 3) + '-' + phone.slice(3);
    } else if (phoneLength < 11) {
        bizRegisterForm.value.tel = phone.slice(0, 3) + '-' + phone.slice(3, 6) + '-' + phone.slice(6);
    } else {
        bizRegisterForm.value.tel = phone.slice(0, 3) + '-' + phone.slice(3, 7) + '-' + phone.slice(7);
    }
}

// 카카오 로그인 함수
function kakao_login() {
    // const client_id = '09af3813f086f8f0ffe5ab2ea7fb36a7';
    // const redirect_uri = 'http://127.0.0.1:8000/oauth/kakao';
    // const KAKAO_AUTH_URL = `https://kauth.kakao.com/oauth/authorize?client_id=${client_id}&redirect_uri=${encodeURIComponent(redirect_uri)}&response_type=code`;
    // window.location.href = KAKAO_AUTH_URL;
    window.location.href = '/auth/kakao';
}

// 회원가입 이동 함수
function goToRegistration() {
    closeLogin();
    openRegistration();
}



// 게시판 이름
const communityTypes = computed(() => store.state.communityTypes);

// 게시판 데이터 가져오기



// 관리자페이지에서 헤더랑 푸터빼기
// 경로 확인을 위한 배열
const adminPaths = ['/admin', '/manager', '/dashboard', '/settings'];

// 현재 경로 확인
const route = useRoute();

// 현재 경로가 특정 경로로 시작하는지 확인
const isAdminRoute = computed(() => 
  adminPaths.some(path => route.path.startsWith(path))
);

// 경로 변경 시 확인
watch(route, () => {
  isAdminRoute.value = adminPaths.some(path => route.path.startsWith(path));
}, { immediate: true });

// 광고신청모달
document.addEventListener('DOMContentLoaded', function() {
    const adStart = document.getElementById('adStart');
    const adEnd = document.getElementById('adEnd');
    const adAmount = document.getElementById('adAmount');
    const adPeriodTotal = document.getElementById('adPeriodTotal');
    const businessNumber = document.getElementById('businessNumber');
    const btnGroup = document.querySelectorAll('.btn-group button');

    // function updateAmount() {
    //     const startDate = new Date(adStart.value);
    //     const endDate = new Date(adEnd.value);
    //     if (isNaN(startDate) || isNaN(endDate)) return; // 날짜가 유효하지 않은 경우 무시

    //     const diffTime = Math.abs(endDate - startDate);
    //     const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
    //     const amount = diffDays * 500000;  // 1일 광고비: 500,000원

    //     adAmount.value = `₩ ${amount.toLocaleString()}`;
    //     adPeriodTotal.innerText = `총 ${diffDays}일`;
    // }

    adStart.addEventListener('change', updateAmount);
    adEnd.addEventListener('change', updateAmount);

    businessNumber.addEventListener('input', function() {
        if (businessNumber.value.match(/^\d+$/)) {
            businessNumber.classList.remove('is-invalid');
            businessNumber.classList.add('is-valid');
        } else {
            businessNumber.classList.remove('is-valid');
            businessNumber.classList.add('is-invalid');
        }
    });

    btnGroup.forEach(btn => {
        btn.addEventListener('click', function() {
            btnGroup.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });
});


// 사업자회원인지 아닌지 판단
const userBusiness = ref(null);

const openAdModal = () => {
  // 로그인 후에 Vuex 상태가 업데이트되지 않은 경우를 대비하여 userInfo를 직접 접근
  const userInfo = store.state.userInfo;
  console.log(userInfo);
  
  if (userInfo && userInfo.business === '2') {
    $('#exampleModal2').modal('show');
  } else {
    $('#exampleModal3').modal('show');
  }
};



const form = ref({
    user_id: '',
    title: '',
    ad_type: 0,
    start_date: new Date().toISOString().substr(0, 10), // 오늘 날짜로 설정 (YYYY-MM-DD 형식)
    end_date: new Date(new Date().getTime() + 7 * 24 * 60 * 60 * 1000).toISOString().substr(0, 10), // 오늘로부터 일주일 후의 날짜로 설정 (YYYY-MM-DD 형식)
    amount: '₩3,500,000',
    content: '',
    account: '',
    img_1: null,
    agree: false,
});

const isFormValid = computed(() => {
  // 필수 필드들이 모두 채워져 있는지 확인
  return (
    form.value.title !== '' &&
    form.value.start_date !== '' &&
    form.value.end_date !== '' &&
    form.value.name !== ''

  );
});


const handleFileUpload = (event) => {
    const file = event.target.files[0]; // 선택된 파일 객체
    form.value.img_1 = file; // Vue.js 데이터에 파일 객체 저장
};

const calculateDays = computed(() => {
      const startDate = new Date(form.value.start_date);
      const endDate = new Date(form.value.end_date);
      const diffTime = Math.abs(endDate - startDate);
      const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
      return diffDays;
    });

const updateAmount = () => {
      const diffDays = calculateDays.value;
      const amount = diffDays * 500000;  // 1일 광고비: 500,000원
      form.value.amount = `₩${amount.toLocaleString()}`;
    };
const submitAdForm = async () => {
  if (isFormValid.value) {
    const formData = new FormData();
    Object.keys(form.value).forEach(key => {
    formData.append(key, form.value[key]);
    });
     // 이미지 파일이 선택되었을 경우에만 FormData에 추가
     if (form.img_1 instanceof File) {
        formData.append('img_1', form.img_1);
    }
    try {
        // 서버로 데이터 전송
        const response = await axios.post('/api/submitAd', formData);

        // 성공적으로 신청한 경우
        // 폼 초기화 (Vue 3 Composition API 방식)
        form.value = {
            user_id: '',
            title: '',
            ad_type: 0,
            start_date: new Date().toISOString().substr(0, 10), // 오늘 날짜로 설정 (YYYY-MM-DD 형식)
            end_date: new Date(new Date().getTime() + 7 * 24 * 60 * 60 * 1000).toISOString().substr(0, 10), // 오늘로부터 일주일 후의 날짜로 설정 (YYYY-MM-DD 형식)
            amount: '₩3,500,000',
            content: '',
            account: '',
            img_1: null,
            agree: false,
        };

      // 모달 닫기
      $('#exampleModal2').modal('hide');
      // 성공 모달 열기
      $('#exampleModal5').modal('show');
    } catch (error) {
      console.error('광고신청 실패:', error);
    }
  } else {
    // 필수 입력 필드가 비어 있음을 사용자에게 알림
    alert('모든 필수 항목을 입력하세요.');
  }
};
// const submitAdForm = async () => {
//     const formData = new FormData();
//     Object.keys(form.value).forEach(key => {
//     formData.append(key, form.value[key]);
//     });
//      // 이미지 파일이 선택되었을 경우에만 FormData에 추가
//      if (form.img_1 instanceof File) {
//         formData.append('img_1', form.img_1);
//     }

//     try {
//     const response = await axios.post('/api/submitAd', formData);
//     $('#exampleModal2').modal('hide');
//     $('#exampleModal5').modal('show');

//     } catch (error) {
//         console.error('광고신청 실패:', error);

//     }
// };


</script>

<style scoped src="../css/main.css">
/* @import url(../css/main.css); */
</style>
