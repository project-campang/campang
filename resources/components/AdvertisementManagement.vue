<template>
  <div class="admin-page">
    <div class="content">
      <div class="header">
        <h2>광고 관리</h2>
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
        <div class="summary">
          <span class="advertise-count">총 : {{ totalAdsCount }}개 </span>
          <span class="advertise-count">접수중: {{ getStatusCount('1') }}개 </span>
          <span class="advertise-count">입금대기: {{ getStatusCount('2') }}개 </span>
          <span class="advertise-count">입금완료: {{ getStatusCount('3') }}개 </span>
          <span class="advertise-count">취소: {{ getStatusCount('4') }}개 </span>
          <span class="advertise-count">만료: {{ getStatusCount('5') }}개 </span>
          <span class="advertise-count">환불대기: {{ getStatusCount('6') }}개 </span>
          <span class="advertise-count">환불완료: {{ getStatusCount('7') }}개 </span>
        </div>
      </div>
      <div class="table-section">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>번호</th>
              <th>광고 번호</th>
              <th>{{ selectedAdType === '1' ? '브랜드명' : '사업장명'}}</th>
              <th>광고 기간</th>
              <th>결제(예정)금액</th>
              <th>상태</th>
              <th>관리</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in $store.state.adminAdverTisement" :key="index">
              <td>{{ index + 1 }}</td>
              <td>{{ item.id }}</td>
              <td>{{ item.title }}</td>
              <td>{{ item.start_date + ' ~ ' + item.end_date }}</td>
              <td>{{ formatCurrency(item.amount) }}</td>
              <td>
                {{
                  item.status === '1' ? '접수' : 
                  item.status === '2' ? '입금대기' : 
                  item.status === '3' ? '입금완료' :
                  item.status === '4' ? '취소' :
                  item.status === '5' ? '만료' :
                  item.status === '6' ? '환불대기' : '환불완료'
                }}
              </td>
              <td>
                <button type="button" class="btn btn-primary btn-sm" @click="openModal(item)">
                  수정
                </button>
                <button type="button" class="btn btn-danger btn-sm" @click="confirmCancel(item)">
                  취소
                </button>

              </td>
            </tr>
          </tbody>
        </table>
      </div>
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
            <input type="hidden" v-model="modalData.order">
            <div class="mb-3">
              <label for="advertisementTitle" class="form-label">{{ selectedAdType === '1' ? '브랜드명' : '사업장명'}}</label>
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
              <label for="amount" class="form-label">결제(예정)금액</label>
              <input type="text" class="form-control" id="amount" :value="formatCurrency(modalData.amount)" @input="modalData.amount = parseFloat($event.target.value.replace(/[^0-9.-]/g, '')) || 0">
            </div>
            <div class="mb-3">
              <label for="imageUpload1" class="form-label">이미지 업로드 1</label>
              <input type="file" class="form-control" id="imageUpload1" @change="handleImageUpload(1)">
              <img v-if="modalData.img_1" :src="modalData.img_1" alt="이미지 미리보기 1" class="img-thumbnail mt-2" style="max-width: 200px;">
            </div>

            <div class="mb-3">
              <label for="imageUpload2" class="form-label">이미지 업로드 2</label>
              <input type="file" class="form-control" id="imageUpload2" @change="handleImageUpload(2)">
              <img v-if="modalData.img_2" :src="modalData.img_2" alt="이미지 미리보기 2" class="img-thumbnail mt-2" style="max-width: 200px;">
            </div>

            <div class="mb-3">
              <label for="imageUpload3" class="form-label">이미지 업로드 3</label>
              <input type="file" class="form-control" id="imageUpload3" @change="handleImageUpload(3)">
              <img v-if="modalData.img_3" :src="modalData.img_3" alt="이미지 미리보기 3" class="img-thumbnail mt-2" style="max-width: 200px;">
            </div>
            <div class="mb-3">
              <label for="status" class="form-label">상태</label>
              <select class="form-select" id="status" v-model="modalData.status">
                <option :value="'1'">접수</option>
                <option :value="'2'">입금대기</option>
                <option :value="'3'">입금완료</option>
                <option :value="'4'">취소</option>
                <option :value="'5'">만료</option>
                <option :value="'6'">환불대기</option>
                <option :value="'7'">환불완료</option>
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
</template>

<script setup>
import { ref, onBeforeMount, computed } from 'vue';
import { useStore } from 'vuex';

const selectedAdType = ref('0');
const store = useStore();
const modalData = ref({
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

onBeforeMount(async () => {
  await searchAds();
});

async function searchAds() {
  try {
    await store.dispatch('fetchAdvertisements', selectedAdType.value);
  } catch (error) {
    console.error('광고를 검색하는 도중 에러 발생:', error);
  }
}

function formatCurrency(value) {
  return new Intl.NumberFormat('ko-KR').format(value) + '원';
}

const totalAdsCount = computed(() => {
  return store.state.adminAdverTisement.length;
});

function getStatusCount(status) {
  return store.state.adminAdverTisement.filter(item => item.status === status).length;
}

function openModal(item) {
  modalData.value = { ...item };
  $('#exampleModal').modal('show'); // Bootstrap modal show
}

function handleImageUpload(index) {
  if (event.target && event.target.files.length > 0) {
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onload = () => {
      if (index === 1) {
        modalData.value.img_1 = reader.result;
      } else if (index === 2) {
        modalData.value.img_2 = reader.result;
      } else if (index === 3) {
        modalData.value.img_3 = reader.result;
      }
    };
    reader.readAsDataURL(file);
  } else {
    console.error('파일을 선택해 주세요.');
  }
}

function submitForm() {
  const formData = {
    id: modalData.value.id,
    title: modalData.value.title,
    start_date: modalData.value.start_date,
    end_date: modalData.value.end_date,
    amount: modalData.value.amount,
    status: modalData.value.status,
    img_1: modalData.value.img_1,
    img_2: modalData.value.img_2,
    img_3: modalData.value.img_3,
    order: modalData.value.order
  };

  store.dispatch('updateAdvertisement', formData)
  .then(() => {
    $('#exampleModal').modal('hide');
      searchAds();
    });

}

function confirmCancel(item) {
  if (confirm('광고를 취소하시겠습니까?')) {
    cancelAdvertisement(item.id);
  }
}


function cancelAdvertisement(advertisementId) {
  store.dispatch('cancelAdvertisement', advertisementId)
  .then(() => {
      searchAds();
    });
}

</script>

<style scoped src="../css/admin.css"></style>
