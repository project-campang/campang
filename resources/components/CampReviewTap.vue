<template>
<div class="commentItem">
    <hr>
    <div class="review-card-container" v-for="(item, key) in $store.state.reviewTap" :key="key">
        <div class="review-card-box">
            <img :src="item.main_img" alt="">
            <!-- <img src="" alt=""> -->
            <div class="review-text-box">
                <div class="re-first-line">
                    <div class="review-title">{{ item.title }}</div>
                    <div class="rating-box">
                        <div class="rating-item" v-for="i in 5" :key="i" >
                                <img v-if="i<=item.rating" src="../../public/img_nr/별점_활성화.png" alt="">
                                <img v-else src="../../public/img_nr/별점_비활성화.png" alt="">
                        </div>
                    </div>
                    <div class="rating-cnt">({{ item.rating }}.0)</div>
                </div>
                <div class="re-second-line">
                    <p class="review-content">{{ item.content }}</p>
                </div>
                <div class="re-third-line">
                    <div class="flex-left">
                        <div class="review-nick">{{item.nick_name}}</div>
                        <div class="review-at">{{item.created_at}}</div>
                    </div>
                    <button type="button"><img src="../../public/img/상세보기 화살표.png" alt=""></button>
                </div>
            </div>
        </div>
        <hr>
    </div>
</div>
<div class="page-btn">
    <button class="pre-next-btn" type="button" :disabled="$store.state.paginationReview.current_page == 1" @click="prevPage()">< 이전 </button>
    <div class="page-num">{{ $store.state.paginationReview.current_page+'/'+$store.state.paginationReview.last_page }}</div>
    <button class="pre-next-btn" type="button" :disabled="$store.state.paginationReview.current_page == $store.state.paginationReview.last_page" @click="nextPage()"> 다음 > </button>
</div>
</template>

<script setup>
import { onBeforeMount } from 'vue';
import { useStore } from 'vuex';
const store = useStore();

  // 빌드시 리스트 출력
  onBeforeMount(() => {
    store.dispatch('detailReviewTap');
  })

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