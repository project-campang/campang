<template>
    <div class="admin-page">
      <div class="content">
        <div class="header">
          <h2>캠핑장 관리</h2>
        </div>
        <div class="search-section">
          <div class="search-bar">
            <select @change="changeState" name="state" id="select1" class="select" v-model="stateSelete">
                <option :value="0">전체 시/도</option>
                <option :value="item.id"  v-for="(item, key) in $store.state.stateData" :key="key">{{ item.name }}</option>
            </select>
            <select @change="changeCounty" name="county" id="select2" class="select" v-model="countySelete">
                <option :value="0">전체 구/군</option>
                <option :value="item.id" v-for="(item, key) in $store.state.countyData" :key="key">{{ item.name }}</option>
            </select>
            <button class="btn btn-primary" @click="searchBtn">검색</button>
          </div>
          <!-- <div class="summary">
          <span class="advertise-count">총 : 개 </span>
          <span class="advertise-count">접수중: 개 </span>
          <span class="advertise-count">입금대기: 개 </span>
          <span class="advertise-count">입금완료: 개 </span>
          <span class="advertise-count">취소:개 </span>
          <span class="advertise-count">만료: 개 </span>
          <span class="advertise-count">환불대기:개 </span>
          <span class="advertise-count">환불완료:    개 </span>
        </div> -->
        </div>
        <div class="table-section">
            <span>총</span>
                {{ $store.state.campData.total }} 
            <table class="table table-striped">
              <thead>
              <tr>
                <th>번호</th>
                <th>시/도</th>
                <th>군/구</th>
                <th>사업장명</th>
                <th>주소</th>
                <th>등록일</th>
                <th>상태</th>
                <th>관리</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, idx) in $store.state.campData.data" :key="idx">
                <td>{{ idx + 1 }}</td>
                <td>{{ item.state }}</td>
                <td>{{ item.county }}</td>
                <td>{{ item.name}}</td>
                <td>{{ item.address }}</td>
                <td>{{ item.created_at }}</td>
                <td>{{ item.deleted_at === null ? '영업중' : '폐업' }}</td>
                <td>
                  <button type="button" class="btn btn-outline-primary btn-sm m-1" @click="openModal(item)">
                    수정
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
  
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">캠핑장 수정</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="submitForm">
            <input type="hidden" v-model="modalData.id">
            <input type="hidden" v-model="modalData.amount">
            <input type="hidden" v-model="modalData.status">
            <div class="mb-3">
              <label for="campingName" class="form-label">사업장명</label>
              <input type="text" class="form-control" id="campingName" v-model="modalData.name">
            </div>
            <div class="mb-3">
              <label for="campingAddress" class="form-label">주소</label>
              <input type="text" class="form-control" id="campingAddress" v-model="modalData.address">
            </div>
            <div class="mb-3">
              <label for="campingLink" class="form-label">예약링크</label>
              <input type="text" class="form-control" id="campingLink" v-model="modalData.link">
            </div>
            <div class="mb-3">
              <label for="campingPrice" class="form-label">금액</label>
              <input type="text" class="form-control" id="campingPrice" v-model="modalData.price">
            </div>
            <div class="mb-3">
              <label for="campingTel" class="form-label">전화번호</label>
              <input type="text" class="form-control" id="campingTel" v-model="modalData.tel">
            </div>
            <div class="mb-3">
              <label for="campingStatus" class="form-label">상태</label>
              <select class="form-select" id="campingStatus" v-model="modalData.deleted_at">
                <option :value="null">영업중</option>
                <option :value="new Date().toISOString()">폐업</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="mainImg" class="form-label">대표 이미지</label>
              <input type="file" class="form-control" id="mainImg" accept="image/*" @change="handleMainImgChange">
              <div v-if="modalData.main_img">
                <img :src="modalData.main_img" alt="대표 이미지" style="max-width: 100%; max-height: 300px; margin-top: 10px;">
              </div>
            </div>
            <div class="mb-3">
              <label for="otherImg2" class="form-label">추가 이미지 2</label>
              <input type="file" class="form-control" id="otherImg2" accept="image/*" @change="handleOtherImgChange(2)">
              <div v-if="modalData.other_img_2">
                <img :src="modalData.other_img_2" alt="추가 이미지 2" style="max-width: 100%; max-height: 300px; margin-top: 10px;">
              </div>
            </div>
            <div class="mb-3">
              <label for="otherImg3" class="form-label">추가 이미지 3</label>
              <input type="file" class="form-control" id="otherImg3" accept="image/*" @change="handleOtherImgChange(3)">
              <div v-if="modalData.other_img_3">
                <img :src="modalData.other_img_3" alt="추가 이미지 3" style="max-width: 100%; max-height: 300px; margin-top: 10px;">
              </div>
            </div>
            <div class="mb-3">
              <label for="otherImg4" class="form-label">추가 이미지 4</label>
              <input type="file" class="form-control" id="otherImg4" accept="image/*" @change="handleOtherImgChange(4)">
              <div v-if="modalData.other_img_4">
                <img :src="modalData.other_img_4" alt="추가 이미지 4" style="max-width: 100%; max-height: 300px; margin-top: 10px;">
              </div>
            </div>
            <div class="mb-3">
              <label for="otherImg5" class="form-label">추가 이미지 5</label>
              <input type="file" class="form-control" id="otherImg5" accept="image/*" @change="handleOtherImgChange(5)">
              <div v-if="modalData.other_img_5">
                <img :src="modalData.other_img_5" alt="추가 이미지 5" style="max-width: 100%; max-height: 300px; margin-top: 10px;">
              </div>
            </div>
            <div class="mb-3">
              <label for="otherImg6" class="form-label">추가 이미지 6</label>
              <input type="file" class="form-control" id="otherImg6" accept="image/*" @change="handleOtherImgChange(6)">
              <div v-if="modalData.other_img_6">
                <img :src="modalData.other_img_6" alt="추가 이미지 6" style="max-width: 100%; max-height: 300px; margin-top: 10px;">
              </div>
            </div>
            <p>등록일: {{ modalData.created_at }}</p>
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
  import { ref, onBeforeMount, reactive, onMounted } from 'vue';
  import { useStore } from 'vuex';
  
  // 시군구 선택
  const stateSelete = ref('0');
  const countySelete = ref('0');
  
  function changeState() {
    console.log('메인 시군구 선택', stateSelete.value);
    store.dispatch('countyGet', stateSelete.value);
  }
  
  onBeforeMount(() => {
    // 시군구 정보
    if (store.state.stateData.length < 1) {
      store.dispatch('stateGet');
    }
    if (store.state.campData.length < 1) {
      store.dispatch('searchResult');
    }
  });
  
// 모달이 열릴 때 초기화 함수
onMounted(() => {
  // 모달 데이터 초기화 로직
  resetModalData();
});

function resetModalData() {
  modalData.id = '';
  modalData.name = '';
  modalData.address = '';
  modalData.link = '';
  modalData.price = '';
  modalData.tel = '';
  modalData.deleted_at = null;
  modalData.created_at = '';
}
  function searchBtn() {
    console.log('선택된 값:', stateSelete.value, countySelete.value);
  
    store.commit('setLocalInfo', {
      state: stateSelete.value, // 선택된 시/도 값
      county: countySelete.value, // 선택된 구/군 값
      page: 1,
    });
    store.dispatch('searchResult');
  
    router.push('/search');
  }
  const store = useStore();

  const modalData = ref({
  id: '',
  name: '',
  address: '',
  link: '',
  price: '',
  tel: '',
  deleted_at: null,
  created_at: '',
  main_img: '',
  other_img_2: '',
  other_img_3: '',
  other_img_4: '',
  other_img_5: '',
  other_img_6: '',
});
  
 
  
function openModal(item) {
  resetModalData();
  modalData.value.id = item.id;
  modalData.value.name = item.name;
  modalData.value.address = item.address;
  modalData.value.link = item.link;
  modalData.value.price = item.price;
  modalData.value.tel = item.tel;
  modalData.value.deleted_at = item.deleted_at ? new Date(item.deleted_at).toISOString().slice(0, 19) : null;
  modalData.value.created_at = item.created_at;
  modalData.value.main_img = item.main_img;
  modalData.value.other_img_2 = item.other_img_2;
  modalData.value.other_img_3 = item.other_img_3;
  modalData.value.other_img_4 = item.other_img_4;
  modalData.value.other_img_5 = item.other_img_5;
  modalData.value.other_img_6 = item.other_img_6;

  $('#exampleModal').modal('show'); // Bootstrap modal show
}

async function submitForm() {
  const formData = new FormData();
  formData.append('id', modalData.value.id);
  formData.append('name', modalData.value.name);
  formData.append('address', modalData.value.address);
  formData.append('link', modalData.value.link);
  formData.append('price', modalData.value.price);
  formData.append('tel', modalData.value.tel);
  formData.append('deleted_at', modalData.value.deleted_at);

  // 이미지 파일들 추가
  if (modalData.value.main_img) {
    formData.append('main_img', modalData.value.main_img);
  }
  if (modalData.value.other_img_2) {
    formData.append('other_img_2', modalData.value.other_img_2);
  }
  if (modalData.value.other_img_3) {
    formData.append('other_img_3', modalData.value.other_img_3);
  }
  if (modalData.value.other_img_4) {
    formData.append('other_img_4', modalData.value.other_img_4);
  }
  if (modalData.value.other_img_5) {
    formData.append('other_img_5', modalData.value.other_img_5);
  }
  if (modalData.value.other_img_6) {
    formData.append('other_img_6', modalData.value.other_img_6);
  }

  try {
    await store.dispatch('updateCamp', formData);
    $('#exampleModal').modal('hide');
    store.dispatch('searchResult');
  } catch (error) {
    console.error('캠핑장 업데이트 실패:', error);
    // 오류 처리
  }
}

function handleMainImgChange(event) {
  const file = event.target.files[0];
  if (file) {
    modalData.value.main_img = file;
  }
}

function handleOtherImgChange(number) {
  const file = event.target.files[0];
  if (file) {
    modalData.value[`other_img_${number}`] = file;
  }
}
  
  </script>
  
  
  <style scoped src="../css/admin.css"></style>
  