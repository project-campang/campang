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
          <!-- 나라 배너추가 -->
          <button type="button" class="btn btn-danger" @click="openAddModal()">배너추가</button>
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

  <!-- 나라 : 광고 신청 카톡으로 받았을 시 수기로 추가하는 배너추가 모달 주의::: 저장버튼 누르지마세요오오오오오오오오오
  <div class="modal fade" id="optionAddModal" tabindex="-1" aria-labelledby="optionAddModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="optionAddModalLabel">광고 배너추가</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="submitAdForm" id="adForm">
            <input type="hidden" name="user_id" id="user_id" :value="form.user_id">
            <div class="mb-3">
              <div class="btn-group" role="group1">
                  <button type="button" class="btn btn-outline-primary" :class="{ active: form.ad_type === 0 }" @click="form.ad_type = 0">캠핑장</button>
                  <button type="button" class="btn btn-outline-primary" :class="{ active: form.ad_type === 1 }" @click="form.ad_type = 1">캠핑용품</button>
              </div>
            </div>
            <div class="mb-3">
              <label for="advertisementTitle" class="form-label">광고할 상호(용품)명</label>
              <input type="text" class="form-control" id="advertisementTitle" v-model="form.title">
            </div>
            <div class="mb-3">
              <label for="startDate" class="form-label">시작일</label>
              <input type="date" class="form-control" id="startDate" v-model="form.start_date">
            </div>
            <div class="mb-3">
              <label for="endDate" class="form-label">종료일</label>
              <input type="date" class="form-control" id="endDate" v-model="form.end_date">
            </div>
            <div class="mb-3">
              <label for="amount" class="form-label">결제(예정)금액</label>
              <input type="text" class="form-control" id="amount" :value="formatCurrency(form.amount)" @input="form.amount = parseFloat($event.target.value.replace(/[^0-9.-]/g, '')) || 0">
            </div>
            <div class="mb-3">
              <label for="imageUpload1" class="form-label">이미지 업로드 1</label>
              <input type="file" class="form-control" id="imageUpload1" @change="handleImageUploadAdd(1)">
              <img v-if="form.img_1" :src="form.img_1" alt="이미지 미리보기 1" class="img-thumbnail mt-2" style="max-width: 200px;">
            </div>
            <div class="mb-3">
              <label for="status" class="form-label">상태</label>
              <select class="form-select" id="status" v-model="form.status">
                <option :value="'1'">접수</option>
                <option :value="'2'">입금대기</option>
                <option :value="'3'">입금완료</option>
                <option :value="'4'">취소</option>
                <option :value="'5'">만료</option>
                <option :value="'6'">환불대기</option>
                <option :value="'7'">환불완료</option>
              </select>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">저장</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div> -->
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


// 나라 광고배너 추가
function openAddModal() {
  $('#optionAddModal').modal('show'); // Bootstrap modal show
}

// function handleImageUploadAdd(index) {
//   if (event.target && event.target.files.length > 0) {
//     const file = event.target.files[0];
//     const reader = new FileReader();
//     reader.onload = () => {
//       if (index === 1) {
//         form.value.img_1 = reader.result;
//       }
//     };
//     reader.readAsDataURL(file);
//   } else {
//     console.error('파일을 선택해 주세요.');
//   }
// }

// document.addEventListener('DOMContentLoaded', function() {
//     const adStart = document.getElementById('adStart');
//     const adEnd = document.getElementById('adEnd');
//     const adAmount = document.getElementById('adAmount');
//     const adPeriodTotal = document.getElementById('adPeriodTotal');
//     const businessNumber = document.getElementById('businessNumber');
//     const btnGroup = document.querySelectorAll('.btn-group button');

//     // function updateAmount() {
//     //     const startDate = new Date(adStart.value);
//     //     const endDate = new Date(adEnd.value);
//     //     if (isNaN(startDate) || isNaN(endDate)) return; // 날짜가 유효하지 않은 경우 무시

//     //     const diffTime = Math.abs(endDate - startDate);
//     //     const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
//     //     const amount = diffDays * 500000;  // 1일 광고비: 500,000원

//     //     adAmount.value = `₩ ${amount.toLocaleString()}`;
//     //     adPeriodTotal.innerText = `총 ${diffDays}일`;
//     // }

//     adStart.addEventListener('change', updateAmount);
//     adEnd.addEventListener('change', updateAmount);

//     businessNumber.addEventListener('input', function() {
//         if (businessNumber.value.match(/^\d+$/)) {
//             businessNumber.classList.remove('is-invalid');
//             businessNumber.classList.add('is-valid');
//         } else {
//             businessNumber.classList.remove('is-valid');
//             businessNumber.classList.add('is-invalid');
//         }
//     });

//     btnGroup.forEach(btn => {
//         btn.addEventListener('click', function() {
//             btnGroup.forEach(b => b.classList.remove('active'));
//             this.classList.add('active');
//         });
//     });
// });

// const form = ref({
//     user_id: '',
//     title: '',
//     ad_type: 0,
//     start_date: new Date().toISOString().substr(0, 10), // 오늘 날짜로 설정 (YYYY-MM-DD 형식)
//     end_date: new Date(new Date().getTime() + 7 * 24 * 60 * 60 * 1000).toISOString().substr(0, 10), // 오늘로부터 일주일 후의 날짜로 설정 (YYYY-MM-DD 형식)
//     amount: '₩3,500,000',
//     content: '',
//     account: '',
//     img_1: null,
//     agree: false,
//     status: '', 
// });

// const isFormValid = computed(() => {
//   // 필수 필드들이 모두 채워져 있는지 확인
//   return (
//     form.value.title !== '' &&
//     form.value.start_date !== '' &&
//     form.value.end_date !== '' &&
//     form.value.name !== ''

//   );
// });


// const handleFileUpload = (event) => {
//     const file = event.target.files[0]; // 선택된 파일 객체
//     form.value.img_1 = file; // Vue.js 데이터에 파일 객체 저장
// };

// const calculateDays = computed(() => {
//       const startDate = new Date(form.value.start_date);
//       const endDate = new Date(form.value.end_date);
//       const diffTime = Math.abs(endDate - startDate);
//       const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
//       return diffDays;
//     });

// const updateAmount = () => {
//       const diffDays = calculateDays.value;
//       const amount = diffDays * 500000;  // 1일 광고비: 500,000원
//       form.value.amount = `₩${amount.toLocaleString()}`;
//     };
// const submitAdForm = async () => {
//   if (isFormValid.value) {
//     const formData = new FormData();
//     Object.keys(form.value).forEach(key => {
//     formData.append(key, form.value[key]);
//     });
//      // 이미지 파일이 선택되었을 경우에만 FormData에 추가
//      if (form.img_1 instanceof File) {
//         formData.append('img_1', form.img_1);
//     }
//     try {
//         // 서버로 데이터 전송
//         const response = await axios.post('/api/submitAd', formData);

//         // 성공적으로 신청한 경우
//         // 폼 초기화 (Vue 3 Composition API 방식)
//         form.value = {
//             user_id: '',
//             title: '',
//             ad_type: 0,
//             start_date: new Date().toISOString().substr(0, 10), // 오늘 날짜로 설정 (YYYY-MM-DD 형식)
//             end_date: new Date(new Date().getTime() + 7 * 24 * 60 * 60 * 1000).toISOString().substr(0, 10), // 오늘로부터 일주일 후의 날짜로 설정 (YYYY-MM-DD 형식)
//             amount: '₩3,500,000',
//             content: '',
//             account: '',
//             img_1: null,
//             agree: false,
//             status: '',
//         };

//       // 모달 닫기
//       $('#optionAddModal').modal('hide');
//     } catch (error) {
//       console.error('광고신청 실패:', error);
//     }
//   } else {
//     // 필수 입력 필드가 비어 있음을 사용자에게 알림
//     alert('모든 필수 항목을 입력하세요.');
//   }
// };
</script>

<style scoped src="../css/admin.css"></style>
