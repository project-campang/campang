<template>
    <main class="main-container">
        <div class="search-container">
            <div class="search-box">
                <form action="">
                    <label for="address"></label>
                    <select name="state" class="address">
                        <option>전체/도</option>
                        <option value="seoul">서울시</option>
                        <option value="busan">부산시</option>
                        <option value="daegu">대구시</option>
                        <option value="incheon">인천시</option>
                        <option value="gwangju">광주시</option>
                        <option value="daejeon">대전시</option>
                        <option value="ulsan">울산시</option>
                        <option value="sejong">세종시</option>
                        <option value="gyeonggi">경기도</option>
                        <option value="gangwon">강원도</option>
                        <option value="chungcheong-b">충청북도</option>
                        <option value="chungcheong-n">충청남도</option>
                        <option value="jeolla-b">전라북도</option>
                        <option value="jeolla-n">전라남도</option>
                        <option value="gyeongsang-b">경상북도</option>
                        <option value="gyeongsang-n">경상남도</option>
                        <option value="jeju">제주도</option>
                    </select>
                    <select name="country" class="address">
                        <option>전체/시/군</option>
                        <option value="country">전체 시/군</option>
                    </select>
                    <button class="search-btn btn-bg-yellow">간편 검색</button>
                    <button type="button" class="search-btn btn-bg-grey btn-detail">상세 검색</button>
                </form>
            </div>
            <div id="accordion-container" class="accordion-container">
                <form action="">
                    <div class="acc-category">
                        <label for="region">지역별</label><br>
                        <input type="checkbox" name="seoul" id="region1">서울시
                        <input type="checkbox" name="busan" id="region2">부산시
                        <input type="checkbox" name="daegu" id="region3">대구시
                        <input type="checkbox" name="incheon" id="region4">인천시
                        <input type="checkbox" name="gwangju" id="region5">광주시
                        <input type="checkbox" name="daejeon" id="region6">대전시
                        <input type="checkbox" name="ulsan" id="region7">울산시
                        <input type="checkbox" name="sejong" id="region8">세종시
                        <input type="checkbox" name="gyeonggi" id="region9">경기도
                        <input type="checkbox" name="gangwon" id="region10">강원도
                        <input type="checkbox" name="chungcheong-b" id="region11">충청북도
                        <input type="checkbox" name="chungcheong-n" id="region12">충청남도
                        <input type="checkbox" name="jeolla-b" id="region13">전라북도
                        <input type="checkbox" name="jeolla-n" id="region14">전라남도
                        <input type="checkbox" name="gyeongsang-b" id="region15">경상북도
                        <input type="checkbox" name="gyeongsang-n" id="region16">경상남도
                        <input type="checkbox" name="jeju" id="region17">제주도
                    </div>
                    <div class="acc-category">
                        <label for="topo">지형/환경</label><br>
                        <input type="checkbox" name="revierside" id="topo1">강변
                        <input type="checkbox" name="valley" id="topo2">계곡
                        <input type="checkbox" name="city" id="topo3">도심
                        <input type="checkbox" name="ocean" id="topo4">바다
                        <input type="checkbox" name="mountain" id="topo5">산
                        <input type="checkbox" name="island" id="topo6">섬
                    </div>
                    <div class="acc-category">
                        <label for="amenities">편의 시설</label><br>
                        <input type="checkbox" name="wash" id="amenities1">개수대
                        <input type="checkbox" name="store" id="amenities2">편의점
                        <input type="checkbox" name="barbecue" id="amenities3">바비큐
                        <input type="checkbox" name="shower-booth" id="amenities4">샤워시설
                        <input type="checkbox" name="heated-water" id="amenities5">온수
                        <input type="checkbox" name="wi-fi" id="amenities6">와이파이
                        <input type="checkbox" name="long-stay" id="amenities7">장기숙박
                        <input type="checkbox" name="electricity" id="amenities8">전기
                        <input type="checkbox" name="rental" id="amenities9">캠핑용품 대여
                        <input type="checkbox" name="restroom" id="amenities10">화장실
                    </div>
                    <div class="acc-category">
                        <label for="amusement">즐길거리</label><br>
                        <input type="checkbox" name="sea-fishing" id="amusement1">바다낚시
                        <input type="checkbox" name="river-fishing" id="amusement2">민물낚시
                        <input type="checkbox" name="pool" id="amusement3">수영장
                        <input type="checkbox" name="karaoke" id="amusement4">노래방
                        <input type="checkbox" name="leisure" id="amusement5">수상레저
                        <input type="checkbox" name="playground" id="amusement6">체육시설(놀이터)
                    </div>
                    <button class="search-btn btn-bg-grey">초기화</button>
                    <button class="search-btn btn-bg-yellow">검색</button>
                </form>
            </div>
            <div class="result">
                <hr>    
                <span>1,000개의 검색 결과</span>
            </div>
            <div class="search-item">
                <div class="item-img">
                    <img class="img" src="/public/img/sample1.jpg" alt="">
                </div>
                <div class="item-info">
                    <span class="item-name">무슨무슨캠핑장</span>
                    <div class="item-info-2">
                        <span class="item-distance">87.2km</span>
                        <span>|</span>
                        <span class="adress-depth">충남  >  보령시  >  청소면</span>
                    </div>
                    <div class="item-info-3">
                        <span class="item-price">₩5000000</span>
                        <span class="item-price-2">1박 기준</span>
                    </div>
                    <div class="item-tel">
                        <span>041-339-8299</span>
                    </div>
                </div>
                <div class="item-detail">
                    <button>자세히</button>
                </div>
            </div>
            <hr>
            <div class="search-item">
                <div class="item-img">
                    <img class="img" src="/public/img/sample1.jpg" alt="">
                </div>
                <div class="item-info">
                    <span class="item-name">무슨무슨캠핑장</span>
                    <div class="item-info-2">
                        <span class="item-distance">87.2km</span>
                        <span>|</span>
                        <span class="adress-depth">충남  >  보령시  >  청소면</span>
                    </div>
                    <div class="item-info-3">
                        <span class="item-price">₩5000000</span>
                        <span class="item-price-2">1박 기준</span>
                    </div>
                    <div class="item-tel">
                        <span>041-339-8299</span>
                    </div>
                </div>
                <div class="item-detail">
                    <button>자세히</button>
                </div>
            </div>
            <hr>
            <div class="search-item">
                <div class="item-img">
                    <img class="img" src="/public/img/sample1.jpg" alt="">
                </div>
                <div class="item-info">
                    <span class="item-name">무슨무슨캠핑장</span>
                    <div class="item-info-2">
                        <span class="item-distance">87.2km</span>
                        <span>|</span>
                        <span class="adress-depth">충남  >  보령시  >  청소면</span>
                    </div>
                    <div class="item-info-3">
                        <span class="item-price">₩5000000</span>
                        <span class="item-price-2">1박 기준</span>
                    </div>
                    <div class="item-tel">
                        <span>041-339-8299</span>
                    </div>
                </div>
                <div class="item-detail">
                    <button>자세히</button>
                </div>
            </div>
            <hr>
        </div>
        <div class="map-container">
            <div class="map">
                <!-- <KakaoMap :lat="coordinate.lat" :lng="coordinate.lng" :draggable="true">
                    <KakaoMapMarker :lat="coordinate.lat" :lng="coordinate.lng"></KakaoMapMarker>
                    <KakaoMapMarker :lat="coordinate1.lat" :lng="coordinate1.lng"></KakaoMapMarker>
                    <KakaoMapMarker :lat="coordinate2.lat" :lng="coordinate2.lng"></KakaoMapMarker>
                    <KakaoMapMarker :lat="coordinate3.lat" :lng="coordinate3.lng"></KakaoMapMarker>
                </KakaoMap> -->
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
// import { KakaoMap, KakaoMapMarker } from 'vue3-kakao-maps';
// import { onMounted } from 'vue';
// import { useStore } from 'vuex';

// const store = useStore();

// const coordinate = {
//   lat: 37.566826,
//   lng: 126.9786567
// };

// const coordinate1 = {
//   lat: 37.5546788,
//   lng: 126.9706069
// };

// const coordinate2 = {
//   lat: 37.5660373,
//   lng: 126.9821930
// };

// const coordinate3 = {
//   lat: 37.5655638,
//   lng: 126.97489
// };

</script>

<style>
@import url(../css/search.css);
</style>