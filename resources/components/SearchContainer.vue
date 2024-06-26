<template>
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
                    <hr>
                    <div>{{ $store.state.campData.length }} 
                        <span>개의 캠핑장 발견!</span></div>
                </div>
                <div class="search-item" @click="markerShow" v-if="searchResult.length === 0" v-for="(item, key) in $store.state.campData" :key="key" >
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
                                <span class="item-price">{{ item.price }}
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
                    <button class="pre-next-btn" type="button" :disabled="$store.state.paginationSearch.current_page == 1" @click="prevPage()">< 이전 </button>
                    <div class="page-num">{{ $store.state.paginationSearch.current_page+'/'+$store.state.paginationSearch.last_page }}</div>
                    <button class="pre-next-btn" type="button" :disabled="$store.state.paginationSearch.current_page == $store.state.paginationSearch.last_page" @click="nextPage()"> 다음 > </button>
                </div>          
            </div>
</template>

<script setup>
    // 페이지네이션
    function prevPage() {
        store.dispatch('detailReviewTap', store.state.paginationReview.current_page-1);
    }

    function nextPage() {
        store.dispatch('detailReviewTap', store.state.paginationReview.current_page+1);
        console.log(store.state.paginationReview.current_page);
    }

</script>

<style>

</style>