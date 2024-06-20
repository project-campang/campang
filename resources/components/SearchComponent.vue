<template>
    <main class="main-container-search">
        <!-- <div class="search-container"> -->
        <div class="search-container" ref="searchContainer">
            <div class="search-box">
                <form action="">
                    <label for="address"></label>
                    <select v-model="selectState" @change="selectChange" name="state" class="address">
                        <option>전체 시/도</option>
                        <option v-for="state in states" :key="state" :value="state">{{ state }}</option>
                    </select>
                    <select v-model="selectCounty" name="county" id="county" class="address" placeholder="전체 구/군">
                        <option>전체 구/군</option>
                        <option v-for="county in counties" :key="county">{{ county }}</option>
                    </select>
                    <button class="search-btn btn-bg-yellow" type="button" @click="search">간편 검색</button>
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <!-- 상세 검색 아코디언 -->
                        <div class="accordion-item" style="background-color: white;">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                상세 검색
                            </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">
                                    <!-- 내부 아코디언 시작 -->
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
                                    <!-- 내부 아코디언 끝 -->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="result">
                <hr>    
                <span>1,000개의 검색 결과</span>
            </div>
            <div class="search-item" v-for="(item, key) in $store.state.campData" :key="key">
                <div class="item-img">
                    <img class="img" :src='item.main_img' alt="">
                </div>
                <div class="item-info">
                    <span class="item-name">{{ item.name }}</span>
                    <div class="item-info-2">
                        <span class="item-distance">87.2km</span>
                        <span>|</span>
                        <span class="adress-depth">{{ item.state }} > {{ item.country }} > {{ item.address }}</span>
                    </div>
                    <div class="item-info-3">
                        <span class="item-price">{{ item.price }}</span>
                        <span class="item-price-2">{{ item.priceDescription }}</span>
                    </div>
                    <div class="item-tel">
                        <span>{{ item.tel }}</span>
                    </div>
                </div>
                <div class="item-detail">
                    <button>자세히</button>
                </div>
            </div>
        </div>
        <div class="resizer" id="drag" @mousedown="startResize">
            <div class="resizer-icon">
                <img class="img" src='../../public/img/right-arrow.png' alt="">
                <img class="img" src='../../public/img/left-arrow.png' alt="">
            </div>
        </div>
        <div class="map-container">
            <div class="map">
                <KakaoMap :lat="coordinate.lat" :lng="coordinate.lng" :draggable="true">
                    <KakaoMapMarker :lat="coordinate.lat" :lng="coordinate.lng"></KakaoMapMarker>
                    <KakaoMapMarker :lat="coordinate1.lat" :lng="coordinate1.lng"></KakaoMapMarker>
                    <KakaoMapMarker :lat="coordinate2.lat" :lng="coordinate2.lng"></KakaoMapMarker>
                    <KakaoMapMarker :lat="coordinate3.lat" :lng="coordinate3.lng"></KakaoMapMarker>
                </KakaoMap>
            </div>
            <div class="float-btn">
                <button class="result-pin">검색</button>
                <button class="wishlist-pin">찜</button>
                <button class="complete-pin">정복</button>
            </div>
        </div>
    </main>
</template>

<script setup>
import { KakaoMap, KakaoMapMarker } from 'vue3-kakao-maps';
import { onBeforeMount, onMounted, ref } from 'vue';
import { useStore } from 'vuex';

const store = useStore();

// 지도 좌표

const coordinate = {
  lat: 37.566826,
  lng: 126.9786567
};
const coordinate1 = {
  lat: 37.5546788,
  lng: 126.9706069
};
const coordinate2 = {
  lat: 37.5660373,
  lng: 126.9821930
};
const coordinate3 = {
  lat: 37.5655638,
  lng: 126.97489
};

// 검색 셀렉트박스 연결

const selectState = ref('전체 시/도');
const selectCounty = ref('전체 구/군');
const states = ['서울특별시', '부산광역시', '대구광역시', '인천광역시', '광주광역시', '대전광역시', '울산광역시', '세종시', '경기도', '강원도', '충청북도', '충청남도', '전라북도', '전라남도', '경상북도', '경상남도', '제주도'];
let countyList  = [
    ['서울특별시 전체','강남구','강동구','강북구','강서구','관악구','광진구','구로구','금천구','노원구','도봉구','동대문구','동작구','마포구','서대문구','서초구','성동구','성북구','송파구','양천구','영등포구','용산구','은평구','종로구','중구','중랑구']
    ,['부산광역시 전체','강서구','금정구','남구','동구','동래구','부산진구','북구','사상구','사하구','서구','수영구','연제구','영도구','중구','해운대구','기장군']
    ,['대구광역시 전체','남구','달서구','동구','북구','서구','수성구','중구','달성군']
    ,['인천광역시 전체','계양구','남구','남동구','동구','부평구','서구','연수구','중구','강화군','옹진군']
    ,['광주광역시 전체','광산구','남구','동구','북구','서구']
    ,['대전광역시 전체','대덕구','동구','서구','유성구','중구']
    ,['울산광역시 전체','남구','동구','북구','중구','울주군']
    ,['세종시 전체','금남면','소정면', '연서면', '전동면']
    ,['경기도 전체','고양시','과천시','광명시','구리시','군포시','남양주시','동두천시','부천시','성남시','수원시','시흥시','안산시','안양시','오산시','의왕시','의정부시','평택시','하남시','가평군','광주시','김포시','안성시','양주군','양평군','여주군','연천군','용인시','이천군','파주시','포천시','화성시']
    ,['강원도 전체','강릉시','동해시','삼척시','속초시','원주시','춘천시','태백시','고성군','양구군','양양군','영월군','인제군','정선군','철원군','평창군','홍천군','화천군','황성군']
    ,['충청북도 전체','제천시','청주시','충주시','괴산군','단양군','보은군','영동군','옥천군','음성군','진천군','청원군']
    ,['충청남도 전체','공주시','보령시','서산시','아산시','천안시','금산군','논산군','당진군','부여군','서천군','연기군','예산군','청양군','태안군','홍성군']
    ,['전라북도 전체','군산시','김제시','남원시','익산시','전주시','정읍시','고창군','무주군','부안군','순창군','완주군','임실군','장수군','진안군']
    ,['전라남도 전체','광양시','나주시','목포시','순천시','여수시','여천시','강진군','고흥군','곡성군','구례군','담양군','무안군','보성군','신안군','여천군','영광군','영암군','완도군','장성군','장흥군','진도군','함평군','해남군','화순군']
    ,['경상북도 전체','경산시','경주시','구미시','김천시','문겅시','상주시','안동시','영주시','영천시','포항시','고령군','군위군','봉화군','성주군','영덕군','영양군','예천군','울릉군','울진군','의성군','청도군','청송군','칠곡군']
    ,['경상남도 전체','거제시','김해시','마산시','밀양시','사천시','울산시','진주시','진해시','창원시','통영시','거창군','고성군','해군','산청군','양산시','의령군','창녕군','하동군','함안군','함양군','합천군']
    ,['제주도 전체', '서귀포시', '제주시']
];
// const searchItems = 

// 검색창 설정 
function selectChange() {
    const add = states.indexOf(selectState.value);
    if (add !== -1) {
        selectCounty.value = `${selectState.value} 전체`; // 시/도 변경 시 구/군 선택 초기화
        counties.value = countyList[add].slice();
    } else {
        console.error('시/도를 찾을 수 없습니다.');
    }
}

const counties = ref(countyList[0].slice()); // 초기 상태로 전체 선택으로 설정

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

// 
// 상태 데이터
const selectedLocation = ref(''); // 선택된 지역
const communityData = ref([]); // 커뮤니티 데이터






onBeforeMount(() => {
    console.log('검색 페이지 비포 마운트');
    store.dispatch('campListGet');
    console.log('서버 요청 보냄');
})

onMounted(() => {
    const resizer = document.querySelector('.resizer');
    resizer.addEventListener('mousedown', startResize);
    window.addEventListener('mouseup', stopResize);
});





</script>

<!-- <style> -->
<style scoped src="../css/search.css">
    /* @import url(../css/search.css); */
</style>