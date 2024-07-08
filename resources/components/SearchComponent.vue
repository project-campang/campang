<template>
    <main>
        <div class="main-container-search">
            <!-- <div class="search-container"> -->
            <div class="search-container" ref="searchContainer">
                <div class="search-box">
                    <div id="searchForm">
                        <label for="address">
                            <select @change="selectState" name="state" id="select1" class="address" v-model="stateSelete">
                                <option :value="0">시/도 선택</option>
                                <option :value="item.id" v-for="(item, key) in $store.state.stateData" :key="key">{{ item.name }}</option>
                            </select>
                            <select @change="selectCounty" name="county" id="select2" class="address" v-model="countySelete">
                                <option :value="0">구/군 선택</option>
                                <option :value="item.id" v-for="(item, key) in $store.state.countyData" :key="key">{{ item.name }}</option>
                                <!-- <option v-for="(item, key) in filteredCounties" :key="key" :value="item.id">{{ item.name }}</option> -->
                            </select>
                        </label>
                        <div class="search-btn-con">
                            <button class="search-btn btn-bg-yellow" type="button" @click="searchBtn">빠른 검색</button>
                            <button class="search-btn btn-bg-grey" type="button" @click="toggleAccordion">상세 검색</button>
                        </div>
                        <!-- 아코디언 영역 -->
                        <transition>
                            <div v-if="accordionFlg" class="accordion-container">
                                <div class="accordion-title">
                                    <img src="/img/check-mark.png" style="width: 25px;" alt="">
                                    원하는 캠핑장을 좀 더 상세하게 찾아보세요.
                                </div>
                                <div class="accordion-items">
                                    <div class="items site-type">
                                        <span class="option-name">캠핑 유형</span>
                                        <div class="option-list">
                                            <label for="caravan"><span><input type="checkbox" name="caravan" id="caravan"> 카라반</span></label>
                                            <label for="glamping"><span><input type="checkbox" name="glamping" id="glamping"> 글램핑</span></label>
                                            <label for="deck"><span><input type="checkbox" name="deck" id="deck"> 데크</span></label>
                                            <label for="grass"><span><input type="checkbox" name="grass" id="grass"> 잔디</span></label>
                                            <label for="gravel"><span><input type="checkbox" name="gravel" id="gravel"> 자갈</span></label>
                                            <label for="crushed-stone"><span><input type="checkbox" name="crushed-stone" id="crushed-stone"> 파쇄석</span></label>
                                            <label for="soil"><span><input type="checkbox" name="soil" id="soil"> 흙</span></label>
                                        </div>
                                    </div>
                                    <div class="items topo">
                                        <span class="option-name">지형/환경</span>
                                        <div class="option-list">
                                            <label for="river"><span><input type="checkbox" name="river" id="river"> 강변</span></label>
                                            <label for="valley"><span><input type="checkbox" name="valley" id="valley"> 계곡</span></label>
                                            <label for="ocean"><span><input type="checkbox" name="ocean" id="ocean"> 바다</span></label>
                                            <label for="mountain"><span><input type="checkbox" name="mountain" id="mountain"> 산</span></label>
                                            <label for="ground"><span><input type="checkbox" name="ground" id="ground"> 초원</span></label>
                                        </div>
                                    </div>
                                    <div class="items amenities">
                                        <span class="option-name">편의 시설</span>
                                        <div class="option-list">
                                            <label for="electricity"><span><input type="checkbox" name="electricity" id="electricity"> 전기</span></label>
                                            <label for="wi-fi"><span><input type="checkbox" name="wi-fi" id="wi-fi"> 와이파이</span></label>
                                            <label for="store"><span><input type="checkbox" name="store" id="store"> 편의점</span></label>
                                            <label for="heated-water"><span><input type="checkbox" name="heated-water" id="heated-water"> 온수</span></label>
                                            <label for="shower-booth"><span><input type="checkbox" name="shower-booth" id="shower-booth"> 샤워실</span></label>
                                            <label for="barbecue"><span><input type="checkbox" name="barbecue" id="barbecue"> 바비큐</span></label>
                                        </div>
                                    </div>
                                    <div class="items items-last amusement">
                                        <span class="option-name">즐길거리</span>
                                        <div class="option-list">
                                            <label for="fishing"><span><input type="checkbox" name="fishing" id="fishing"> 낚시</span></label>
                                            <label for="leisure"><span><input type="checkbox" name="leisure" id="leisure"> 수상 레저</span></label>
                                            <label for="pool"><span><input type="checkbox" name="pool" id="pool"> 수영장</span></label>
                                            <label for="sports"><span><input type="checkbox" name="sports" id="sports"> 체육 시설</span></label>
                                            <label for="playground"><span><input type="checkbox" name="playground" id="playground"> 놀이터</span></label>
                                        </div>
                                    </div>
                                    <div class="items items-last price">
                                        <div>
                                            <span class="option-name">가격대(₩)</span><br>
                                            <span class="sub-text">(1박 기준 세금 포함)</span>
                                        </div>
                                        <div class="option-list">
                                            <input type="number" name="" id="" min="41000" max="60900">
                                            <span>ㅤ~ㅤ</span>
                                            <input type="number" name="" id="" min="41000" max="60900">
                                            <button class="btn-bg-green" type="button" @click="searchBtn">검색</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </transition>
                    </div> 
                </div>
                <div class="result">
                    <div class="count">
                        <img src="" draggable="false" alt="">
                        <span>총</span>
                        {{ $store.state.campData.total }} 
                        <span>개의 캠핑장 발견!</span>
                    </div>
                </div>
                <div class="search-item-con">
                    <div class="search-item" @click="markerShow(item)" v-for="(item, key) in $store.state.campData.data" :key="key" >
                        <div class="item-img">
                            <img class="img main-img" :src='item.main_img' alt="">
                        </div>
                        <div class="item-info">
                            <div>
                                <span class="item-name">{{ item.name }}</span>
                                <span class="item-distance sub-text">87.2km</span>
                            </div>
                            <div class="item-info-2">
                                <span class="address-depth sub-text">{{ item.state }} > {{ item.county }}> </span>
                                <span class="address-depth2">{{ item.address }}</span>
                            </div>
                            <div class="item-info-3">
                                <span class="item-price">₩{{ item.price }}
                                    <span class="sub-text">(1박 기준 세금 포함)</span>
                                </span>
                            </div>
                            <div class="item-tel sub-text">
                                <span>{{ item.tel }}</span>
                            </div>
                        </div>
                        <div class="item-detail">
                            <button>
                                <a :href="`/camp/${item.id}`">
                                    <img src="../../public/img/상세보기 화살표.png" alt="">
                                </a>
                            </button>
                        </div>
                    </div> 
                    <div class="pagination">
                        <button class="pre-next-btn" type="button" :disabled="$store.state.campData.current_page == null" @click="prevPage()"><ㅤ</button>
                        <div class="page-num">{{ $store.state.campData.current_page+'ㅤ/ㅤ'+$store.state.campData.last_page }}</div>
                        <button class="pre-next-btn" type="button" :disabled="$store.state.campData.current_page == $store.state.campData.last_page" @click="nextPage()">ㅤ> </button>
                    </div>          
                </div>
            </div>
            <div class="resizer" id="drag" @mousedown="startResize"></div>
            <div class="map-container">
                <div class="map" id="map">
                    {{ console.log('지도불러왔다') }}
                    <KakaoMap :lat="$store.state.mapCenter.lat" :lng="$store.state.mapCenter.lng" :draggable="true" :level="9" class="marker-parent">
                        <KakaoMapMarker
                            v-for="(item, key) in $store.state.campData.data"
                            :key="key"
                            :id="item.id"
                            :lat="item.latitude"
                            :lng="item.longitude"
                            :title="item.name"
                            :clickable="true"
                            :imageUrl="'/images/center-pin.png'"
                            @onLoadKakaoMapMarker="markerLoad()"
                            @mouseenter="markerMouseEnter(item)"
                            @onClickKakaoMapMarker="openMarkerLink(`/camp/${item.id}`)"
                            :image="{
                                imageSrc: '/images/map-pin.png',
                                imageWidth: 35,
                                imageHeight: 37,
                                imageOption: {}
                            }"
                        ></KakaoMapMarker>
                    </KakaoMap>
                    {{ console.log('지도불러왔다') }}
                </div>


                <div class="parents">
                    <div>
                        <div>
                            <img src="" alt="">
                        </div>
                    </div>
                </div>

                <div class="float-btn">
                    <!-- <button class="result-pin" @click="adjustMarkerZIndex">검색</button>
                    <button class="wishlist-pin">찜</button>
                    <button class="complete-pin">정복</button> -->
                </div>
            </div>
        </div>
    </main>
</template>

<script setup>
import { KakaoMap, KakaoMapMarker } from 'vue3-kakao-maps';
import { onBeforeMount, onMounted, ref, watch, computed, nextTick, onUpdated, onBeforeUpdate } from 'vue';
import { useStore } from 'vuex';


const store = useStore();
// const imgPlace = ref(false);
// const selectedCounty = ref('');
const searchResult = ref([]); // 검색 결과
// const stateData = ref(store.state.stateData);
// const countyData = ref(store.state.countyData);

// const stateData = ref([]);
// const countyData = ref([]);
// const campData = ref([]);

// watch(() => store.state.stateData, (newStateData) => {
//     stateData.value = newStateData;
// })

// watch(() => store.state.countyData, (newCountyData) => {
//     countyData.value = newCountyData;
// })

// watch(() => store.state.campData, (newCampData) => {
//     campData.value = newCampData;
// });

// 선택한 시/도에 따라 구/군 목록 업데이트

// let selectedState = ref('');
// let selectedCounty = ref('');
// const stateData = ref(store.state.stateData);
// const countyData = ref(store.state.countyData);

// const filteredCounties = computed(() => {
//     return countyData.value.filter(county => county.state_id === selectedState.value);
// });

// // state 변경 감지
// watch(() => store.state.stateData, (newStateData) => {
//     stateData.value = newStateData;
// });

// // // county 변경 감지
// watch(() => store.state.countyData, (newCountyData) => {
//     countyData.value = newCountyData;
// });

// // // 첫 번째 셀렉트 박스에서 state 선택 시 실행되는 함수
const selectState = (e) => {
    const selectedStateId = e.target.value;

    store.dispatch('countyGet', selectedStateId);
    console.log('실행?', selectedStateId);
};

// // // 두 번째 셀렉트 박스에서 county 선택 시 실행되는 함수
// const selectCounty = (event) => {
//     selectedCounty.value = event.target.value;
// };


// `campData`가 변경될 때 첫 번째 항목의 좌표로 지도 중심을 업데이트하는 watcher
watch(() => store.state.campData, (newData) => {
    if (newData.data && newData.data.length > 0) {
        const firstItem = newData.data[0];
        store.commit('updateMapCenter', {
            lat: firstItem.latitude,
            lng: firstItem.longitude
        });
    }
}, { immediate: true });


const imageUrls = {};

function markerLoad() {
    console.log('처음 로드되는 이벤트');
}

// item 클릭시 이벤트
function markerShow(item) {
    console.log('기존 중심좌표', store.state.mapCenter);

// 중심 좌표 업데이트
store.commit('updateMapCenter', {
    lat: item.latitude,
    lng: item.longitude
});

console.log('새 중심좌표', store.state.mapCenter);

const parentElement = document.querySelector('#map');
const childElements = parentElement.querySelectorAll('img[title]');

    childElements.forEach(function(img) {
        const imgTitle = img.getAttribute('title');
        console.log('imgTitle', imgTitle);
        console.log('item.name', item.name);
        if (imgTitle === item.name) {
            console.log('똑같다');
            img.src = imageUrls[item.name] || '/images/center-pin.png';
            img.style.zIndex = '4';
        } else {
            img.src = '/images/map-pin.png';
            img.style.zIndex = '1';
        }

        img.style.width = '35px';
        img.style.height = '37px';
    });

    // 이미지 URL 관리 객체 업데이트
    imageUrls[item.name] = '/images/center-pin.png';

    console.log('클릭이벤트 끝');
}


// 검색 화면 리사이즈

const startResize = () => {
    window.addEventListener('mousemove', resize);
    window.addEventListener('mouseup', stopResize);
}
const resize = (e) => {
    const container = document.querySelector('.search-container');
    const resizer = document.querySelector('.resizer');
    const offsetRight = document.documentElement.clientWidth - e.clientX;
    container.style.width = e.clientX - container.getBoundingClientRect().left + 'px';
    resizer.style.right = offsetRight + 'px';
};
const stopResize = () => {
    window.removeEventListener('mousemove', resize);
    window.removeEventListener('mouseup', stopResize);
}


// 시군구 선택
const stateSelete = ref(store.state.localInfo.state);
const countySelete = ref(store.state.localInfo.county);


// 검색 버튼
function searchBtn() {
    console.log('선택된 값:', stateSelete.value, countySelete.value);

    store.commit('setLocalInfo',{
        state: stateSelete.value, // 선택된 시/도 값
        county: countySelete.value, // 선택된 구/군 값
        page: 1,
    })
    store.dispatch('searchResult');
}


// 페이지네이션
function prevPage() {
    store.dispatch('campListGet', {page: store.state.campData.current_page-1, state: stateSelete.value, county: countySelete.value});
    console.log('-1', store.state.campData.current_page-1);
}
function nextPage() {
    store.dispatch('campListGet', {page: store.state.campData.current_page+1, state: stateSelete.value, county: countySelete.value});
    console.log('+1', store.state.campData.current_page+1);
}




function openMarkerLink(url) {
      window.location.href = url;
      element.style.width = '200px';
    }


const adjustMarkerZIndex = () => {
    // 각 마커의 z-index를 조정
    const campData = store.state.campData;
    campData.forEach((item, index) => {
        item.markerZIndex = index === 0 ? 0 : 1; // 첫 번째 마커는 0(z-index), 나머지는 1(z-index)
    });
};

let accordionFlg = ref(false);

const toggleAccordion = () => {
    accordionFlg.value = !accordionFlg.value; // true <-> false 토글
};




onBeforeMount(() => {
    console.log('onBeforeMount 시작');
    if(store.state.campData.length <  1) {
        store.dispatch('searchResult'); 
        console.log('searchResult 실행');
        
    }
    if(store.state.stateData.length <  1) {
        store.dispatch('stateGet');
        console.log('stateGet 실행');
    }
    console.log('store.state.campData', store.state.campData);
    // store.dispatch('searchCount');
    console.log('onBeforeMount 끝');
})

onMounted(async () => {
    await nextTick();
    console.log('onMounted 시작');
    const resizer = document.querySelector('.resizer');
    resizer.addEventListener('mousedown', startResize);
    window.addEventListener('mouseup', stopResize);
    console.log('onMounted 끝');
});

onBeforeUpdate(() => {
    console.log('onBeforeUpdate 시작');
    // const parentElement = document.querySelector('#map');
    // const childElements = parentElement.querySelectorAll('img[title]');
    
    // childElements.forEach(img => {
    //     img.src = '/images/map-pin.png';
    //     img.style.width = '35px';
    //     img.style.height = '37px';
    // });
    console.log('onBeforeUpdate 끝');
})


onUpdated(() => {
    // const parentElement = document.querySelector('#map');
    // const childElements = parentElement.querySelectorAll('img[title]');

    // childElements.forEach(img => {
    //     img.src = '/images/map-pin.png';
    //     img.style.width = '35px';
    //     img.style.height = '37px';
    // });
})



</script>

<!-- <style> -->
<style scoped src="../css/search.css">
    /* @import url(../css/search.css); */
</style>