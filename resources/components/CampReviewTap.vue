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
                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" :value="item.id"><img src="../../public/img/상세보기 화살표.png" alt=""></button>
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

<!-- 모달 -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

</template>

<script setup>
import { onBeforeMount, reactive } from 'vue';
import { useStore } from 'vuex';
const store = useStore();

let detailData = reactive({});

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