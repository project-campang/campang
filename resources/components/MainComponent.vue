<template>
    <!-- 첫번째 -->
    <div class="main-main" data-section="1">
        <div class="main-logo">
            <img src="/img/logo-ko3.png" class="img-fluid" alt="Logo" loading="lazy">
        </div>
        <div class="main-search">
            <form action="" id="searchForm" class="d-flex flex-column align-items-center justify-content-center">
                <div class="d-flex justify-content-center align-items-center">
                    <span class="me-2">어느지역?</span>
                    <div class="main-select-box me-2">
                        <select @change="selectState" name="state" id="select1" class="select">
                            <option>전체 시/도</option>
                            <option v-for="(item, key) in $store.state.stateData" :key="key">{{ item.name }}</option>
                            {{ console.log('stateData', stateData) }}
                        </select>
                    </div>
                    <div class="main-select-box">
                        <select @change="selectCounty" name="county" id="select2" class="select">
                            <option>전체 구/군</option>
                            <option v-for="(item, key) in $store.state.countyData" :key="key">{{ item.name }}</option>
                            {{ console.log('countyData', countyData) }}
                        </select>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center mt-3">
                    <span class="me-2">어디갈래?</span>
                    <div class="main-select-box me-2">
                        <select name="option" class="select">
                            <option>선택</option>
                            <option value='1'>글램핑</option>
                            <option value='2'>오지/노지캠핑</option>
                            <option value='3'>카라반</option>
                        </select>
                    </div>
                    <!-- <button @click="searchBtn" class="main-search-button">검색</button> -->
                    <router-link to="/search" @click="searchBtn" class="main-search-button">검색</router-link>
                </div>
            </form>
        </div>
    
    <!-- 두번째 -->
    <div class="bg-white white-main main-second" data-section="2">
        <div class="main-left">
            <div class="main-left-img">
                <img src="/img/logo-ko3.png" class="main-left-img" alt="" loading="lazy">
            </div>
            <div class="main-rank">
                <button type="button" class="main-rank-btn-left"  @click="showCampingler"><h3>캠핑러</h3></button>
                <button type="button" class="main-rank-btn-right" id="campingzang" @click="showCampingzang"><h3>캠핑장</h3></button>
                <div class="main-rank-box">
            <div class="main-rank-cam1" v-if="isCampinglerVisible">
                <div v-for="(item, index) in $store.state.mainCampingler" :key="index">
                    <img :src="item.profile">
                    <p>{{ index + 1 }}위: {{ item.nick_name }}</p>
                </div>
            </div>
            <div class="main-rank-cam2" v-else>
                <div v-for="(item, index) in $store.state.mainCampingzang" :key="index">
                    <img :src="item.main_img">
                    <p>{{ index + 1 }}위: {{ item.name }}</p>
                </div>
            </div>
        </div>

            </div>
            <div class="main-pang">
                <a href="#">나도 도장 찍으러가기 <img src="/img/stamp2.png" alt="" loading="lazy"></a>
            </div>
        </div>
        <div class="main-right" data-section="3">
            <div class="main-right-top">
                <div>
                    <p class="count">0</p>
                    <p>가입유저수</p>
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAB3UlEQVR4nO2Yz0pCQRSHPw1rla1a9QJlK7f1BgWFbesBglbRpl6gVZogrXuDiggifIDaqxmBT2Ch2B8CwxsDx83h3qteLceYDw7IeO45v5l7zjgjOBwOx39jGTgFysC7mPmcA1JYzDRQAL4BL8DMd3kggYXiiyHCtd3ZNonCAOK7Zt6ENTWvy6YCbACzYpvAo/JpA0tYwKmP+KSP3xxQVb5ZLKCiRJnVDiKjfEtYQEuJMiUTRFL5trCAiZ9AedJLKKdEPUrDaszYk/I9wQJSPttoVVY7KZbxEW+20UUsIR/hh8yKLbRLQo4H/Yq/te0ogQjKS2kECW9Lz1gnXvdEVnaYN7GSNKw1Ne9wOBz2MAWkgT3gTO7Gz0Ad+BKry1hRfPbkmalxiTZH5m3gCmhGOEZ0rQlcSqywY/hI77/nwOcQooPsU2KbHCNnAbgAOr8g3FPWkVwm50jYARo9ktalnA7l6GxWcR6YEZuXsS3gSHxfesRsSO6hOAhJUAOOpRljEWKbZ9ISoxaSZz+q+NWAvwnv5doYZ3TEJeaDTz6jYSVK0BsV6APYjbja/RKTHB8q93WUYK8qyBp/x7rKbfplYPSr/Gu8YfN7ltnAjFuw5ybA+FfdG2MPOhwOB735AXEPv3mzNAbBAAAAAElFTkSuQmCC">
                </div>
                <div>
                    <p class="count">0</p>
                    <p>도장갯수</p>
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAABRklEQVR4nO2XTUoDQRCFP7IzJ1BcewkFfyDn0JxFguJC4jF0EX/OY9zpSgXJ0sWUDGQRim6nh55MtaY+qF09eG+6qpsBx3Gcv84OcAO8AN+ANFTdMwemwLa1+QPgI8F0rN6Bfcsvn2N+NYTJSUw7MC/LurYIMFcmLoGtBN0QuFLaZwzQC1sbS2UYWOze0WPQtz6bShkYtNAOlLbCgDdlYtRCO1LaVwx4VCYWwDhBN172rmrvMeA4MEZ1TX7RXAT6K+AQIyYRQ0eB3pNI4HOMOQuMxEOg7ykwcqcUQspS5iz92km5FnOu3V5oepjMH64mPIA1fgLW+Al0yR4wC7ywFrUA7oDdNuY/CzAugZ//pBCzAsxKpG5TApQwNhKpr5QAWmSNtPXjATpGNv4EpIDllZwdKK0asTYoGx9AU/wX//cBHMdxWBs/iVR1mpOpR3EAAAAASUVORK5CYII=">
                </div>
                <div>
                    <p class="count">0</p>
                    <p>캠핑장 수</p>
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAADJ0lEQVR4nO2ZW4iNURTHf8Y9lyHkFrlLHsTDGEXIeEDmweWFGpdMeaAmkZTk0hgRjSRTKCOaSAh54MFtppAakonRPJBLE5P7zDBjjrbWqeP0nXP2/r5v5fb9a9WZ+dbe//U/e39rr70ORIgQIcK/jiygUD5PAfKBvgHm6wNMBFYAZcAzoEp4VLEIaAA6SQAxoE0CqAQqgL3ALmAHsBHYLn+XAieBm8BToEnGe9kcTRHtgHtCZFbC4GGaYILYBU0h+QlEp+R/m5SEfAeGawmpSiAy2yIbGCqkGmJ2aoiY7UG0XJ5dVxJSD3QOW8gND6Jr8mylkpAYsDRMEdNTkJhsNQroBnxUElIZppAraYiKxeew4qpMCkPE5Awkr4EOQK6ikLIwhFy0IJonvveVhHySDOkbE+Q9yER0VvyLFFdlbRAhZyxJWoABUjelKzuCWI1UFs4Y53jQrZdxFYqrMtOPkBOOJI/lG5ulKOS0q4iRsl1cifKUC8kWYLCLkKM+ic7J+DWKq7LFVsQQ4KtPklapWHsAH5SEvAQ62gg5GJCoROY5oLgqCzKJMCm0MSDJG6ALMNryDPJjVzMJ2RcS0TKLGi2ItQFjU4noB3y2mOSBRaV71+NGGbaVphJSYjlBkWSnTH450gmpUxLyTq4Pv8AUZO8dSpFCC99ymXuD4qqsShay1XLgZfEfZPEiNwP9gd6WW9aPVSeK6Cl9KpuBSxLGVVv4bxbfMsVVycWxnVMvaTWOYssxXYERclhqCCmPB/TKcsC2pO2YYzluteOVIOZoTfGW7SHZz+mcv8h+T8YTC6JaoL2D8JgPMwnlJ7pLT/d4ivdlt1e+lnfAhmihcv+r1is400iYIad8ndzMUnXbh1levm6L/1wlIbcIAectyUxvzDbbxSysQXZQnt8rcDKmWRJfEv+CAME3yi1xvm0p74o7FkGYA3S8BPDcIfhm6dIsllSuClOyH5ESPl1Qx8R/XQa/VinVTU+5F78BJs1OBfanOJ++yc8Qpth76/H8kfzCNZA/CFkJol4kBLsnqTKokVpvDH8B4qJKpcOSLSnddDIjRIgQ4T/ED2uQkyLQdFZFAAAAAElFTkSuQmCC">
                </div>
            </div>
            <div class="main-right-middle">
                <div class="main-mini-search">
                    <div class="align-items-center justify-content-center">
                        <h2>캠팡 인기글</h2>
                        <hr>
                        <p v-for="(item, index) in $store.state.mainCommunity" :key="index"><span>자유게시판</span>{{ index + 1 }}위. {{ item.title }} {{ item.name }}</p>
                    </div>
                </div>
            </div>
            <div class="main-right-bottom">
                <!-- <div class="main-right-board">
                    <a href="#">캠핑꿀팁 게시판</a>
                </div>
                <div class="right-board">
                    <a href="#">1위 이거 안쓰면 후회합니다</a>
                </div> -->
                <div class="right-tv">
                    <a href="#">캠팡 유튜브 <img src="/img/tv.png" alt="" loading="lazy"></a>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- 세번째 -->
    <div class="bg-white">
        <div class="third-main">
            <div class="third-main-fff">
                <div class="third-main-p">
                    <h1>이세상 모든 캠핑장을 정복할 때까지,</h1>
                    <p>캠팡은 이 세상의 모든 캠핑장을 담을 때까지 달리고 또 달립니다.</p>
                    <p>여러분과 함께!</p>
                    <p>어디에 있든, 어느 순간이든, 최고의 캠핑 경험을 위해!</p>
                    <p>지금 바로 여러분만의 캠핑 여정을 시작하세요. 도전은 이미 시작되었습니다.</p>
                    <a href="#" class="btn third-main-btn">캠핑장 구경가기<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACQklEQVR4nO2ZTWsTQRiAHyKFXvRSepNoFRoq2Jt4US8aUHos0pIfUL1YU7XgSX+EJ0/+BU0EvyqttPQjoR57rEpjoOKlUbSt6MrAuzAs3e1osrvvhjwwbPadD96ns7M7dKBHd5EDSkAVaAJ7cq0Ak1KvnlPAe8CLKOvAEMolvkiym8AUcBzok+sN4IPUb2uVyVkz8Qo4GtLOxF9Lu7rGx6xkzUSYhM8x4KO0n0AZVUnMPE4+J4GXwFfgBZC36m5K+2cooymJmbXg8y6wyM0j5ZOX2GeUsSuJ9Vux/YDID6uuX2Kmnyo+SWIFK3bQq9dnRO7NWlFFRRK75SgyLfdPUcZ1SazhKNKQ+3GUkQMWA8lGiZjfy8ARFHL6H2ZkS3YCahlyFFG5PQkjSiRTeD2RDM3ICeAt0ALmAvuwTIm8CcTN1t9++80D34BV4CyKRfYCcXPvsxCoWyNlDvsg2uV3xGbzl1VXkA/vd2AFOKNNZN+x33wgvqRNZNexXyuiX6IiF4CLB8T/AOdD6jxrzJ9pfJu8DpaOi1wDavJqNNerCYlcAs7JzLUtUgwZ6H4CIp7DbDlTjxisnCWR1iEDlrMiUnMYtJwFkSshayRszagVQf7inqOMahHDnQSTjFXEMNMtIppmhm6R6Rh3u0XEcC8liR1iYDYFkY04RNKQeUKMPEhQZIyYeZiARD2pU+FZx73Z/5QWMEqCFOXAs9MSRVJgAHhkHZi2U5aAYVJmELgNPJeDHhcx848484p9DFxOW6AHbfIX2QllrDABzUoAAAAASUVORK5CYII="></a>
                </div>
            </div>
        </div>
    </div>
    <!-- 네번째 -->
    <div class="bg-white">
        <div class="last-main">
            <div id="carouselExampleSlidesOnly" class="carousel slide last-left" data-bs-ride="carousel">
                <h2>캠팡 추천 캠핑장</h2>
                <p>캠팡 제휴업체에서 할인받자 !</p>
                <p class="text-end">* 본 섹션은 광고를 포함하고 있습니다.</p>
                <div class="carousel-inner">
                    <div class="carousel-item" data-bs-interval="5000"
                        v-for="(camp, index) in $store.state.suggestCam" 
                        :class="{'active': index === 0}" 
                        :key="index">
                        <img :src="camp.main_img" class="d-block last-box-img" alt="추천 캠핑장 이미지">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{ camp.name }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="last-right">
            <h2>캠팡 추천 브랜드</h2>
            <p>믿고 보는 캠팡PICK!</p>
            <p class="text-end">* 본 섹션은 광고를 포함하고 있습니다.</p>
                <div class="last-right-box">
                    <div class="slider">
                        <div class="slide" v-for="(item, key) in $store.state.suggestbrand" :key="key">
                            <img :src="item.img" alt="브랜드 이미지">
                            <p>{{ item.name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 모바일에서만 나오는 섹션 -->
  <div v-if="isWithinTargetArea && authFlg">
    <div class="animate__animated animate__pulse animate__infinite mobile-float" :class="{ hidden: isScrolled }">
      <button type="button" class="btn my-stamp-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
        지금 <b>{{ currentTarget.name }}</b>에 계시는군요!<br>도장찍으러 가기 >>
      </button>
    </div>

    <div class="animate__animated animate__pulse animate__infinite small-float" :class="{ hidden: !isScrolled }">
      <button type="button" class="btn small-stamp-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
        도장
      </button>
    </div>
  </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <!-- <h1 class="modal-title fs-5" id="exampleModalLabel"></h1> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div class=" modal-body-gap">
                            <div class="text-center first-line animate__animated animate__tada animate__repeat-3">축하 합니다!</div>
                        </div>
                        <div class="modal-body-gap">
                            <div class="text-center second-line">벌써 <b>{{stampCnt.cnt + 1}}</b>번째 정복중</div>
                        </div>
                        <div v-if="isWithinTargetArea" class="modal-body-gap">
                            <div class="text-center third-line">{{currentTarget.name}}</div>
                        </div>
                        <button @click="createStamp" :class="{ stampBackGround: isStamped, animate__animated: isTrue, animate__bounce: isTrue }" class="modal-body-gap stampArea text-center">
                            <div class="text-center stamp-pang">도장 팡팡!</div>
                            <div class="click text-center">click</div>
                        </button>
                        <!-- <div class="text-center">
                            <router-link to="/mypage"  class="text-center fifth-line"  @click="closeModalAndNavigate">도장판 보러가기 -></router-link>
                        </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
                </div>
                </div>
            </div>
        </div>
</template>

<script setup>
import axios from 'axios';
import { onBeforeMount,ref, onMounted, computed, onUnmounted } from 'vue';
import { useStore } from 'vuex';
import { useRoute } from 'vue-router';


const store = useStore();
const route = useRoute();
const stateData = ref(store.state.stateData);
const countyData = ref(store.state.countyData);
const campData = ref(store.state.campData);


// 스크롤 이벤트
function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    }
}

function observeSections() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            } else {
                entry.target.classList.remove('visible');
            }
        });
    }, {
        threshold: 0.1
    });

    const sections = document.querySelectorAll('[data-section]');
    sections.forEach(section => observer.observe(section));
}

window.addEventListener('load', observeSections);
window.addEventListener('scroll', throttle(observeSections, 200));

// 카운터
const counter = ($counter, max) => {
    let now = 0;

    const handle = setInterval(() => {
    $counter.innerHTML = Math.ceil(now);

    // 목표 수치에 도달하면 정지
    if (now >= max) {
        clearInterval(handle);
        if (max === 100) {
        $counter.innerHTML = '100+'; // 목표 수치가 100이면 100+로 표시
        }
    } else {
      // 증가되는 값이 계속하여 작아짐
        const step = (max - now) / 10;
      // 값을 적용시키면서 다음 차례에 영향을 끼침
        now += step;
    }
    }, 50);
}

window.onload = () => {
  // 카운트를 적용시킬 모든 요소
  const counters = document.querySelectorAll(".count");
  
  counters.forEach(($counter, index) => {
    // 목표 수치 설정
    let max;

    if (index === 0) {
      max = 124; // 첫 번째 항목의 목표 수치 설정
    } else if (index === 1 || index === 2) {
      max = 365; // 두 번째와 세 번째 항목의 목표 수치 설정
    }

    setTimeout(() => counter($counter, max), 2000 * index);
  });
};
//  캠핑러 캠핑장 버튼 

let isCampinglerVisible = ref(true);

function showCampingler() {
    isCampinglerVisible.value = true;
    const element = document.querySelector('.main-rank-box');
    const elementright = document.querySelector('.main-rank-btn-right');
    const elementLeft = document.querySelector('.main-rank-btn-left');


    elementright.classList.remove('text-decoration-underline');
    elementLeft.classList.add('text-decoration-underline')
    element.style.cssText  = 'border: 5px solid #FFAF66;';
}

function showCampingzang() {
    isCampinglerVisible.value = false;
    const element = document.querySelector('.main-rank-box');
    const elementright = document.querySelector('.main-rank-btn-right');
    const elementLeft = document.querySelector('.main-rank-btn-left');

    elementLeft.classList.remove('text-decoration-underline');
    elementright.classList.add('text-decoration-underline')
    element.style.cssText  = 'border: 5px solid #FFF3DD;';
    // elementLeft.style.cssText  = 'text-decoration:none;';
}

onBeforeMount(() => {
  if(store.state.boardData.length < 1 ) {
    store.dispatch('setMainCampingler');
  }
  if(store.state.mainCampingzang.length < 1 ) {
    store.dispatch('setMainCampingzang');
  }
  if(store.state.mainCommunity.length < 1 ) {
    store.dispatch('setMainCommunity');
  }
  if(store.state.suggestCam.length < 1 ) {
    store.dispatch('setSuggestCam');
  }

    if(store.state.suggestBrand.length < 1 ) {
    store.dispatch('setSuggestBrand');
    }
//   if (store.state.suggestbrand && store.state.suggestbrand.length <= 1) {
//     store.dispatch('setSuggestBrand');
//   }
    store.dispatch('fetchCamps');
    store.dispatch('updateUserPosition');
    store.dispatch('stampCnt');
})
const stampCnt = computed(() => store.state.stampCnt);
const isWithinTargetArea = computed(() => store.state.isWithinTargetArea);
const currentTarget = computed(() => store.state.currentTarget);
const authFlg = computed(() => store.state.authFlg);

let isStamped = ref(false);
let isTrue = ref(false);

function createStamp() {
  const userId = store.state.stampUser.id; // 로그인된 유저의 ID
  const campId = store.state.currentTarget.id; // 현재 위치한 캠프의 ID

  axios.post(`api/stampStore/${campId}`, {
    user_id: userId,
  })
  .then(function(response) {
    console.log('Stamp created:', response.data);
    // 성공적으로 stamp가 생성된 경우 추가적으로 할 작업이 필요하면 여기에 추가
    isStamped.value = true;
    isTrue = true;
  })
  .catch(function(error) {
    console.error('Error creating stamp:', error);
    alert('이미 정복한 캠핑장 입니다!');
  });
}

const isScrolled = ref(false);
const scrollThreshold = 200; // 스크롤 임계값

const handleScroll = () => {
  isScrolled.value = window.scrollY > scrollThreshold;
};





onMounted(() => {
    const stateData = ref(store.state.stateData);
    const countyData = ref(store.state.countyData);
    // store.dispatch('stateGet');
    // store.dispatch('countyGet');
    if (!stateData.value.length) {
        store.dispatch('stateGet');
    }
    if (!countyData.value.length) {
        store.dispatch('countyGet');
  }
  window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll);
});

function searchBtn(e) {
    const selectStateElement = document.querySelector('#select1');
    const selectCountyElement = document.querySelector('#select2');
    const selectedState = selectStateElement.value;
    const selectedCounty = selectCountyElement.value;

    console.log('선택된 값:', selectedState);
    console.log('선택된 값:', selectedCounty);

    store.dispatch('searchResult', {
        state: selectedState, // 선택된 시/도 값
        county: selectedCounty, // 선택된 구/군 값
        // 추가
    });
}




</script>

<style scoped src="../css/main.css">
/* @import url('../css/main.css'); */


</style>
