<template>
    <div class="admin-page">
      <div class="content">
        <div class="header">
          <h2>광고 게시 관리</h2>
        </div>
        <div class="search-section">
          <div class="search-bar">
            <label for="adType">광고 유형:</label>
            <select id="adType" v-model="selectedAdType">
              <option value="0">업소</option>
              <option value="1">브랜드</option>
            </select>
            <button class="btn btn-primary" @click="searchAds">검색</button>
          </div>
        </div>
        <div class="table-section">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>번호</th>
                <th>광고 번호</th>
                <th>{{ selectedAdType === '1' ? '브랜드명' : '사업장명' }}</th>
                <th>광고 기간</th>
                <th>위치</th>
                <th>출력순서</th>
                <th>액션</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, idx) in $store.state.adminAdverTise" :key="idx">
                <td>{{ idx + 1 }}</td>
                <td>{{ item.id }}</td>
                <td>{{ item.title }}</td>
                <td>{{ item.start_date + ' ~ ' + item.end_date }}</td>
                <td>메인</td>
                <td>{{ item.order }}</td>
                <td>
                  <!-- <button class="btn btn-link" @click="toggleAccordion(idx)">
                    상세보기
                  </button> -->
                  <button type="button" class="btn btn-outline-primary btn-sm m-1" @click="openModal(item)">
                    수정
                  </button>
                </td>
              </tr>
              <!-- <tr v-if="isAccordionOpen(idx)" :key="'accordion' + item.id">
                <td colspan="7">
                  <div class="accordion-body">
                    <div class="d-flex">
                      <div v-if="item.img_1">
                        <img :src="item.img_1" alt="이미지 미리보기 1" class="img-thumbnail me-2" style="max-width: 200px;">
                      </div>
                      <div v-if="item.img_2">
                        <img :src="item.img_2" alt="이미지 미리보기 2" class="img-thumbnail me-2" style="max-width: 200px;">
                      </div>
                      <div v-if="item.img_3">
                        <img :src="item.img_3" alt="이미지 미리보기 3" class="img-thumbnail me-2" style="max-width: 200px;">
                      </div>
                    </div>
                  </div>
                </td>
              </tr> -->
            </tbody>
          </table>
        </div>
      </div>
  
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">광고 수정</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form @submit.prevent="submitForm">
                <input type="hidden" v-model="modalData.id">
                <input type="hidden" v-model="modalData.amount">
                <input type="hidden" v-model="modalData.status">
                <div class="mb-3">
                  <label for="advertisementTitle" class="form-label">{{ selectedAdType === '1' ? '브랜드명' : '사업장명' }}</label>
                  <input type="text" class="form-control" id="advertisementTitle" v-model="modalData.title">
                </div>
                <div class="mb-3">
                  <label for="startDate" class="form-label">시작일</label>
                  <input type="date" class="form-control" id="startDate" v-model="modalData.start_date">
                </div>
                <div class="mb-3">
                  <label for="endDate" class="form-label">종료일</label>
                  <input type="date" class="form-control" id="endDate" v-model="modalData.end_date">
                </div>
                <div class="mb-3">
                  <label for="order" class="form-label">출력순서</label>
                  <select class="form-select" id="order" v-model="modalData.order">
                    <option :value="'1'">1</option>
                    <option :value="'2'">2</option>
                    <option :value="'3'">3</option>
                    <option :value="'4'">4</option>
                    <option :value="'5'">5</option>
                  </select>
                </div>
                <p>신청날짜: {{ modalData.updated_at }}</p>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">저장</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onBeforeMount, reactive } from 'vue';
  import { useStore } from 'vuex';
  
  const selectedAdType = ref('0');
  const store = useStore();
  const modalData = reactive({
    id: '',
    title: '',
    start_date: '',
    end_date: '',
    amount: '',
    status: '',
    img_1: '',
    img_2: '',
    img_3: '',
    order: ''
  });
  const openAccordionIndex = ref(null);
  const editedStatus = ref({}); // Track edited status locally
  
  onBeforeMount(async () => {
    await searchAds();
  });
  
  async function searchAds() {
    try {
      await store.dispatch('advertisements', selectedAdType.value);
    } catch (error) {
      console.error('광고를 검색하는 도중 에러 발생:', error);
    }
  }
  
//   function toggleAccordion(idx) {
//     if (openAccordionIndex.value === idx) {
//       openAccordionIndex.value = null;
//     } else {
//       openAccordionIndex.value = idx;
//     }
//   }
  
//   function isAccordionOpen(idx) {
//     return openAccordionIndex.value === idx;
//   }
  
  function openModal(item) {
  // 모달 데이터 초기화
  modalData.id = item.id;
  modalData.title = item.title;
  modalData.start_date = item.start_date;
  modalData.end_date = item.end_date;
  modalData.amount = item.amount;
  modalData.status = item.status;
  modalData.img_1 = item.img_1;
  modalData.img_2 = item.img_2;
  modalData.img_3 = item.img_3;
  modalData.order = item.order;

  $('#exampleModal').modal('show'); // Bootstrap modal show
}
 
function submitForm() {
    const formData = {
      id: modalData.id,
      title: modalData.title,
      start_date: modalData.start_date,
      end_date: modalData.end_date,
      amount: modalData.amount,
      status: modalData.status,
      order: modalData.order,
    };

    store.dispatch('updateAdvertisement', formData)
      .then(() => {
        $('#exampleModal').modal('hide');
        searchAds();
      });
  }

  </script>
  
  <style scoped src="../css/admin.css"></style>
  