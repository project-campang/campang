<template>
  <div class="my-page-section">
    <div v-if="$store.state.userInfo" class="my-page-side">
      <img :src="$store.state.userInfo.profile" alt="Profile Image">
      <p>{{ $store.state.userInfo.nick_name }}</p>
      <p>{{ $store.state.userInfo.email }}</p>
      <button @click="openModal($store.state.userInfo)" type="button" class="btn btn-primary my-page-button" data-bs-toggle="modal" data-bs-target="#userModal">내정보수정</button>
      <div class="my-page-box">
        <p class="mypage-stamp" @click="showstamp">내 도장판</p>
        <p>-정복한 캠핑장</p>
        <p>-찜목록</p>
        <p class="mypage-content" @click="showcontent">내가쓴글</p>
        <p>-게시글</p>
        <p>-리뷰</p>
        <p>-댓글</p>
      </div>
    </div>
    <div v-if="isstampVisible">
      <h1>정복한 캠핑장 _도장깨기</h1>
      <div class="stamp-top">
        <h3 class="stamp-top-h2">총 {{ $store.state.stampCampingzang.length }}군데 정복!</h3>
        <div class="stamp-top-item" v-for="(item, key) in $store.state.stampCampingzang" :key="key">
          <router-link :to="`/camp/${item.camp_id}`"><img :src="item.main_img" alt=""></router-link>
          <div class="stamp-overlay">{{ item.updated_at }}<br>{{ item.camp_name }}</div>
        </div>
      </div>
      <h1>찜한 캠핑장 _찜목록</h1>
        <hr>
        <div class="content-bottom">
          <div class="my-content-box">
            <div class="list-group">
              <div class="content-column list-item" aria-disabled="true">
                <div class="my-page-top text-center">번호</div>
                <div class="my-page-top text-center">캠핑장 이름</div>
                <div class="my-page-top text-center">찜한 날짜</div>
              </div>
              <div class="content-row text-center" v-for="(item, index) in $store.state.mypageWishes" :key="index">
                  <div class="content-row-num">{{ index + 1 }}</div>
                  <router-link :to="`/camp/${item.camp_id}`"><div class=" text-center">{{ item.camp_name }}</div></router-link>
                  <div class="text-center">{{ item.created_at }}</div>
              </div>
              <hr class="item-hr">
            </div>
            <!-- <div class="pagination">
              <button class="pre-next-btn" type="button" :disabled="$store.state.pagination.current_page == 1" @click="prevPage()">< 이전 </button>
              <div class="page-num">{{ $store.state.pagination.current_page+'/'+$store.state.pagination.last_page }}</div>
              <button class="pre-next-btn" type="button" :disabled="$store.state.pagination.current_page == $store.state.pagination.last_page" @click="nextPage()"> 다음 > </button>
            </div> -->
          </div>
        </div>
    </div>
    <div v-else class="posts-section">
        <h1>내 게시글</h1>
        <hr>
        <div class="content-bottom">
          <div class="my-content-box">
            <div class="list-group">
              <div class="content-column list-item" aria-disabled="true">
                <div class="my-page-top">글 번호</div>
                <div class="my-page-top">글 제목</div>
                <div class="my-page-top">작성일</div>
                <div class="my-page-top"></div>
              </div>
              <div class="content-row text-center" v-for="(item, index) in $store.state.mypageContent" :key="index">
                <div class="content-row-num">{{ index + 1 }}</div>
                <div class="title-text-align" data-bs-toggle="modal" data-bs-target="#contentModal" @click="dataModal(item, '게시글')">{{ item.title }}</div>
                <div>{{ item.created_at }}</div>
                <div><button type="button" class="btn" @click="updataModal(item, '게시글')">수정</button><button type="button"  class="btn" data-bs-toggle="modal" data-bs-target="#deleteModal">삭제</button></div>
              </div>
              <hr class="item-hr">
            </div>
            <div class="pagination">
            </div>
          </div>
        </div>
        <h1>내가 쓴 리뷰</h1>
        <hr>
        <div class="content-bottom">
          <div class="my-content-box">
            <div class="list-group">
              <div class="content-column list-item" aria-disabled="true">
                <div class="my-page-top">글 번호</div>
                <div class="my-page-top">글 제목</div>
                <div class="my-page-top">작성일</div>
                <div class="my-page-top"></div>
              </div>
              <div class="content-row text-center" v-for="(item, index) in $store.state.mypageReview" :key="index">
                <div class="content-row-num">{{ index + 1 }}</div>
                <div class="title-text-align" data-bs-toggle="modal" data-bs-target="#contentModal" @click="dataModal(item, '리뷰')">{{ item.title }}</div>
                <div>{{ item.created_at }}</div>
                <div><button type="button" class="btn" @click="updataModal(item, '리뷰')">수정</button><button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#deleteModal">삭제</button></div>
              </div>
              <hr class="item-hr">
            </div>
            <div class="pagination"></div>
          </div>
        </div>
        <h1>내가 쓴 댓글</h1>
        <hr>
        <div class="content-bottom">
          <div class="my-content-box">
            <div class="list-group">
              <div class="content-column list-item" aria-disabled="true">
                <div class="my-page-top">글 번호</div>
                <div class="my-page-top">댓글 내용</div>
                <div class="my-page-top">작성일</div>
                <div class="my-page-top"></div>
              </div>
              <div class="content-row text-center" v-for="(item, index) in $store.state.mypageComment" :key="index">
                <div class="content-row-num">{{ index + 1 }}</div>
                <div class="title-text-align" data-bs-toggle="modal" data-bs-target="#contentModal" @click="dataModal(item, '댓글')">{{ item.comment }}</div>
                <div>{{ item.created_at }}</div>
                <div><button type="button" class="btn" @click="updataModal(item, '댓글')">수정</button><button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#deleteModal">삭제</button></div>
              </div>
              <hr class="item-hr">
            </div>
            <div class="pagination"></div>
          </div>
        </div>
      </div>
    
  </div>

  <!-- Modal -->
  <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="userModalLabel">내정보 수정</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateUserInfoForm">
            <div class="mb-3">
              <label for="profile" class="form-label">프로필 사진</label>
              <input type="file" class="form-control" id="profile" name="profile" @change="onProfileChange">
              <img :src="userInfo.profile" alt="Profile Image" v-if="userInfo.profile" class="mt-3" style="width: 100px; height: 100px;">
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">이름</label>
              <input type="text" class="form-control" id="name" name="name" v-model="userInfo.name">
              <div v-if="validationErrors.name" class="alert alert-danger">{{ validationErrors.name }}</div>
            </div>
            <div class="mb-3">
              <label for="nick_name" class="form-label">닉네임</label>
              <input type="text" class="form-control" id="nick_name" name="nick_name" v-model="userInfo.nick_name">
              <div v-if="validationErrors.nick_name" class="alert alert-danger">{{ validationErrors.nick_name }}</div>
            </div>
            <div class="mb-3">
              <label for="tel" class="form-label">휴대폰 번호</label>
              <input type="text" class="form-control" id="tel" name="tel" v-model="userInfo.tel" @input="oninputPhone" maxlength="14">
              <div v-if="validationErrors.tel" class="alert alert-danger">{{ validationErrors.tel }}</div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
              <button type="button" @click="updateUserInfo" :disabled="!isFormValid" :data-bs-dismiss="isFormValid ? 'modal' : ''" class="btn btn-primary">수정 완료</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
 <!-- 동적 모달 -->
<div class="modal fade" id="contentModal" tabindex="-1" aria-labelledby="contentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="contentModalLabel">{{ contentType }}: {{ selectedContent?.title || selectedContent?.comment }}</h1>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
      <div class="modal-body">
        <p v-if="contentType !== '댓글'"><strong>내용:</strong> {{ selectedContent?.content }}</p>
        <hr>
        <p><strong>작성일자:</strong> {{ selectedContent?.created_at }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
      </div>
    </div>
  </div>
</div>
<!-- 수정 모달 -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="updateModalLabel">{{ contentType }} 수정</h1>
        </div>
        <div class="modal-body">
          <form v-if="contentType === '게시글' || contentType === '리뷰'">
            <div class="mb-3">
              <label for="title" class="form-label">제목</label>
              <input type="text" class="form-control" id="title" v-model="selectedContent.title">
            </div>
            <div class="mb-3">
              <label for="content" class="form-label">내용</label>
              <textarea class="form-control my-update-form" id="content" v-model="selectedContent.content" rows="5"></textarea>
            </div>
          </form>
          <form v-else-if="contentType === '댓글'">
            <div class="mb-3">
              <label for="comment" class="form-label">댓글 내용</label>
              <textarea class="form-control" id="comment" v-model="selectedContent.comment" rows="3"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" @click="closeUpdateModal">취소</button>
          <button type="button" class="btn btn-primary" @click="updateContent">수정 완료</button>
        </div>
      </div>
    </div>
  </div>
<!-- 삭제 모달 -->
< <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <h1>삭제하시겠습니까 ?</h1>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
          <button type="button" class="btn btn-primary" @click="deleteContent">완료</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref,watch, computed, onBeforeMount} from 'vue';
import { useStore } from 'vuex';
import { Modal } from 'bootstrap';


const selectedContent = ref(null);
const contentType = ref('');
const store = useStore();


function prevPage() {
 store.dispatch('commentPageGet', store.state.pagination.current_page-1);
}

function nextPage() {
 store.dispatch('commentPageGet', store.state.pagination.current_page+1);
}

onBeforeMount(() => {
  if(store.state.stampCampingzang.length < 1 ) {
    store.dispatch('setStampCampingzang');
  }
  if(store.state.mypageWishes.length < 1 ) {
    store.dispatch('setMypageWishes');
  }
  if(store.state.mypageContent.length < 1 ) {
    store.dispatch('setMypageContent');
  }
  if(store.state.mypageReview.length < 1 ) {
    store.dispatch('setMypageReview');
  }
  if(store.state.mypageComment.length < 1 ) {
    store.dispatch('setMypageComment');
  }
})

const validateNickName = (nick_name) => {
    const regex = /^[가-힣a-zA-Z]+$/u;
    return regex.test(nick_name);
};

const validateName = (name) => {
    const regex = /^[가-힣]+$/u;
    return regex.test(name);
};

const validateTel = (tel) => {
    const regex = /^(\d{2,3}-\d{3,4}-\d{4})|(\d{10,11})$/;
    return regex.test(tel);
};

const validationErrors = ref({
    nick_name: '',
    name: '',
    tel: ''
});

const userInfo = ref({
  name: '',
  nick_name: '',
  tel: '',
  profile: ''
});

// Vuex 상태에서 사용자 정보를 가져옵니다.
// store.state.userInfo && Object.assign(userInfo.value, store.state.userInfo);

// 닉네임 유효성 검사
watch(() => userInfo.value.nick_name, (newNickName) => {
    if (!validateNickName(newNickName)) {
        validationErrors.value.nick_name = '한글 또는 영문만 사용 가능합니다.';
    } else if (newNickName.length < 2 || newNickName.length > 10) {
        validationErrors.value.nick_name = '닉네임은 2자 이상, 10자 이하이어야 합니다.';
    } else {
        validationErrors.value.nick_name = '';
    }
});

// 이름 유효성 검사
watch(() => userInfo.value.name, (newName) => {
    if (!validateName(newName)) {
        validationErrors.value.name = '한글만 사용 가능합니다.';
    } else if (newName.length < 2 || newName.length > 20) {
        validationErrors.value.name = '이름은 2자 이상, 20자 이하이어야 합니다.';
    } else {
        validationErrors.value.name = '';
    }
});

// 전화번호 유효성 검사
watch(() => userInfo.value.tel, (newTel) => {
    if (!validateTel(newTel)) {
        validationErrors.value.tel = '유효한 전화번호 형식이 아닙니다.';
    } else {
        validationErrors.value.tel = '';
    }
});

// 프로필 사진 변경 이벤트 처리
const onProfileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            userInfo.value.profile = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};

// 모든 필드가 유효한지 여부를 계산
const isFormValid = computed(() => {
    return !validationErrors.value.name && !validationErrors.value.nick_name && !validationErrors.value.tel;
});

// 사용자 정보 업데이트 함수
const updateUserInfo = () => {
    if (isFormValid.value) {
        store.dispatch('updateUserInfo', userInfo.value);
    }
};

const isstampVisible = ref(true);
// const userInfo = ref({
//   name: '',
//   nick_name: '',
//   email: '',
//   tel: '',
//   profile: ''
// });

function showstamp() {
  isstampVisible.value = true;
}

function showcontent() {
  isstampVisible.value = false;
}

function openModal(data) {
  if (data) {
    userInfo.value = { ...data };
  }
}

function dataModal(content, type) {
  selectedContent.value = content;
  contentType.value = type;

}

// 데이터 모달 열기
function updataModal(content, type) {
  selectedContent.value = { ...content }; // 선택된 컨텐츠 데이터 설정
  contentType.value = type; // 컨텐츠 타입 설정
  $('#updateModal').modal('show'); // 수정 모달 열기
}

// 수정 모달 닫기
function closeUpdateModal() {
  $('#updateModal').modal('hide'); // 수정 모달 닫기
}

// 컨텐츠 업데이트 함수
// function updateContent() {
//   switch (contentType.value) {
//     case '게시글':
//       store.dispatch('updatePost', selectedContent.value);
//       break;
//     case '리뷰':
//       store.dispatch('updateReview', selectedContent.value);
//       break;
//     case '댓글':
//       store.dispatch('updateComment', selectedContent.value);
//       break;
//     default:
//       console.error('유효하지 않은 컨텐츠 유형');
//   }
//   closeUpdateModal(); // 수정 완료 후 모달 닫기
// }

// function deleteContent() {
//   switch (contentType.value) {
//     case '게시글':
//       store.dispatch('deletePost', selectedContent.value);
//       break;
//     case '리뷰':
//       store.dispatch('deleteReview', selectedContent.value);
//       break;
//     case '댓글':
//       store.dispatch('deleteComment', selectedContent.value);
//       break;
//     default:
//       console.error('유효하지 않은 컨텐츠 유형');
//   }
//   // 모달 닫기
//   $('#deleteModal').modal('hide');
// }

// 수정/삭제 함수
const updateContent = async () => {
  try {
    switch (contentType.value) {
      case '게시글':
        await store.dispatch('updatePost', selectedContent.value);
        break;
      case '리뷰':
        await store.dispatch('updateReview', selectedContent.value);
        break;
      case '댓글':
        await store.dispatch('updateComment', selectedContent.value);
        break;
      default:
        throw new Error('유효하지 않은 컨텐츠 유형');
    }
    closeUpdateModal();
    alert('수정이 완료되었습니다.');
  } catch (error) {
    alert(`수정 실패: ${error.message}`);
  }
};

const deleteContent = async () => {
  try {
    switch (contentType.value) {
      case '게시글':
        await store.dispatch('deletePost', selectedContent.value);
        break;
      case '리뷰':
        await store.dispatch('deleteReview', selectedContent.value);
        break;
      case '댓글':
        await store.dispatch('deleteComment', selectedContent.value);
        break;
      default:
        throw new Error('유효하지 않은 컨텐츠 유형');
    }
    $('#deleteModal').modal('hide');
    alert('삭제가 완료되었습니다.');
  } catch (error) {
    alert(`삭제 실패: ${error.message}`);
  }
};

// function onProfileChange(event) {
//   const file = event.target.files[0];
//   if (file) {
//     const reader = new FileReader();
//     reader.onload = () => {
//       userInfo.value.profile = reader.result;
//     };
//     reader.readAsDataURL(file);
//   }
// }
</script>


<style  scope src="../css/user.css">
</style>
