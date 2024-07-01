<template>
    <main>
        <div class="main-container-search">
            <!-- <div class="search-container"> -->
            <div class="search-container" ref="searchContainer">
                <div class="search-box">
                    <form action="" id="searchForm">
                        <label for="address"></label>
                        <select @change="selectState" name="state" id="select1" class="address" v-model="stateSelete">
                            <option :value="0">시/도 선택</option>
                            <option :value="item.id" v-for="(item, key) in $store.state.stateData" :key="key">{{ item.name }}</option>
                        </select>
                        <select @change="selectCounty" name="county" id="select2" class="address" v-model="countySelete">
                            <option :value="0">구/군 선택</option>
                            <option :value="item.id" v-for="(item, key) in $store.state.countyData" :key="key">{{ item.name }}</option>
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
                        <button class="pre-next-btn" type="button" :disabled="$store.state.campData.current_page == 1" @click="prevPage()"><ㅤ</button>
                        <div class="page-num">{{ $store.state.campData.current_page+'ㅤ/ㅤ'+$store.state.campData.last_page }}</div>
                        <button class="pre-next-btn" type="button" :disabled="$store.state.campData.current_page == $store.state.campData.last_page" @click="nextPage()">ㅤ> </button>
                    </div>          
                </div>
            </div>
            <div class="resizer" id="drag" @mousedown="startResize"></div>
            <div class="map-container">
                <div class="map" id="map">
                    <KakaoMap :lat="$store.state.mapCenter.lat" :lng="$store.state.mapCenter.lng" :draggable="true" :level="7" class="marker-parent">
                        <KakaoMapMarker
                            v-for="(item, key) in $store.state.campData.data"
                            :key="key"
                            :id="item.id"
                            :lat="item.latitude"
                            :lng="item.longitude"
                            :title="item.name"
                            :clickable="true"
                            :imageUrl="'/image/map-pin.png'"
                            @mouseenter="markerMouseEnter(item)"
                            @on-click-kakao-map-marker="openMarkerLink(`/camp/${item.id}`)"
                        ></KakaoMapMarker>
                    </KakaoMap>
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
import { onBeforeMount, onMounted, ref, watch, computed, nextTick, onUpdated } from 'vue';
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


// 지도 중심 좌표 초기화
// const mapCenter = ref(store.state.mapCenter);

// Vuex의 `mapCenter` 상태를 반응형으로 감시하여 자동 업데이트
// watch(() => store.state.mapCenter, (newCenter) => {
//   mapCenter.value = newCenter;
// }, { immediate: true });

// 검색시 쳣 번 째 캠핑장 좌표로 바꿈
// watch(campData, (newData) => {
//   if (newData.length > 0) {
//     const firstItem = newData[0];
//     mapCenter.value = {
//       lat: firstItem.latitude,
//       lng: firstItem.longitude
//     };
//     console.log('중심좌표 변경됨', mapCenter.value);
//   }
// }, { immediate: true });


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


// item 클릭시 이벤트
function markerShow(item) {
    console.log('기존 중심좌표', store.state.mapCenter);
    // 이미지 URL 가져오기
    const parentElement = document.querySelector('#map');
    const childElements = parentElement.querySelectorAll('img');
    let imageUrl = '/image/center-pin';

    childElements.forEach(img => {
        if (img.getAttribute('title') === item.name) {
            imageUrl = img.src;
        }
    });

    // 중심 좌표 업데이트
    store.commit('updateMapCenter', {
        lat: item.latitude,
        lng: item.longitude,
        imageUrl: imageUrl // imageUrl 속성 추가
    });

    console.log('새 중심좌표', store.state.mapCenter);

    // // 마커 이미지 업데이트
    // const map = ref(null); // 지도 객체를 담을 변수
    // const markers = ref([]); // 마커 객체들을 담을 배열
    // // 모든 마커 초기화
    // markers.value.forEach(marker => {
    //     marker.setImage(new kakao.maps.MarkerImage('', new kakao.maps.Size(64, 69)));
    //     console.log('마커 초기화됨', markers.value);
    // });

    // // 클릭한 핀의 마커만 변경
    // const targetMarker = markers.value.find(marker => marker.getTitle() === item.name);
    // if (targetMarker) {
    //     targetMarker.setImage(new kakao.maps.MarkerImage('/img/markerStar.png', new kakao.maps.Size(64, 69)));
    //     console.log('클릭된 마커 변경함', targetMarker);
    // }
    
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



// // 검색 셀렉트박스 연결
// function selectChange() {
//   // Ref to hold state list
//   const stateList = ref([]);
// }




// 페이지네이션
function prevPage() {
    store.dispatch('campListGet', store.state.paginationSearch.current_page-1);
}
function nextPage() {
    store.dispatch('campListGet', store.state.paginationSearch.current_page+1);
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
        store.dispatch('searchResult'); 
    }
    if(store.state.stateData.length <  1) {
        store.dispatch('stateGet');
    }
    console.log('campListGet');
    // store.dispatch('searchCount');
})

onMounted(async () => {
    await nextTick();

    const resizer = document.querySelector('.resizer');
    resizer.addEventListener('mousedown', startResize);
    window.addEventListener('mouseup', stopResize);
});

onUpdated(() => {
    const parentElement = document.querySelector('#map');
    console.log('부모', parentElement);
    const childElements = parentElement.querySelectorAll('img[title]');
    console.log('자식', childElements);
    childElements.forEach(img => {
        img.src = '/images/center-pin.png';
        img.style.width = '35px'; 
        img.style.height = '37px';
    });
})



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
// function searchBtn(e) {
//     const selectStateElement = document.querySelector('#select1');
//     const selectCountyElement = document.querySelector('#select2');
//     const selectedState = selectStateElement.value;
//     const selectedCounty = selectCountyElement.value;

//     console.log('선택된 값:', selectedState);
//     console.log('선택된 값:', selectedCounty);
    
//     store.dispatch('searchResult', {
//         state: selectedState, // 선택된 시/도 값
//         county: selectedCounty, // 선택된 구/군 값
//         // 추가
//     });
    
// }


</script>

<!-- <style> -->
<style scoped src="../css/search.css">
    /* @import url(../css/search.css); */
</style>