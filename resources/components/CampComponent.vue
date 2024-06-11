<template>
    <!-- <header>
        <div>
            <a href="">캠핑장 모아보기</a>
            <a href="">캠핑 Talk</a>
            <a href="">FAQ</a>
        </div>
        <div>
            <a class="logo">로고</a>
        </div>
        <div>
            <a href="">예매 내역</a>
            <a href="">마이 페이지</a>
            <a href="">로그인 회원가입</a>
        </div>
    </header> -->
    <main>
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
                            <div class="shop-info-line">
                                <div class="info-name">캠핑장 주소</div>
                                <div class="info-text">사랑시 행복구 설렘동 8282-1</div>
                            </div>
                            <div class="shop-info-line">
                                <div class="info-name">문의처</div>
                                <div class="info-text">051-486-8282</div>
                            </div>
                            <div class="shop-info-line">
                                <div class="info-name">유형</div>
                                <div class="info-text">글램핑 / 오토캠핑 / 차박</div>
                            </div>
                            <div class="shop-info-btn-container">
                                <div class="shop-info-btn-item">
                                    <button class="shop-info-btn">
                                        <img src="../../public/img_nr/공유하기.png" alt="공유">
                                    </button>
                                    <div class="shop-info-btn-name">공유하기</div>
                                </div>
                                <div class="shop-info-btn-item">
                                    <button class="shop-info-btn">
                                        <img src="../../public/img_nr/찜하기.png" alt="찜">
                                    </button>
                                    <div class="shop-info-btn-name">찜하기</div>
                                </div>
                                <div class="shop-info-btn-item">
                                    <button class="shop-info-btn">
                                        <img src="../../public/img_nr/예약하기.png" alt="예약">
                                    </button>
                                    <div class="shop-info-btn-name">예약하기</div>
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
                    <div class="info-card-main">
                        <img src="" alt="">
                        <img src="" alt="">
                        <img src="" alt="">
                        <img src="" alt="">
                        <img src="" alt="">
                        <img src="" alt="">
                        <img src="" alt="">
                        <img src="" alt="">
                        <img src="" alt="">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="comment_store">
                    <CommentCreate />
                </div>
                <div class="comment-list">
                    <!-- <div v-for="item in commentInfo" :key="item.comment_id" class="comment-box"> -->
                    <!-- <CommentListItem /> -->
                    <div class="commentItem" v-for="(item, key) in $store.state.commentData" :key="key">
                        <div>{{ item.user_id }}</div>
                        <div>{{ item.created_at }}</div>
                        <div>{{ item.comment }}</div>
                        <button type="button">수정</button>
                        <button type="button">삭제</button>
                    </div>  
                </div>
            </div>
        </div>
    </main>
</template>
    
    
<script setup>
import CommentCreate from './CommentCreate.vue';
// import CommentListItem from './CommentListItem.vue';


import { onBeforeMount } from 'vue';
import store from '../js/store';

  onBeforeMount(() => {
    store.dispatch('commentGet');
  })


</script>

<style>
    @import url(../css/camp.css);
</style>