<template>
    <!-- {{$route.params.id}} -->
     {{ $route }}
    <main>
        <div class="background-color">
            <div class="main-head">
                <a href="">HOME</a>
                <p>></p>
                <a href="">캠핑장 모아보기</a>
                <p>></p>
                <a href="">상세정보</a>
            </div>
            <hr>
            <div class="main-body">
                <div class="detail-left">
                    <div class="detail-sticky">
                        <img class="camping-img" src="../../public/img_nr/캠핑장1.png" alt="사진">
                        <div class="detail-info-container">
                            <br>
                            <div class="shop-name-card">
                                <div class="shop-name"></div>
                                <hr>
                                <div class="shop-name-under">산과 강이 보이는 힐링 캠핑장</div>
                            </div>
                            <div class="shop-info-card">
                                <div class="shop-info-text">
                                    <div class="shop-info-line">
                                        <div class="info-name">캠핑장 주소</div>
                                        <div class="info-text">사랑시 고백구 행복동 8282-1</div>
                                    </div>
                                    <div class="shop-info-line">
                                        <div class="info-name">문의처</div>
                                        <div class="info-text">051-486-8282</div>
                                    </div>
                                    <div class="shop-info-line">
                                        <div class="info-name">유형</div>
                                        <div class="info-text">글램핑 / 오토캠핑 / 차박</div>
                                    </div>
                                </div>
                                <div class="shop-info-btn-container">
                                    <div class="shop-info-btn-item">
                                        <button class="btn-group">
                                            <img class="shop-info-btn" src="../../public/img_nr/공유하기.png" alt="공유">
                                            <div class="shop-info-btn-name">공유하기</div>
                                        </button>
                                    </div>
                                    <div class="shop-info-btn-item">
                                        <!-- <button @click="toggleWish" class="btn-group"> -->
                                        <button class="btn-group">
                                            <!-- <img v-if="isWished" class="shop-info-btn" src="../../public/img_nr/찜하기_활성화.png" alt="찜후"> -->
                                            <img class="shop-info-btn" src="../../public/img_nr/찜하기.png" alt="찜전">
                                            <div class="shop-info-btn-name">찜하기</div>
                                        </button>
                                    </div>
                                    <div class="shop-info-btn-item">
                                        <button class="btn-group">
                                            <img class="shop-info-btn" src="../../public/img_nr/예약하기.png" alt="예약">
                                            <div class="shop-info-btn-name">예약하기</div>
                                        </button>
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
                            <div class="info-icon">
                                <img src="../../public/img_nr/산아이콘.png" alt="icon">
                                <p>산</p>
                            </div>
                            <div class="info-icon">
                                <img src="../../public/img_nr/강아이콘.png" alt="icon">
                                <p>강</p>
                            </div>
                        </div>
                    </div>
                    <div class="detail-info-card">
                        <div class="info-card-name">이용시설</div>
                        <div class="info-card-main">
                            <div class="info-icon">
                                <img src="../../public/img_nr/매점아이콘.png" alt="icon">
                                <p>매점</p>
                            </div>
                            <div class="info-icon">
                                <img src="../../public/img_nr/용품대여아이콘.png" alt="icon">
                                <p>용품대여</p>
                            </div>
                            <div class="info-icon">
                                <img src="../../public/img_nr/바베큐아이콘.png" alt="icon">
                                <p>바비큐</p>
                            </div>
                            <div class="info-icon">
                                <img src="../../public/img_nr/화장실아이콘.png" alt="icon">
                                <p>화장실</p>
                            </div>
                            <div class="info-icon">
                                <img src="../../public/img_nr/개수대아이콘.png" alt="icon">
                                <p>개수대</p>
                            </div>
                            <div class="info-icon">
                                <img src="../../public/img_nr/온수아이콘.png" alt="icon">
                                <p>온수</p>
                            </div>
                            <div class="info-icon">
                                <img src="../../public/img_nr/전기아이콘.png" alt="icon">
                                <p>전기</p>
                            </div>
                            <div class="info-icon">
                                <img src="../../public/img_nr/파쇄석아이콘.png" alt="icon">
                                <p>파쇄석</p>
                            </div>
                            <div class="info-icon">
                                <img src="../../public/img_nr/데크바닥아이콘.png" alt="icon">
                                <p>데크</p>
                            </div>
                        </div>
                    </div>
                    <div class="detail-info-card">
                        <div class="info-card-name">사이트 갯수</div>
                        <div class="info-card-main">
                            <div class="site-info">
                                <p>파쇄석(자동차 가능) : 00개</p>
                                <p> | </p>
                                <p>오토캠핑</p>
                            </div>
                        </div>
                    </div>
                    <div class="detail-info-card">
                        <div class="info-card-name">캠핑장 전경</div>
                        <div class="info-card-main camp-img-box">
                            <img v-for="item in 10" :key="item" src="../../public/img/logo-ko3.png" alt="">
                        </div>
                    </div>
                    <hr>
                    <div class="comment-review-tap">
                        <button type="button" class="comment-tap" @click="showCommentTap">댓글</button>
                        <button type="button" class="review-tap" @click="showReviewTap">리뷰</button>
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



</template>
    
    
<script setup>
import CommentCreate from './CommentCreate.vue';
import CommentListItem from './CommentListItem.vue';
import CampReviewTap from './CampReviewTap.vue';
import { ref,onMounted } from 'vue';
import { useStore } from 'vuex';

const store = useStore();

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


// // 찜하기
// const isWished = ref(false);

// const toggleWish = async () => {
//   const camp_id = 1; // 예시로 고정된 캠핑장 ID
//   await store.dispatch('toggleWish', { user_id: store.state.userInfo.id, camp_id });
// };

// // 컴포넌트가 마운트되면 초기 찜 상태 설정
// onMounted(() => {
//   const camp_id = 1; // 예시로 고정된 캠핑장 ID
//   isWished.value = store.state.wish.wishes.some(wish => wish.camp_id === camp_id);
// });

</script>

