<template>
    <main class="main-container-search">
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
                    <button class="search-btn btn-bg-yellow" type="button">간편 검색</button>
                </form>
            </div>
            <div>
                <form action="">
                    <div class="accordion" id="accordionPanelsStayOpenExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
        상세 검색
      </button>
    </h2>
    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
      <div class="accordion-body">
        <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
        Accordion Item #2
      </button>
    </h2>
    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
      <div class="accordion-body">
        <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
        Accordion Item #3
      </button>
    </h2>
    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
      <div class="accordion-body">
        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
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
            <div class="search-item">
                <div class="item-img">
                    <img class="img" src='../../public/img/sample1.jpg' alt="">
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
                    <img class="img" src='../../public/img/sample1.jpg' alt="">
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
                    <img class="img" src='../../public/img/sample1.jpg' alt="">
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

<style scope src="../css/search.css">
/* @import url(../css/search.css); */
</style>