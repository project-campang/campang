<template>
<div class="commentItem">
    <hr>
    <div class="review-card-container" v-for="(item, key) in $store.state.reviewTap" :key="key">
        <div class="review-card-box">
            <img :src="item.main_img" alt="">
            <!-- <img src="" alt=""> -->
            <div class="review-text-box">
                <div class="re-first-line">
                    <div class="nr_review-title">{{ item.title }}</div>
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
                    <button @click="openDetailModal(item)" type="button"><img src="../../public/img/상세보기 화살표.png" alt=""></button>
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

<!-- 상세 모달 -->
<div v-show="modalFlg" class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">상세</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="">
                <div class="modal-body detail-data">
                        <div class="detail-modal-title" id="detail-modal-title">{{ detailReviewItem.title }}</div>
                        <div class="detail-modal-content" id="detail-modal-content">{{ detailReviewItem.content }}</div>
                    <div class="img-box">
                        <img :src="detailReviewItem.main_img" alt="">
                        <!-- <img src="/img/sample1.jpg" alt="">s -->
                    </div>
                </div>
                <div class="modal-footer">
                    <div>
                    <button type="button" class="btn btn-outline-warning start-0">수정</button>
                    <button type="button" class="btn btn-outline-danger">삭제</button>
                </div>
                <div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>

</template>

<script setup>
import { onBeforeMount, onMounted, ref, reactive } from 'vue';
import { useStore } from 'vuex';
const store = useStore();

// 모달
// 모달 플래그
const modalFlg = ref(false);

let detailModal;
let detailReviewItem = reactive({});

  // 빌드시 리스트 출력
  onBeforeMount(() => {
    store.dispatch('detailReviewTap');
  })

  onMounted(async () => {
    // 상세 모달 초기화
    const detailModalElement = document.getElementById('detailModal');
    if (detailModalElement) {
        try {
            const { Modal } = await import('bootstrap');
            detailModal = new Modal(detailModalElement);

        } catch (err) {
            console.error('Bootstrap Modal import error:', err);
        }
    }
})

// 상세 모달 열기
function openDetailModal(data) {
  if(detailModal) {
    modalFlg.value = true;
    detailModal.show();
    detailReviewItem.title = data.title;
    detailReviewItem.content = data.content;
    detailReviewItem.main_img = data.main_img;
    detailReviewItem.views = data.views;
    console.log('조회수 = ', detailReviewItem.views);
  }        
}

// 모달 닫기
function closeModal(){
    modalFlg.value = false;
}





// 페이지 이동 버튼 ---------------------------------------
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