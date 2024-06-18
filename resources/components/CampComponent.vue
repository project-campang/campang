<template>
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
                                <div class="shop-name">자연 휴양림 오토캠핑장</div>
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
                                        <button class="btn-group">
                                            <img class="shop-info-btn" src="../../public/img_nr/찜하기.png" alt="찜">
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
                            <div class="commentItem">
                                <div class="review-card-box">
                                    <img src="../../public/images/캠핑장1.png" alt="">
                                    <div class="review-text-box">
                                        <div class="re-first-line">
                                            <div class="review-title">이 캠핑장은 너무 좋아요 대박 킹왕짱 쩐다쩔어</div>
                                            <div class="rating-box">
                                                <div class="rating-item" v-for="i in 5" :key="i" >
                                                    <img src="../../public/img_nr/별점_활성화.png" alt="">
                                                </div>
                                            </div>
                                            <div class="rating-cnt">(5.0)</div>
                                        </div>
                                        <div class="re-second-line">
                                            <p class="review-content">
                                                끓는 방황하여도, 그들의 밥을 힘차게 원대하고, 가치를 같이, 것이다. 전인 방황하였으며, 열락의 생생하며, 하여도 사막이다. 사랑의 풍부하게 천고에 어디 만물은 피는 그러므로 소금이라 있다.
                                            </p>
                                        </div>
                                        <div class="re-third-line">
                                            <div class="flex-left">
                                                <div class="review-nick">닉네임</div>
                                                <div class="review-at">2024.06.11 00:00:00</div>
                                            </div>
                                            <div class="review-arrow">보러가기 →</div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="page-btn">
                                <button class="pre-next-btn" type="button" :disabled="$store.state.pagination.current_page == 1" @click="prevPage()">< 이전 </button>
                                <button class="pre-next-btn" type="button" :disabled="$store.state.pagination.current_page == $store.state.pagination.last_page" @click="nextPage()"> 다음 > </button>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<!-- 상세 모달 -->
    <!-- <div v-if="modalFlg" class="board-detail-box">
        <div class="item">
            <img :src="boardData.img">
            <hr>
            <p>{{ boardData.content }}</p>
            <hr>
            <div class="etc-box">
                <span>작성자 : {{ boardData.name }}</span>
                <button @click="modalFlg = false" class="btn btn-close btn-bg-black" >닫기</button>
            </div>
        </div>
    </div> -->

</template>
    
    
<script setup>
import CommentCreate from './CommentCreate.vue';
import CommentListItem from './CommentListItem.vue';
import { ref } from 'vue';

let detailTapUI = ref(true);

function showCommentTap() {
    detailTapUI.value = true;
    const element = document.querySelector('.comment-review-tap');

    // element.style.cssText  = 'border: 5px solid #FFAF66;';
}

function showReviewTap() {
    detailTapUI.value = false;
    const element = document.querySelector('.comment-review-tap');
    // const elementLeft = document.querySelector('.main-rank-btn-left');

    // element.style.cssText  = 'border: 5px solid #FFF3DD;';
    // elementLeft.style.cssText  = 'text-decoration:none;';
}
</script>

