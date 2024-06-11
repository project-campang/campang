<template>
    <main class="main-container">
        <div class="search-container">
            <div class="search-box">
                <form action="">
                    <label for="address"></label>
                    <select name="state" id="address">
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
                    <select name="country" id="address">
                        <option>전체/시/군</option>
                        <option value="country">전체 시/군</option>
                    </select>
                    <button class="search-btn btn-bg-yellow">간편 검색</button>
                    <button type="button" class="search-btn btn-bg-grey btn-detail">상세 검색</button>
                </form>
            </div>
            <div id="accordion-container" class="accordion-container">
                <form action="">
                    <!-- <div class="acc-category">
                        <label for="region">지역별</label>
                        <input type="checkbox" name="seoul" id="region">서울시
                        <input type="checkbox" name="busan" id="region">부산시
                        <input type="checkbox" name="daegu" id="region">대구시
                        <input type="checkbox" name="incheon" id="region">인천시
                        <input type="checkbox" name="gwangju" id="region">광주시
                        <input type="checkbox" name="daejeon" id="region">대전시
                        <input type="checkbox" name="ulsan" id="region">울산시
                        <input type="checkbox" name="sejong" id="region">세종시
                        <input type="checkbox" name="gyeonggi" id="region">경기도
                        <input type="checkbox" name="gangwon" id="region">강원도
                        <input type="checkbox" name="chungcheong-b" id="region">충청북도
                        <input type="checkbox" name="chungcheong-n" id="region">충청남도
                        <input type="checkbox" name="jeolla-b" id="region">전라북도
                        <input type="checkbox" name="jeolla-n" id="region">전라남도
                        <input type="checkbox" name="gyeongsang-b" id="region">경상북도
                        <input type="checkbox" name="gyeongsang-n" id="region">경상남도
                        <input type="checkbox" name="jeju" id="region">제주도
                    </div> -->
                    <div class="acc-category">
                        <label for="topo">지형/환경</label>
                        <input type="checkbox" name="revierside" id="topo">강변
                        <input type="checkbox" name="valley" id="topo">계곡
                        <input type="checkbox" name="city" id="topo">도심
                        <input type="checkbox" name="ocean" id="topo">바다
                        <input type="checkbox" name="mountain" id="topo">산
                        <input type="checkbox" name="island" id="topo">섬
                    </div>
                    <div class="acc-category">
                        <label for="amenities">편의 시설</label>
                        <input type="checkbox" name="wash" id="amenities">개수대
                        <input type="checkbox" name="store" id="amenities">편의점
                        <input type="checkbox" name="barbecue" id="amenities">바비큐
                        <input type="checkbox" name="shower-booth" id="amenities">샤워시설
                        <input type="checkbox" name="heated-water" id="amenities">온수
                        <input type="checkbox" name="wi-fi" id="amenities">와이파이
                        <input type="checkbox" name="long-stay" id="amenities">장기숙박
                        <input type="checkbox" name="electricity" id="amenities">전기
                        <input type="checkbox" name="rental" id="amenities">캠핑용품 대여
                        <input type="checkbox" name="restroom" id="amenities">화장실
                    </div>
                    <div class="acc-category">
                        <label for="amenities">즐길거리</label>
                        <input type="checkbox" name="sea-fishing" id="amenities">바다낚시
                        <input type="checkbox" name="river-fishing" id="amenities">민물낚시
                        <input type="checkbox" name="pool" id="amenities">수영장
                        <input type="checkbox" name="karaoke" id="amenities">노래방
                        <input type="checkbox" name="leisure" id="amenities">수상레저
                        <input type="checkbox" name="playground" id="amenities">체육시설(놀이터)
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
                     <!-- <div class="img"></div> -->
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
                     <!-- <div class="img"></div> -->
                </div>
                <div class="item-info">
                    <span class="item-name">무슨무슨캠핑장</span>
                    <div class="item-info-2">
                        <sapn class="item-distance">87.2km</sapn>
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
                     <!-- <div class="img"></div> -->
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
                <KakaoMap :lat="coordinate.lat" :lng="coordinate.lng" :draggable="true">
                    <KakaoMapMarker :lat="coordinate.lat" :lng="coordinate.lng"></KakaoMapMarker>
                </KakaoMap>
            </div>
            <div class="float-btn">
                <div class="result-pin"></div>
                <div class="wishlist-pin"></div>
                <div class="complete-pin"></div>
            </div>
        </div>
    </main>
</template>

<script setup>
import { KakaoMap, KakaoMapMarker } from 'vue3-kakao-maps';
const coordinate = {
  lat: 37.566826,
  lng: 126.9786567
};
</script>

<style>
@import url(../css/search.css);
</style>