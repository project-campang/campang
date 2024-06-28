<template>
    <main>
        <div class="main-container-search">
            <!-- <div class="search-container"> -->
            <div class="search-container" ref="searchContainer">
                <div class="search-box">
                    <form action="" id="searchForm">
                        <label for="address"></label>
                        <select @change="selectState" name="state" id="select1" class="address">
                            <option>시/도 선택</option>
                            <option v-for="(item, key) in $store.state.stateData" :key="key">{{ item.name }}</option>
                        </select>
                        <select @change="selectCounty" name="county" id="select2" class="address">
                            <option>구/군 선택</option>
                            <option v-for="(item, key) in $store.state.countyData" :key="key">{{ item.name }}</option>
                            <!-- <option v-for="(item, key) in filteredCounties" :key="key" :value="item.id">{{ item.name }}</option> -->
                        </select>
                        <button class="search-btn btn-bg-yellow" type="button" @click="searchBtn">검색</button>
                        <!-- <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item" style="background-color: white;">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    상세 검색
                                </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                                    <div class="accordion-body">
                                        <div class="accordion" id="nestedAccordionOne">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="nested-headingOne">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#nested-collapseOne" aria-expanded="true" aria-controls="nested-collapseOne">
                                                    지형/환경
                                                </button>
                                                </h2>
                                                <div id="nested-collapseOne" class="accordion-collapse collapse" aria-labelledby="nested-headingOne">
                                                    <div class="accordion-body">
                                                        <label for="topo">
                                                            <span><input type="checkbox" name="revierside" id="topo1">강변</span>
                                                            <span><input type="checkbox" name="valley" id="topo2">계곡</span>
                                                            <span><input type="checkbox" name="city" id="topo3">도심</span>
                                                            <span><input type="checkbox" name="ocean" id="topo4">바다</span>
                                                            <span><input type="checkbox" name="mountain" id="topo5">산</span>
                                                            <span><input type="checkbox" name="island" id="topo6">섬</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="nested-headingTwo">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#nested-collapseTwo" aria-expanded="false" aria-controls="nested-collapseTwo">
                                                    편의 시설
                                                </button>
                                                </h2>
                                                <div id="nested-collapseTwo" class="accordion-collapse collapse" aria-labelledby="nested-headingTwo">
                                                    <div class="accordion-body">
                                                        <label for="amenities">
                                                            <span><input type="checkbox" name="wash" id="amenities1">개수대</span>
                                                            <span><input type="checkbox" name="store" id="amenities2">편의점</span>
                                                            <span><input type="checkbox" name="barbecue" id="amenities3">바비큐</span>
                                                            <span><input type="checkbox" name="shower-booth" id="amenities4">샤워시설</span><br>
                                                            <span><input type="checkbox" name="heated-water" id="amenities5">온수</span>
                                                            <span><input type="checkbox" name="wi-fi" id="amenities6">와이파이</span>
                                                            <span><input type="checkbox" name="long-stay" id="amenities7">장기숙박</span>
                                                            <span><input type="checkbox" name="electricity" id="amenities8">전기</span><br>
                                                            <span><input type="checkbox" name="rental" id="amenities9">캠핑용품 대여</span>
                                                            <span><input type="checkbox" name="restroom" id="amenities10">화장실</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="nested-headingThree">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#nested-collapseThree" aria-expanded="false" aria-controls="nested-collapseThree">
                                                    즐길거리
                                                </button>
                                                </h2>
                                                <div id="nested-collapseThree" class="accordion-collapse collapse" aria-labelledby="nested-headingThree">
                                                    <div class="accordion-body">
                                                        <label for="amusement">
                                                            <span><input type="checkbox" name="sea-fishing" id="amusement1">바다낚시</span>
                                                            <span><input type="checkbox" name="river-fishing" id="amusement2">민물낚시</span>
                                                            <span><input type="checkbox" name="pool" id="amusement3">수영장</span>
                                                            <span><input type="checkbox" name="karaoke" id="amusement4">노래방</span><br>
                                                            <span><input type="checkbox" name="leisure" id="amusement5">수상레저</span>
                                                            <span><input type="checkbox" name="playground" id="amusement6">체육시설(놀이터)</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </form>
                </div>
                <div class="result">
                    <div class="count">
                        <span>총</span>
                        {{ $store.state.campData.length }} 
                        <span>개의 캠핑장 발견!</span>
                    </div>
                </div>
                <div class="search-item" @click="markerShow" v-if="searchResult.length === 0" v-for="(item, key) in $store.state.campData" :key="key" >
                    {{ console.log('ddddddddd', searchResult.length) }}
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
                                <span class="sub-text">1박 기준</span>
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
                    <button class="pre-next-btn" type="button" :disabled="$store.state.paginationSearch.current_page == 1" @click="prevPage()"><ㅤ</button>
                    <div class="page-num">{{ $store.state.paginationSearch.current_page+'ㅤ/ㅤ'+$store.state.paginationSearch.last_page }}</div>
                    <button class="pre-next-btn" type="button" :disabled="$store.state.paginationSearch.current_page == $store.state.paginationSearch.last_page" @click="nextPage()">ㅤ> </button>
                </div>          
            </div>
            <div class="resizer" id="drag" @mousedown="startResize"></div>
            <div class="map-container">
                <div class="map">
                    <KakaoMap :lat="mapCenter.lat" :lng="mapCenter.lng" :draggable="true" :level="7">
                        <KakaoMapMarker
                            v-for="(item, key) in $store.state.campData"
                            :key="key"
                            :id="item.id"
                            :lat="item.latitude"
                            :lng="item.longitude"
                            :title="item.name"
                            :clickable="true"
                            @on-click-kakao-map-marker="openMarkerLink(`/camp/${item.id}`)"
                        ></KakaoMapMarker>
                    </KakaoMap>
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
import { onBeforeMount, onMounted, ref, watch, computed } from 'vue';
import { useStore } from 'vuex';


const store = useStore();
// const imgPlace = ref(false);
// const selectedCounty = ref('');
const searchResult = ref([]); // 검색 결과
// const stateData = ref(store.state.stateData);
// const countyData = ref(store.state.countyData);
const campData = ref(store.state.campData);

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
};

// // // 두 번째 셀렉트 박스에서 county 선택 시 실행되는 함수
// const selectCounty = (event) => {
//     selectedCounty.value = event.target.value;
// };


// 지도 중심 좌표 초기화
const mapCenter = ref(store.state.mapCenter);

// Vuex의 `mapCenter` 상태를 반응형으로 감시하여 자동 업데이트
watch(() => store.state.mapCenter, (newCenter) => {
  mapCenter.value = newCenter;
}, { immediate: true });

// 검색시 쳣 번 째 캠핑장 좌표로 바꿈
watch(campData, (newData) => {
  if (newData.length > 0) {
    const firstItem = newData[0];
    mapCenter.value = {
      lat: firstItem.latitude,
      lng: firstItem.longitude
    };
    console.log('중심좌표 변경됨', mapCenter.value);
  }
}, { immediate: true });

// function markerShow(e) {
//     console.log(e);
//     store.dispatch('markerShow')

// }



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

// 검색 버튼

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


// // 검색 셀렉트박스 연결
// function selectChange() {
//   // Ref to hold state list
//   const stateList = ref([]);
// }




// 페이지네이션


function prevPage() {
    store.dispatch('campListGet', store.state.paginationSearch.current_page-1);
    console.log('-1', store.state.paginationSearch);
    console.log('-1', store.state.paginationSearch.current_page);
    console.log('-1', store.state.paginationSearch.current_page-1);
}

function nextPage() {
    store.dispatch('campListGet', store.state.paginationSearch.current_page+1);
    console.log('+1', store.state.paginationSearch);
    console.log('+1', store.state.paginationSearch.current_page);
    console.log('+1', store.state.paginationSearch.current_page+1);
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

// const campData = ref([]);
// watch(() => store.state.campData, (newCampData) => {
//     campData.value = newCampData.map((item, index) => ({
//         ...item,
//         markerZIndex: 1 // 초기 z-index 설정
//     }));
// });



onBeforeMount(() => {
    console.log('onBeforeMount');
    if(store.state.campData.length <  1) {
        store.dispatch('campListGet'); 
    }
    console.log('campListGet');
})

onMounted(() => {
    store.dispatch('stateGet');
    // store.dispatch('countyGet' );
    const resizer = document.querySelector('.resizer');
    resizer.addEventListener('mousedown', startResize);
    window.addEventListener('mouseup', stopResize);
});


</script>

<!-- <style> -->
<style scoped src="../css/search.css">
    /* @import url(../css/search.css); */
</style>