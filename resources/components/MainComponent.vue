<template>
    <!-- 첫번째 -->
    <div class="main-main">
        <div class="main-logo">
            <img src="/img/logo-ko3.png" class="img-fluid" alt="Logo" loading="lazy">
        </div>
        <div class="main-search">
            <form action="" id="searchForm" class="d-flex flex-column align-items-center justify-content-center">
                <div class="d-flex justify-content-center align-items-center">
                    <span class="me-2">어느지역?</span>
                    <div class="main-select-box me-2">
                        <select @change="changeState" name="state" id="select1" class="select" v-model="stateSelete">
                            <option :value="0">전체 시/도</option>
                            <option :value="item.id"  v-for="(item, key) in $store.state.stateData" :key="key">{{ item.name }}</option>
                        </select>
                    </div>
                    <div class="main-select-box">
                        <select @change="changeCounty" name="county" id="select2" class="select" v-model="countySelete">
                            <option :value="0">전체 구/군</option>
                            <option :value="item.id" v-for="(item, key) in $store.state.countyData" :key="key">{{ item.name }}</option>
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
                    <button type="button" @click="searchBtn" class="main-search-button">검색</button>
                </div>
            </form>
        </div>
    
    <!-- 두번째 -->
    <div class="bg-white white-main main-second" data-section="2">
        <div class="main-top">
            <div class="main-top-left">
                <div class="main-top-img">
                    <img src="/img/logo-ko3.png" class="main-top-img" alt="" loading="lazy">
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
            </div>
            <div class="main-top-middle">
                <div class="main-mini-search">
                    <div class="align-items-center justify-content-center popularBoard">
                        <div class="d-flex justify-content-between align-items-center">
                        <h2 class="animate__animated animate__bounce animate__repeat-3 animate__slow">캠팡 인기글</h2>
                        <router-link to="/community/1"><span class="btn btn-outline-success">더보기</span></router-link>
                        </div>
                        <hr>
                        <p class="freeBoardList" v-for="(item, index) in $store.state.mainCommunity" :key="index"><span class="main-community-span">자유</span>{{ index + 1 }}위. {{ item.title }}</p>
                    </div>
                </div>
            </div>
            <div class="main-top-right">
                <div class="main-mini-search">
                    <div class="align-items-center justify-content-center popularBoard">
                        <div class="d-flex justify-content-between align-items-center">
                        <h2 class="animate__animated animate__bounce animate__repeat-3 animate__slow	">캠팡 꿀팁</h2>
                        <router-link to="/community/4"><span class="btn btn-outline-success">더보기</span></router-link>
                    </div>
                        <hr>
                        <p class="freeBoardList" v-for="(item, index) in $store.state.tip" :key="index"><span class="main-span-tip">꿀팁</span>{{ index + 1 }}위. {{ item.title }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-bottom" data-section="3">
            
            <div class="main-right-top" data-counter>
                <div>
                    <span class=" main-count">0</span>
                    <p>가입유저수</p>
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAACXBIWXMAAAsTAAALEwEAmpwYAAADNklEQVR4nO2dTUtVURSGnwZlgTUriqJBkVGQEEEG9jOylH5ANG0aCU4KxHFf5rBJRP6CpBpkSEQfQxsVBSlSlt997Ni4LtlNypv3nrXuve8D7+R6de/1rnP22eesfbYghBBCCCGEEEIIIUQ8tgE9wCAwBkwAS6YJ++wm0A1s9e5sI9EGDAGzQFqj8ndvAQe8O1/PbAEGgK8VGF+ufHb0A5u9g6k3DgCv1mF8uUaBXd5B1QtHbUxPVdZboN07uHo48idqYP7KJOz0DjIqm4HnNTS/pKd2fRFlDBRgfkl95Y03O23rnO1Uqi8ain5nqEDzS7rqdLCFvMOddUjAjO6Yl+lxML+kM9aHpmbQMQE3vIOPwJhjAvIdctMz6ZiAD03vPrDomIAFJQAlwJtJDUG+jOki7MtNxwRcd449BN2OCejyDj4CrfZYoGjzZ6xtwXIBvegE5KFPrKiELRVofr732FdqXCzTX2ACrliboqwkOVqA+Y+BlpUNi1/kgvmbGpr/Dti9oj2xCu22eqHa5ufEHlmtQfEn24GHVR52tBylQlps9cLMOmc7lzXmr4+dVkCvJBEzVu3SVLOKtFoNNz+/eWLFlEXTB/vsGnBad7hCCCGEEEIIIYQQQlT+5swxWzfUC9wGRuwtx9f2OuuCacI+yz+7b9/ttd/Nf0N7R/yDjUAHcAEYttJhLcqRw9ZGh7XZtGwAjlvBZcTpHbFZa7vP+pL71NDkAE/aM/v3DoanNZwhuW+djZaMHcBFYDyAyWmNGrc+59p03XLY3v+dD2Bo+k/N27LJQ9QRe60e+y2AgalK+g7cAfYTmE029VsIYFiqkXJslyLOoNqrvMFSCq6XkRZ5dTmt70/Oyht+nPI2/zzwI4AZyUk59nNe5p+1i1Nqcn23Rx6F7+8zFyD4FERzRW+R+ShA0CmYHhRlfmeAYFNQnWj07WVScBWy/c2LAIGmoHpWRAI+BQg0BdXHIhLgHWQKLiUAJcD9KEw6A/yNSBqC/M1IDtI1gAZPwOcAR1kKqjxFrzn3AgSagupuEQk4CEwFCDYF01SRT0T3WJF6OkDgyVnTduTrPzYJIYQQQgghhBBCCP7GT8suwKXYQNvyAAAAAElFTkSuQmCC">
                </div>
                <div>
                    <span class=" main-count">0</span>
                    <p>도장갯수</p>
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAAsTAAALEwEAmpwYAAADeklEQVR4nO2dTYhOURjHf4zvjwVm5SNlyVL5KGsZHxtFbKxkQZqlsLHRNBulwexRikhYWSkS5aPkIxthRBNGGgmlRydnUu/MO2be9973PPc9/1/9N/Nx75znN+fce+49970ghBBC5MFUYB1wBLgMPAWGgF8xQ/Fr4XuH48+G3xEFsxToAd4BNskMxN8N2xBNsgjoB342IKI2P4AzcZuiAXYBnwoQUZuPwE4ZmTjTYq+wknM67kuMw2zgegtkjORa3KcYgw7gSgtljOSGesrY9CeQMZJT6iKjD+CWODsk5S8L45mPJU44o+uUlLRDldWkL3chSwua9FlBCZPHJWRMjwMJVpPjZEq46PfWgQCrybt4Cp4d6xwU3+pkDRly1EHhrU4OkSEpZuU2wVwiQ546KLzVyRMy5LODwludhIlqdniaf9gY85HskBBnlHE30ArKIBny0kHhrU5ekCGtvDNok8xVMsTjdSzL+XrWZgeFtzrZSIbMjaeX5izfc174cNGBAKvJBTJmkwMBpuHqH1OA+w4kWMyD+DdlTZcDEZbzwXwsbjmQcTt1ETyxHvidUEbY99rURfBGX0IhJ1M33uu85FUCGW+A+akb75UtCYSEfYpxON9CGedk4v90xvsRZcsI+9DjbRNkXwuE7FXvmDgdJa9Kea6HdCbP9hKFhG2LBnrJm5KW+EyXjcY4UYIQPb7WBFtLEBLuVIoGWV6CkGWy0ThzShAyS0KawwqOkJD2wtRDfGES4guTEF+YhPjCJMQXJiFCCCFEdW9MrQR2A73AzYIWPQzGbfXGba/M9UNmxmMGsArYE1cP3gG+lXBmVS/h48mfAWeBbmADMI9MWBAb3B0L8Czxel4bJ+/jQ6nHgG3ACipMR2zAttig0LAPDopsTeZL7MEnY49eHXu4K1IPOZY4SYe8Kg051s5DXlgU8NpBI63ieR2fFmuaRt7ZoVD3XSZNo+JSaA0kBF//VBJCegkSQvrCSwjpiy0hpC+whJC+qBJC+kJKCOmLJyGkL5iEOCiSSUj6wpiEpC+GOYgundBmQgYcNMLaJOEVT03T5fRdUVaxvC3qBpUQQgjRLMMODoxW0XylBO45aJhVNHfLEHLQQcOsotlfhpCZwGMHjbOK5WGZa4DDq60fOWikVUjGYkom2D4Qx0Ud6BklYTjWZr/H1fFCCCFoW/4AQvL8SIqQ7nwAAAAASUVORK5CYII=">
                </div>
                <div>
                    <span class=" main-count">0</span>
                    <p>캠핑장 수</p>
                   <img src="data:image/png;base64,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">
                </div>
            </div>
            <!-- <div class="main-right-bottom">
                <div class="right-tv">
                    <a href="#">캠팡 유튜브 <img src="/img/tv.png" alt="" loading="lazy"></a>
                </div>
            </div> -->
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
                    <router-link to="/search" id="btn-wrapper" class="btn btn-btn third-main-btn">캠핑장 구경가기<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACQklEQVR4nO2ZTWsTQRiAHyKFXvRSepNoFRoq2Jt4US8aUHos0pIfUL1YU7XgSX+EJ0/+BU0EvyqttPQjoR57rEpjoOKlUbSt6MrAuzAs3e1osrvvhjwwbPadD96ns7M7dKBHd5EDSkAVaAJ7cq0Ak1KvnlPAe8CLKOvAEMolvkiym8AUcBzok+sN4IPUb2uVyVkz8Qo4GtLOxF9Lu7rGx6xkzUSYhM8x4KO0n0AZVUnMPE4+J4GXwFfgBZC36m5K+2cooymJmbXg8y6wyM0j5ZOX2GeUsSuJ9Vux/YDID6uuX2Kmnyo+SWIFK3bQq9dnRO7NWlFFRRK75SgyLfdPUcZ1SazhKNKQ+3GUkQMWA8lGiZjfy8ARFHL6H2ZkS3YCahlyFFG5PQkjSiRTeD2RDM3ICeAt0ALmAvuwTIm8CcTN1t9++80D34BV4CyKRfYCcXPvsxCoWyNlDvsg2uV3xGbzl1VXkA/vd2AFOKNNZN+x33wgvqRNZNexXyuiX6IiF4CLB8T/AOdD6jxrzJ9pfJu8DpaOi1wDavJqNNerCYlcAs7JzLUtUgwZ6H4CIp7DbDlTjxisnCWR1iEDlrMiUnMYtJwFkSshayRszagVQf7inqOMahHDnQSTjFXEMNMtIppmhm6R6Rh3u0XEcC8liR1iYDYFkY04RNKQeUKMPEhQZIyYeZiARD2pU+FZx73Z/5QWMEqCFOXAs9MSRVJgAHhkHZi2U5aAYVJmELgNPJeDHhcx848484p9DFxOW6AHbfIX2QllrDABzUoAAAAASUVORK5CYII=" id="btn-img"></router-link>
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
                <p class="text-end main-promotion">* 본 섹션은 광고를 포함하고 있습니다.</p>
                <div class="carousel-container">
                    <div class="carousel-inner h-100">
                        <div class="carousel-item h-100" data-bs-interval="5000"
                            v-for="(camp, index) in $store.state.suggestCam"
                            :class="{'active': index === 0}"
                            :key="index">
                            <img :src="camp.main_img" class="d-block last-box-img h-100" alt="추천 캠핑장 이미지">
                            <div class="carousel-caption d-none d-md-block">
                                <h1>{{ camp.name }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="last-right">
            <h2>캠팡 추천 브랜드</h2>
            <p>믿고 보는 캠팡PICK!</p>
            <p class="text-end main-promotion">* 본 섹션은 광고를 포함하고 있습니다.</p>
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
import { onBeforeMount,ref, computed, onUnmounted, watch } from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

const store = useStore();
const router = useRouter();
// const campData = ref(store.state.campData);

function addScrollEvent() {
  window.addEventListener('scroll', handleScroll);
}

function removeScrollEvent() {
  window.removeEventListener('scroll', handleScroll);
}

onBeforeMount(() => {
  // 메인 페이지가 활성화될 때 스크롤 이벤트 추가
  if (router.currentRoute.value.name === '/main') {
    addScrollEvent();
  }
});

onUnmounted(() => {
  // 메인 페이지가 비활성화될 때 스크롤 이벤트 제거
  removeScrollEvent();
});



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
  const counters = document.querySelectorAll(".main-count");
  
  counters.forEach(($counter, index) => {
    // 목표 수치 설정
    let max;

    if (index === 0) {
      max = 124; // 첫 번째 항목의 목표 수치 설정
    } else if (index === 1) {
      max = 322; 
    } else if (index === 2) {
      max = 467; // 세 번째 항목의 목표 수치 설정
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
    if(store.state.tip.length < 1 ) {
    store.dispatch('setTip');
    }
    store.dispatch('fetchCamps');
    store.dispatch('updateUserPosition');
    store.dispatch('stampCnt');

    // 시군구 정보
    if (store.state.stateData.length < 1) {
        store.dispatch('stateGet');
    }
    // if (store.state.countyData.length < 1) {
    //     store.dispatch('countyGet');
    // }
    window.addEventListener('scroll', handleScroll);
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



// onUnmounted(() => {
//   window.removeEventListener('scroll', handleScroll);
// });


// 시군구 선택
const stateSelete = ref('0');
const countySelete = ref('0');

function changeState() {
    console.log('메인 시군구 선택', stateSelete.value);
    store.dispatch('countyGet', stateSelete.value);
}


function searchBtn() {
    console.log('선택된 값:', stateSelete.value, countySelete.value);

    store.commit('setLocalInfo',{
        state: stateSelete.value, // 선택된 시/도 값
        county: countySelete.value, // 선택된 구/군 값
        page: 1,
    })
    store.dispatch('searchResult');

    router.push('/search');
}

</script>

<style scoped src="../css/main.css">
/* @import url('../css/main.css'); */


</style>
