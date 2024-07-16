<template>
  <main class="main-container-community">
    <!-- Sidebar -->
    <div class="sidebar-container">
      <div class="sidebar-box">
        <div class="page-title">
          <div>캠핑 Talk</div>
        </div>
        <div class="board-name-list">
          <div class="board-name">
            <div :class="{ 'active': route.params.id === '1' }">
              <router-link :to="`/community/1`" class="list-item" :class="{ active: isActive('/community/1') }">자유 게시판</router-link>
            </div>
            <div :class="{ 'active': route.params.id === '3' }">
              <router-link :to="`/community/3`" class="list-item" :class="{ active: isActive('/community/3') }">가입 인사</router-link>
            </div>
            <div :class="{ 'active': route.params.id === '4' }">
              <router-link :to="`/community/4`" class="list-item" :class="{ active: isActive('/community/4') }">캠핑 꿀팁</router-link>
            </div>
            <div :class="{ 'active': route.params.id === '2' }">
              <router-link :to="`/community/2`" class="list-item" :class="{ active: isActive('/community/2') }">리뷰 게시판</router-link>
            </div>
            <div :class="{ 'active': route.params.id === '5' }">
              <!-- <router-link :to="`/community/5`" class="list-item" :class="{ active: isActive('/community/5') }">랭킹 게시판</router-link> -->
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Content -->
    <div class="content-container">
      <div class="content-top">
        <nav class="content-top-2">
          <div class="content-head">
            <div>
              <h1>{{ getCommunityTypeName(route.params.id) }}</h1>
            </div>
            <div class="board-comment">
              <button @click="openInsertModal" class="btn btn-outline-success add-community">작성하기</button>
            </div>
          </div>
        </nav>
      </div>
      <div class="content-btm">
        <div class="content-box">
          <div class="list-group">
            <div class="content-column2">
              <div class="item-title-box">글 번호</div>
              <div class="title-text-align item-title-box">글 제목</div>
              <div class="item-title-box">작성자</div>
              <div class="item-title-box">작성일</div>
              <div class="item-title-box">조회수</div>
              <div class="item-title-box"></div>
            </div>
            <div @click="goToDetail(item.id)" class="content-item" v-for="(item, index) in $store.state.communityData" :key="index">
              <div class="item-box">{{ index + 1 }}</div>
              <div class="title-text-align item-box">{{ item.title }}<span v-if="isNewPost(item.created_at)" class="new-post-badge">N</span></div>
              <div class="item-box">{{ item.nick_name }}</div>
              <div class="item-box">{{ getFormattedDate(item.created_at) }}</div>
              <div class="item-box">{{ item.views }}</div>
              <div class="d-flex flex-end align-items-center justify-content-center">
                <div class="btn-container" v-if="isAuthor(item.user_id)">
                  <button type="button" class="btn btn-outline-warning" @click.stop="updatePost(item)">수정</button>
                  <button type="button" class="btn btn-outline-danger" @click.stop="deletePost(item.id)">삭제</button>
                </div>
              </div>
            </div>
          </div>
          <div class="pagination">
            <button class="pre-next-btn" type="button" :disabled="$store.state.paginationCommunity.current_page == 1" @click="prevPage()"> < 이전ㅤ</button>
            <div class="page-num">{{ $store.state.paginationCommunity.current_page + 'ㅤ/ㅤ' + $store.state.paginationCommunity.last_page }}</div>
            <button class="pre-next-btn" type="button" :disabled="$store.state.paginationCommunity.current_page == $store.state.paginationCommunity.last_page" @click="nextPage()"> ㅤ다음 ></button>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- 작성 모달 -->
  <div v-show="modalFlg" class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">작성하기</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="insertForm" enctype="multipart/form-data">
          <div v-if="isCommunity2">
            리뷰를 남길 캠핑장은?
            <div>
              <!-- 드롭다운 메뉴 -->
              <select v-model="selectedCamp" @change="updateCampId" name="camp_id">
                <option v-for="(item, key) in $store.state.stampCampingzang" :key="key" :value="item.camp_id">{{ item.camp_name }}</option>
              </select>
            </div>
          </div>
          <div v-if="isCommunity2">
            해당 캠핑장의 별점은?
            <div class="counter">
              <button class="button" type="button" @click="decrease">-</button>
              <input type="number" class="display" :value="count" readonly name="rating" />
              <button class="button" type="button" @click="increase">+</button>
          </div>
          </div>
          <input type="hidden" name="community-type" id="community-type" :value="route.params.id" />
          <!-- <input type="hidden" name="camp_id" :value="campId" /> -->
          <div class="modal-body">
            <input class="title-input" type="text" name="title" placeholder="제목을 적어주세요." />
            <textarea name="content" placeholder="내용을 적어주세요." maxlength="200"></textarea>
          </div>
          <div class="modal-body">
              <!-- Main Image -->
              <!-- Additional Images -->
              <div class="mb-3">
              <label for="main_img" class="form-label">메인 이미지</label>
              <input type="file" class="form-control" id="main_img" accept="image/*" @change="handleImgUpload('main_img')">
              <img v-if="mainImgPreview" :src="mainImgPreview" alt="Main Image" style="width: 200px; margin-top: 10px;">
              
            </div>
            <div class="mb-3">
              <label for="other_img2" class="form-label">이미지 2</label>
              <input type="file" class="form-control" name="other_img2" id="other_img2"  accept="image/*" @change="handleImgUpload('other_img2')">
              <img v-if="otherImg2Preview" :src="otherImg2Preview" alt="Other Image 2" style="width: 200px; margin-top: 10px;">
              
            </div>
            <div class="mb-3">
              <label for="other_img3" class="form-label">이미지 3</label>
              <input type="file" class="form-control"  name="other_img3" id="other_img3"  accept="image/*" @change="handleImgUpload('other_img3')">
              <img v-if="otherImg3Preview" :src="otherImg3Preview" alt="Other Image 3" style="width: 200px; margin-top: 10px;">
              
            </div>
            <div class="mb-3">
              <label for="other_img4" class="form-label">이미지 4</label>
              <input type="file" class="form-control" id="other_img4"  name="other_img4" accept="image/*" @change="handleImgUpload('other_img4')">
              <img v-if="otherImg4Preview" :src="otherImg4Preview" alt="Other Image 4" style="width: 200px; margin-top: 10px;">
              
            </div>
            <div class="mb-3">
              <label for="other_img5" class="form-label">이미지 5</label>
              <input type="file" class="form-control" id="other_img5"  name="other_img5" accept="image/*" @change="handleImgUpload('other_img5')">
              <img v-if="otherImg5Preview" :src="otherImg5Preview" alt="Other Image 5" style="width: 200px; margin-top: 10px;">
              
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
            <button @click="communityEvent" type="button" class="btn btn-primary">작성</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- 수정 모달 -->
  <div v-show="modalFlg" class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <!-- <h5 class="modal-title">
            <input class="detail-modal-title-update" id="detail-modal-title" v-model="selectedContent.title" />
          </h5> -->
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form @submit.prevent="submitUpdate">
          <div class="mb-3">
              <input type="hidden" id="id" v-model="selectedContent.id">
              <label for="title" class="form-label form-label-title">제목</label>
              <input type="text" class="form-control form-label-title" id="title" v-model="selectedContent.title">
            </div>
            <div class="mb-3">
              <label for="content" class="form-label form-label-title">내용</label>
              <textarea class="form-control my-update-form" id="content" v-model="selectedContent.content" rows="5"></textarea>
            </div>
            <div class="mb-3">
              <label for="main_img" class="form-label">메인 이미지</label>
              <input type="file" class="form-control" id="main_img" accept="image/*" @change="handleImgUpload('main_img')">
              <img v-if="mainImgPreview" :src="mainImgPreview" alt="Main Image" style="width: 200px; margin-top: 10px;">
              <img v-else-if="selectedContent.main_img" :src="selectedContent.main_img" alt="Main Image" style="width: 200px; margin-top: 10px;">
            </div>
            <div class="mb-3">
              <label for="other_img2" class="form-label">이미지 2</label>
              <input type="file" class="form-control" id="other_img2"  accept="image/*" @change="handleImgUpload('other_img2')">
              <img v-if="otherImg2Preview" :src="otherImg2Preview" alt="Other Image 2" style="width: 200px; margin-top: 10px;">
              <img v-else-if="selectedContent.other_img2" :src="selectedContent.other_img2" alt="Other Image 2" style="width: 200px; margin-top: 10px;">
            </div>
            <div class="mb-3">
              <label for="other_img3" class="form-label">이미지 3</label>
              <input type="file" class="form-control" id="other_img3"  accept="image/*" @change="handleImgUpload('other_img3')">
              <img v-if="otherImg3Preview" :src="otherImg3Preview" alt="Other Image 3" style="width: 200px; margin-top: 10px;">
              <img v-else-if="selectedContent.other_img3" :src="selectedContent.other_img3" alt="Other Image 3" style="width: 200px; margin-top: 10px;">
            </div>
            <div class="mb-3">
              <label for="other_img4" class="form-label">이미지 4</label>
              <input type="file" class="form-control" id="other_img4"  accept="image/*" @change="handleImgUpload('other_img4')">
              <img v-if="otherImg4Preview" :src="otherImg4Preview" alt="Other Image 4" style="width: 200px; margin-top: 10px;">
              <img v-else-if="selectedContent.other_img4" :src="selectedContent.other_img4" alt="Other Image 4" style="width: 200px; margin-top: 10px;">
            </div>
            <div class="mb-3">
              <label for="other_img5" class="form-label">이미지 5</label>
              <input type="file" class="form-control" id="other_img5"  accept="image/*" @change="handleImgUpload('other_img5')">
              <img v-if="otherImg5Preview" :src="otherImg5Preview" alt="Other Image 5" style="width: 200px; margin-top: 10px;">
              <img v-else-if="selectedContent.other_img5" :src="selectedContent.other_img5" alt="Other Image 5" style="width: 200px; margin-top: 10px;">
            </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
          <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">수정완료</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onBeforeMount, onMounted, ref, reactive, watch, computed } from 'vue';
import { useStore } from 'vuex';
import { useRoute, useRouter } from 'vue-router';
import dayjs from 'dayjs'; // 날짜 비교를 위해 dayjs 라이브러리를 사용

const store = useStore();
const route = useRoute();
const isLoggedIn = ref(false);
const router = useRouter();
const stampCampingzang = ref([]);
const selectedCamp = ref('');
const camp_id = ref('');



function isActive(path) {
  return route.path === path;
}

const selectedContent = reactive({
  id: null,
  title: '',
  content: '',
  main_img: null,
  other_img2: null,
  other_img3: null,
  other_img4: null,
  other_img5: null,
});


const mainImgPreview = ref('');
const otherImg2Preview = ref('');
const otherImg3Preview = ref('');
const otherImg4Preview = ref('');
const otherImg5Preview = ref('');


const handleImgUpload = (fieldName) => {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = () => {
      switch (fieldName) {
        case 'main_img':
          mainImgPreview.value = reader.result;
          selectedContent.main_img = file;
          break;
        case 'other_img2':
          otherImg2Preview.value = reader.result;
          selectedContent.other_img2 = file;
          break;
        case 'other_img3':
          otherImg3Preview.value = reader.result;
          selectedContent.other_img3 = file;
          break;
        case 'other_img4':
          otherImg4Preview.value = reader.result;
          selectedContent.other_img4 = file;
          break;
        case 'other_img5':
          otherImg5Preview.value = reader.result;
          selectedContent.other_img5 = file;
          break;
        default:
          break;
      }
      updateFormData(fieldName, file);
    };
    reader.readAsDataURL(file);
  }
};


// FormData에 파일을 추가하는 함수 정의
const updateFormData = (fieldName, file) => {
  formData.set(fieldName, file); // fieldName에 따라 동적으로 설정
};

const updateCampId = () => {
  formData.append('camp_id', selectedCamp.value);
};

let updateModal;
// const selectedContent = reactive({
//   id: '',
//   title: '',
//   content: '',
// });

// 로그인된 사용자의 ID를 가져옴
const userId = store.state.userInfo ? store.state.userInfo.id : null;

watch(
  () => route.params.id,
  async newId => {
    if (newId) {
      await store.dispatch('communityGet', { id: newId });
    } else {
      console.error('새로운 라우트 id가 정의되지 않았습니다.');
    }
  }
);

function isNewPost(dateTime) {
  const postDate = dayjs(dateTime);
  const currentDate = dayjs();
  return currentDate.diff(postDate, 'day') <= 1;
}

const boardType = store.state.communityTypes;
const modalFlg = ref(false);
let insertModal;
let detailModal;
let communityItem = reactive({});
const preview = ref('');

function getFormattedDate(dateTime) {
  return dateTime.split(' ')[0]; // 공백을 기준으로 나눠서 첫 번째 부분만 반환
}

function checkLoginStatus() {
  isLoggedIn.value = Boolean(store.state.authFlg);
}


function communityEvent() {
  const id = route.params.id;
  store.dispatch('communityInsert', id);
  modalFlg.value = false;
  window.location.reload();
  
}

// function setFile(e) {
//   communityItem.main_img = e.target.files[0];
//   preview.value = URL.createObjectURL(communityItem.main_img);
// }

function prevPage() {
  const currentPage = store.state.paginationCommunity.current_page;
  if (currentPage > 1) {
    store.dispatch('communityGet', { id: route.params.id, page: currentPage - 1 });
  }
}

function nextPage() {
  const currentPage = store.state.paginationCommunity.current_page;
  const lastPage = store.state.paginationCommunity.last_page;
  if (currentPage < lastPage) {
    store.dispatch('communityGet', { id: route.params.id, page: currentPage + 1 });
  }
}

onBeforeMount(async () => {
  const id = route.params.id;
  if (id) {
    await store.dispatch('communityGet', { id });
  } else {
    console.error('라우트 id가 정의되지 않았습니다.');
  }

  if(store.state.stampCampingzang.length < 1 ) {
    store.dispatch('setStampCampingzang');
    stampCampingzang.value = store.state.stampCampingzang;
  }

});

onMounted(async () => {
  const id = route.params.id;
  store.dispatch('communityGet', { id });
});

onMounted(async () => {
  const insertModalElement = document.getElementById('insertModal');
  if (insertModalElement) {
    try {
      const { Modal } = await import('bootstrap');
      insertModal = new Modal(insertModalElement);
    } catch (err) {
      console.error('Bootstrap Modal import error:', err);
    }
  }
  const detailModalElement = document.getElementById('detailModal');
  if (detailModalElement) {
    try {
      const { Modal } = await import('bootstrap');
      detailModal = new Modal(detailModalElement);
    } catch (err) {
      console.error('Bootstrap Modal import error:', err);
    }
  }
  const updateModalElement = document.getElementById('updateModal');
  if (updateModalElement) {
    try {
      const { Modal } = await import('bootstrap');
      updateModal = new Modal(updateModalElement);
    } catch (err) {
      console.error('Bootstrap Modal import error:', err);
    }
  }
});

function openInsertModal() {
  checkLoginStatus();
  if (!isLoggedIn.value) {
    alert('로그인이 필요합니다.');
    return;
  } else if (insertModal) {
    modalFlg.value = true;
    insertModal.show();
  }
}

// function openDetailModal(data) {
//   if (detailModal) {
//     modalFlg.value = true;
//     detailModal.show();
//     communityItem.nick_name = data.nick_name;
//     communityItem.title = data.title;
//     communityItem.content = data.content;
//     communityItem.main_img = data.main_img;
//     communityItem.views = data.views;
//     communityItem.type = data.type;
//   }
// }

function getCommunityTypeName(id) {
  return boardType[id]?.name || 'Unknown Board';
}

function isAuthor(postUserId) {
  return postUserId === userId;
}

function updatePost(item) {
  selectedContent.id = item.id;
  selectedContent.title = item.title;
  selectedContent.content = item.content;
  selectedContent.main_img = item.main_img;
  selectedContent.other_img2 = item.other_img2;
  selectedContent.other_img3 = item.other_img3;
  selectedContent.other_img4 = item.other_img4;
  selectedContent.other_img5 = item.other_img5;

  // 기존 미리보기 이미지를 초기화
  mainImgPreview.value = '';
  otherImg2Preview.value = '';
  otherImg3Preview.value = '';
  otherImg4Preview.value = '';
  otherImg5Preview.value = '';

  // 새로운 이미지가 설정되었을 경우 미리보기 이미지 업데이트
  if (item.main_img) mainImgPreview.value = item.main_img;
  if (item.other_img2) otherImg2Preview.value = item.other_img2;
  if (item.other_img3) otherImg3Preview.value = item.other_img3;
  if (item.other_img4) otherImg4Preview.value = item.other_img4;
  if (item.other_img5) otherImg5Preview.value = item.other_img5;

  modalFlg.value = true;
  updateModal.show();
}

const formData = new FormData();

function submitUpdate() {
  // const formData = new FormData();
  formData.append('id', selectedContent.id);
  formData.append('title', selectedContent.title);
  formData.append('content', selectedContent.content);

  // 파일이 있는 경우에만 FormData에 추가
  if (selectedContent.main_img && selectedContent.main_img instanceof File) {
    formData.append('main_img', selectedContent.main_img);
  }
  if (selectedContent.other_img2 && selectedContent.other_img2 instanceof File) {
    formData.append('other_img2', selectedContent.other_img2);
  }
  if (selectedContent.other_img3 && selectedContent.other_img3 instanceof File) {
    formData.append('other_img3', selectedContent.other_img3);
  }
  if (selectedContent.other_img4 && selectedContent.other_img4 instanceof File) {
    formData.append('other_img4', selectedContent.other_img4);
  }
  if (selectedContent.other_img5 && selectedContent.other_img5 instanceof File) {
    formData.append('other_img5', selectedContent.other_img5);
  }

  store.dispatch('updatePost', formData)
    .then(() => {
      store.dispatch('communityGet', { id: route.params.id });
      alert('수정이 완료되었습니다.');
      closeUpdateModal();
    })
    .catch(error => {
      alert(`수정 실패: ${error.message}`);
    });
}


const closeUpdateModal = () => {
  mainImgPreview.value = '';
  otherImg2Preview.value = '';
  otherImg3Preview.value = '';
  otherImg4Preview.value = '';
  otherImg5Preview.value = '';
  selectedContent.id = null;
  selectedContent.title = '';
  selectedContent.content = '';
  selectedContent.main_img = null;
  selectedContent.other_img2 = null;
  selectedContent.other_img3 = null;
  selectedContent.other_img4 = null;
  selectedContent.other_img5 = null;
};

// function goToDetail(id) {
//   router.push({ path: `/community/detail/${id}` });
// }
async function goToDetail(id) {
  try {
    // 현재 사용자 ID 가져오기
    const currentUserId = store.state.userInfo ? store.state.userInfo.id : null;

    // 게시글 정보 가져오기
    const post = store.state.communityData.find(item => item.id === id);

    // 조회수 증가 조건: 사용자가 로그인 상태이고 게시글 작성자와 다를 때
    if (currentUserId && post && currentUserId !== post.user_id) {
      await increaseViewCount(id);
    }

    // 상세 페이지로 이동
    router.push({ path: `/community/detail/${id}` });
  } catch (error) {
    console.error("조회수 증가 실패:", error);
    // 실패하더라도 상세 페이지로 이동
    router.push({ path: `/community/detail/${id}` });
  }
}

// 조회수 증가 메서드
function increaseViewCount(id) {
  // Vuex 액션 호출
  return store.dispatch('communityViews', id);
}

function deletePost(id) {
  if (confirm('정말 삭제하시겠습니까?')) {
    store.dispatch('communityDelete', id);
    store.dispatch('communityGet', { id: route.params.id });
  }
}

const count = ref(0);

const decrease = () => {
  if (count.value > 0) {
    count.value -= 1;
  }
};

const increase = () => {
  if (count.value < 5) {
    count.value += 1;
  }
};

const isCommunity2 = computed(() => {
  return route.path === '/community/2';
});

</script>

<style scoped src="../css/community.css">
</style>
