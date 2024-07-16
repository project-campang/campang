<template>
    <main>
        <div class="background-color">
            <div class="main-head">
                <router-link to="/main">HOME</router-link>
                <p>></p>
                <router-link to="/search">캠핑장 모아보기</router-link>
                <p>></p>
                <a href="#">상세정보</a>
            </div>
            <hr>
            <div class="main-body">
                <div class="detail-left">
                    <div class="detail-sticky">
                        <img class="camping-img" :src="$store.state.campDetail.campInfo.main_img" alt="사진">
                        <div class="detail-info-container">
                            <br>
                            <div class="shop-name-card">
                                <div class="shop-name">{{$store.state.campDetail.campInfo.name}}</div>
                                <hr>
                                <div class="shop-name-under">{{$store.state.campDetail.campInfo.info_text}}</div>
                            </div>
                            <div class="shop-info-card">
                                <div class="shop-info-text">
                                    <div class="shop-info-line">
                                        <div class="info-name">캠핑장 주소</div>
                                        <div class="info-text content-font">
                                            {{$store.state.campDetail.campInfo.state}}
                                            {{$store.state.campDetail.campInfo.county}}
                                            {{$store.state.campDetail.campInfo.address}}
                                        </div>
                                    </div>
                                    <div class="shop-info-line">
                                        <div class="info-name">문의처</div>
                                        <div class="info-text content-font">{{$store.state.campDetail.campInfo.tel}}</div>
                                    </div>
                                    <div class="shop-info-line">
                                        <div class="info-name">유형</div>
                                        <div class="info-text content-font">글램핑 / 오토캠핑 / 차박</div>
                                    </div>
                                </div>
                                <div class="shop-info-btn-container">
                                    <div class="shop-info-btn-item share">
                                        <button @click="shareBtn()" class="btn btn-group">
                                            <img class="shop-info-btn" src="../../public/img_nr/공유하기.png" alt="공유">
                                            <div  class="shop-info-btn-name" id="share-btn">공유하기</div>
                                        </button>
                                        <transition name="shareFade">
                                            <div v-if="showTip" class="shareTip">링크 복사 완료 !<br> 지금 공유 해 보세요.</div>
                                        </transition>
                                    </div>
                                    <div class="shop-info-btn-item">
                                        <!-- <button @click="toggleWish" class="btn-group"> -->
                                        <button @click="toggleWish()" class="btn btn-group">
                                            <img v-if="!$store.state.wishes"  class="shop-info-btn" src="../../public/img_nr/찜하기.png" alt="찜전">
                                            <img v-else class="shop-info-btn" src="../../public/img_nr/찜하기_활성화.png" alt="찜후">
                                            <div class="shop-info-btn-name">찜하기</div>
                                        </button>
                                    </div>
                                    <div class="shop-info-btn-item">
                                        <a @click="gotoLink()" :href="$store.state.campDetail.campInfo.link" class="btn-group">
                                        <!-- <button type="button" @click="openReserveModal" class="btn-group"> -->
                                            <img class="shop-info-btn" src="../../public/img_nr/예약하기.png" alt="예약">
                                            <div class="shop-info-btn-name">예약하기</div>
                                        <!-- </button> -->
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="detail-right">
                    <div class="detail-info-card">
                        <div class="info-card-name">주변환경</div>
                        <div class="info-card-main">
                            <div class="info-icon" v-for="item in $store.state.campDetail.topoInfo" :key="item">
                                <img :src="item.img" alt="icon">
                                <p>{{ item.name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="detail-info-card">
                        <div class="info-card-name">이용시설</div>

                        <div class="info-card-main">
                            <!-- 편의시설 -->
                            <div class="info-icon" v-for="item in $store.state.campDetail.amenityInfo" :key="item">
                                <img :src="item.img" alt="icon">
                                <p>{{ item.name }}</p>
                            </div>
                            <!-- 즐길거리 -->
                            <div class="info-icon" v-for="item in $store.state.campDetail.amusementInfo" :key="item">
                                <img :src="item.img" alt="icon">
                                <p>{{ item.name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="detail-info-card">
                        <div class="info-card-name">사이트 갯수</div>
                        <div class="info-card-main">
                            <div class="site-info">
                                <div class="info-icon" v-for="item in $store.state.campDetail.siteTypeInfo" :key="item">
                                <img :src="item.img" alt="icon">
                                <p>{{ item.name }}</p>
                                <p>{{ item.cnt }}개</p>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="detail-info-card">
                        <div class="info-card-name">캠핑장 전경</div>
                        <div class="info-card-main camp-img-box">
                            <img v-if="$store.state.campDetail.campInfo.other_img_1" :src="$store.state.campDetail.campInfo.other_img_1" alt="">
                            <img v-else src="../../public/img/logo-ko3.png" alt="">
                            <img v-if="$store.state.campDetail.campInfo.other_img_2" :src="$store.state.campDetail.campInfo.other_img_2" alt="">
                            <img v-else src="../../public/img/logo-ko3.png" alt="">
                            <img v-if="$store.state.campDetail.campInfo.other_img_3" :src="$store.state.campDetail.campInfo.other_img_3" alt="">
                            <img v-else src="../../public/img/logo-ko3.png" alt="">
                            <img v-if="$store.state.campDetail.campInfo.other_img_4" :src="$store.state.campDetail.campInfo.other_img_4" alt="">
                            <img v-else src="../../public/img/logo-ko3.png" alt="">
                            <img v-if="$store.state.campDetail.campInfo.other_img_5" :src="$store.state.campDetail.campInfo.other_img_5" alt="">
                            <img v-else src="../../public/img/logo-ko3.png" alt="">
                            <img v-if="$store.state.campDetail.campInfo.other_img_6" :src="$store.state.campDetail.campInfo.other_img_6" alt="">
                            <img v-else src="../../public/img/logo-ko3.png" alt="">
                            <img v-if="$store.state.campDetail.campInfo.other_img_7" :src="$store.state.campDetail.campInfo.other_img_7" alt="">
                            <img v-else src="../../public/img/logo-ko3.png" alt="">
                            <img v-if="$store.state.campDetail.campInfo.other_img_8" :src="$store.state.campDetail.campInfo.other_img_8" alt="">
                            <img v-else src="../../public/img/logo-ko3.png" alt="">
                            <img v-if="$store.state.campDetail.campInfo.other_img_9" :src="$store.state.campDetail.campInfo.other_img_9" alt="">
                            <img v-else src="../../public/img/logo-ko3.png" alt="">
                            <img v-if="$store.state.campDetail.campInfo.other_img_10" :src="$store.state.campDetail.campInfo.other_img_10" alt="">
                            <img v-else src="../../public/img/logo-ko3.png" alt="">
                        </div>
                    </div>
                    <hr>
                    <div class="comment-review-tap">
                        <button type="button" class="btn comment-tap" @click="showCommentTap">댓글</button>
                        <button type="button" class="btn review-tap" @click="showReviewTap">리뷰</button>
                    </div>
                    <div class="tapUI-container">
                        <div class="comment-container" v-if="detailTapUI">
                            <div class="comment_store">
                                <CommentCreate />
                            </div>
                            <div class="comment-list">
                                <CommentListItem />
                            </div>
                        </div>
                        <div class="review-container" v-else>
                                <CampReviewTap />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- 예약하기 모달 -->
    <!-- <transition name="fade">
        <div class="reserve-modal-bg">
            <div class="reserve-modal-area">
                <div class="reserve-modal-top">
                    <div class="reserve-modal-title">예약하기</div>
                    <button type="button" class="reserve-modal-top-x">x</button>
                </div>
                <hr class="reserve-modal-hr">
                <div class="reserve-modal-main">
                    <div class="reserve-modal-main-left">
                        <form>
                            <div class="reserve-name">
                                <label for="reserve-name">예약자 성함</label>
                                <input type="text" name="reserve-name" id="reserve-name" value="TODO" readonly>
                            </div>
                        </form>
                    </div>
                    <div class="reserve-modal-main-right">
                        <div class="reserve-camp-info">
                            <div class="reserve-camp-warning">* 예약한 캠핑장 정보를 확인 해 주세요</div>
                            <div class="reserve-camp-img">
                                <img src="../../public/camp_img/10/10-2.png" alt="TODO">
                            </div>
                            <div class="reserve-camp-text">
                                <div class="reserve-camp-title">TODO</div>
                                <div class="reserve-camp-address">TODO TODO</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="reserve-modal-bottom"></div>
            </div>
        </div>
    </transition> -->

</template>
    
    
<script setup>
import CommentCreate from './CommentCreate.vue';
import CommentListItem from './CommentListItem.vue';
import CampReviewTap from './CampReviewTap.vue';
import { onBeforeMount, reactive, ref,computed, onMounted, watchEffect } from 'vue';
import { useStore } from 'vuex';
import { useRoute } from 'vue-router';

const store = useStore();
const route = useRoute();
const routeParams = useRoute().params;

// 컴포넌트가 생성될 때 액션을 호출하여 데이터를 가져옴
onBeforeMount(() => {
  store.dispatch('campDetailGet', route.params.id);
  store.dispatch('detailImgGet', route.params.id);
});


// ----------------- 댓글 , 리뷰 ----------------------
let detailTapUI = ref(true);

function showCommentTap() {
    detailTapUI.value = true;
    const element = document.querySelector('.comment-review-tap');
    const reviewTap = document.querySelector('.review-tap');
    const commentTap = document.querySelector('.comment-tap');
    reviewTap.removeAttribute('style');
   
    commentTap.style.cssText  = 'background-color: #B3DC9F;';
}

function showReviewTap() {
    detailTapUI.value = false;
    const element = document.querySelector('.comment-review-tap');
    const reviewTap = document.querySelector('.review-tap');
    const commentTap = document.querySelector('.comment-tap');
    
    commentTap.removeAttribute('style');
    reviewTap.style.cssText  = 'background-color: #B3DC9F;';
}
// ---------------------------------------------------


// ------------------ 공유하기 ------------------------
const showTip = ref(false);
const tipStyle = ref({});
const button = ref(null);

const shareBtn = () => {
  const url = `https://127.0.0.1:8000/camp/${route.params.id}`;
  //   console.log(url);
  window.navigator.clipboard.writeText(url).then(() => {
      // alert('링크 복사 완료 ! \n 지금 공유 해보세요!');
      showTip.value = true;
      setTimeout(() => {
        showTip.value = false;
      }, 2000);

  }).catch(err => {
    console.error('클립보드에 복사 실패:', err);
  });
};
// ---------------------------------------------------


//---------------------- 찜하기 -----------------------
// watchEffect(() => {
//   isWished.value = store.state.wishes;
// });

const camp_param_id = route.params.id;

function toggleWish(){
    store.dispatch('detailWishToggle', camp_param_id);
}
// const toggleWish = async () => {
//   const camp_id = 1; // 예시로 고정된 캠핑장 ID
//   await store.dispatch('toggleWish', { user_id: store.state.userInfo.id, camp_id });
// };

// // 컴포넌트가 마운트되면 초기 찜 상태 설정
// onMounted(() => {
// //   const camp_id = 1; // 예시로 고정된 캠핑장 ID
// //   isWished.value = store.state.wish.wishes.some(wish => wish.camp_id === camp_id);

// // const camp_id = route.params.id;
// });
// ---------------------------------------------------


// ------------------- 예약하기 -----------------------
function gotoLink() {
    alert('\n[[캠팡]]은 예약 링크만 제공하며, 서비스는 제공하지 않습니다.\n예약사이트로 이동합니다.');
}
// ---------------------------------------------------

// ------------------- 캠핑장 전경 -------------------
// const imgCarousel = reactive([
//     {img1: store.state.campDetail.campInfo.other_img_1},
//     {img2: store.state.campDetail.campInfo.other_img_2},
//     {img3: store.state.campDetail.campInfo.other_img_3},
//     {img4: store.state.campDetail.campInfo.other_img_4},
//     {img5: store.state.campDetail.campInfo.other_img_5},
//     {img6: store.state.campDetail.campInfo.other_img_6},
//     {img7: store.state.campDetail.campInfo.other_img_7},
//     {img8: store.state.campDetail.campInfo.other_img_8},
//     {img9: store.state.campDetail.campInfo.other_img_9},
//     {img10: store.state.campDetail.campInfo.other_img_10},
// ])

// let imgModalFlg = ref(false);

// function myOpenModal() {
    
// } 
// --------------------------------------------------
</script>

<style>
@import url(../css/camp.css);
/* 모달 페이드 */
.showFade-enter-from, .fade-leave-to {
  /* 시작시 효과 */
  opacity: 0;
}

.showFade-enter-active, .showFade-leave-active {
  /* 전체 단계에서 적용될 부분*/
  transition: opacity 0.5s;
}
</style>