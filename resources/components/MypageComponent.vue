<template>
  <div class="my-page-section">
    <div v-if="$store.state.userInfo" class="my-page-side">
      <img :src="$store.state.userInfo.profile" alt="Profile Image">
      <p class="side-nickname">{{ $store.state.userInfo.nick_name }}</p>
      <p class="side-email">{{ $store.state.userInfo.email }}</p>
      <button @click="openModal($store.state.userInfo)" type="button" class="btn btn-primary my-page-button" data-bs-toggle="modal" data-bs-target="#userModal">내정보수정</button>
      <div class="my-page-box">
    <p class="mypage-stamp" @click="showStamp()">내 도장판</p>
    <a href="#campingzang" class="my-page-link" @click="showStamp(); markActive($event)"><p>-도장깨기</p></a>
    <a href="#wish" class="my-page-link" @click="showStamp(); markActive($event)"><p>-찜목록</p></a>
    <p class="mypage-content" @click="showContent()">내가쓴글</p>
    <a href="#content" class="my-page-link" @click="showContent(); markActive($event)"><p>-게시글</p></a>
    <a href="#review" class="my-page-link" @click="showContent(); markActive($event)"><p>-리뷰</p></a>
    <a href="#comment" class="my-page-link" @click="showContent(); markActive($event)"><p>-댓글</p></a>
</div>

    </div>
    <div v-if="isstampVisible">
      <h1 id="campingzang">정복한 캠핑장 <span>_도장깨기</span></h1>
      <!-- <div class="stamp-top">
        <h3 class="stamp-top-h2">총 {{ $store.state.stampCampingzang.length }}군데 정복!</h3>
        <div class="stamp-top-item" v-for="(item, key) in $store.state.stampCampingzang" :key="key">
          <router-link :to="`/camp/${item.camp_id}`"><img :src="item.main_img" alt=""></router-link>
          <div  id="wish" class="stamp-overlay">{{ getFormattedDate(item.updated_at) }}<br>{{ item.camp_name }}</div>
        </div >
      </div> -->
      <div class="stamp-top">
        <h3 class="stamp-top-h2" v-if="$store.state.stampCampingzang.length > 0">
            총 {{ $store.state.stampCampingzang.length }}군데 정복!
        </h3>
        <h3 class="stamp-top-h2" v-else>
            캠핑장을 방문하면서 도장을 찍어보세요 !
        </h3>
        <div clss="mypage-stamp-list" v-if="$store.state.stampCampingzang.length > 0">
            <div class="stamp-top-item" v-for="(item, key) in $store.state.stampCampingzang" :key="key">
                <router-link :to="`/camp/${item.camp_id}`">
                    <img :src="item.main_img" alt="">
                </router-link>
                <div id="wish" class="stamp-overlay">
                    {{ getFormattedDate(item.updated_at) }}<br>{{ item.camp_name }}
                </div>
            </div>
        </div>
        <div clss="mypage-stamp-list" v-else>
          <div v-for="index in 10" :key="index" class="stamp-top-item">
            <div class="my-page-stamp-item">
              도장
            </div>
          </div>
        </div>
      </div>

      <h1 id="camping">찜한 캠핑장 <span>_찜목록</span></h1>
        <hr>
        <div class="content-bottom">
          <div class="my-content-box">
            <div class="list-group">
              <div class="content-column list-item text-center" aria-disabled="true">
                <div class="my-page-top text-center">번호</div>
                <div class="my-page-top text-center">캠핑장 이름</div>
                <div class="my-page-top text-center">시/도</div>
                <div class="my-page-top text-center">찜한 날짜</div>
              </div>
              <div class="content-row text-center" v-for="(item, index) in $store.state.mypageWishes" :key="index">
                  <div class="content-row-num">{{ index + 1 }}</div>
                  <router-link :to="`/camp/${item.camp_id}`"><div class=" text-center">{{ item.camp_name }}</div></router-link>
                  <div class="content-row-num">{{ item.state }}</div>
                  <div class="text-center wish-created" id="text-container">{{ getFormattedDate(item.created_at) }}</div>
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
    <div v-else class="posts-section" id="content">
        <h1 >내 게시글</h1>
        <hr>
        <div class="content-bottom">
          <div class="my-content-box">
            <div class="list-group">
              <div class="content-column list-item text-center"  aria-disabled="true">
                <div class="my-page-top" >번호</div>
                <div class="my-page-top">글 제목</div>
                <div class="my-page-top">작성일</div>
                <div class="my-page-top"></div>
              </div>
              <div class="content-row text-center" v-for="(item, index) in $store.state.mypageContent" :key="index">
                <div class="content-row-num">{{ index + 1 }}</div>
                <div class="title-text-align" data-bs-toggle="modal" data-bs-target="#contentModal" @click="dataModal(item, '게시글')">{{ item.title }}</div>
                <!-- <div>{{ item.user_nick_name }}</div> -->
                <div>{{ getFormattedDate(item.created_at) }}</div>
                <div><button type="button" class="btn mypage-btn-update" @click="updataModal(item, '게시글')">수정</button><button type="button"  class="btn mypage-btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" @click="dataModal(item, '게시글')">삭제</button></div>
              </div>
              <hr class="item-hr" id="review">
            </div>
            <div class="pagination">
            </div>
          </div>
        </div>
        <h1 >내가 쓴 리뷰</h1>
        <hr>
        <div class="content-bottom">
          <div class="my-content-box">
            <div class="list-group">
              <div class="content-column-other list-item text-center" aria-disabled="true">
                <div class="my-page-top">번호</div>
                <div class="my-page-top">제목</div>
                <div class="my-page-top">캠핑장</div>
                <!-- <div class="my-page-top">작성자</div> -->
                <div class="my-page-top">작성일</div>
              </div>
              <div class="content-row-other text-center" v-for="(item, index) in $store.state.mypageReview" :key="index">
                <div class="content-row-num">{{ index + 1 }}</div>
                <div class="title-text-align=" data-bs-toggle="modal" data-bs-target="#contentModal" @click="dataModal(item, '리뷰')">{{ item.title }}</div>
                <div class="review-cam ">{{ item.camp_name }}</div>
                <!-- <div>{{ item.user_nick_name }}</div> -->
                <div>{{ getFormattedDate(item.created_at) }}</div>
                <div><button type="button" class="btn mypage-btn-update" @click="updataModal(item, '리뷰')">수정</button><button type="button" class="btn mypage-btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" @click="dataModal(item, '리뷰')">삭제</button></div>
              </div>
              <hr class="item-hr" id="comment">
            </div>
            <div class="pagination"></div>
          </div>
        </div>
        <h1 >내가 쓴 댓글</h1>
        <hr>
        <div class="content-bottom">
          <div class="my-content-box">
            <div class="list-group">
              <div class="content-column-other list-item text-center" aria-disabled="true">
                <div class="my-page-top">글 번호</div>
                <div class="my-page-top">내용</div>
                <div class="my-page-top">캠핑장</div>
                <div class="my-page-top">작성일</div>
                <div class="my-page-top"></div>
                <div class="my-page-top"></div>
              </div>
              <div class="content-row-other text-center" v-for="(item, index) in $store.state.mypageComment" :key="index">
                <div class="content-row-num">{{ index + 1 }}</div>
                <div class="title-text-align" data-bs-toggle="modal" data-bs-target="#contentModal" @click="dataModal(item, '댓글')">{{ item.comment }}</div>
                <div class="review-cam ">{{ item.camp_name }}</div>
                <!-- <div>{{ item.user_nick_name }}</div> -->
                <div>{{ getFormattedDate(item.created_at) }}</div>
                <div><button type="button" class="btn mypage-btn-update" @click="updataModal(item, '댓글')">수정</button><button type="button" class="btn mypage-btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" @click="dataModal(item, '댓글')">삭제</button></div>
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
<!-- 상세 모달 -->
<!-- <div class="modal fade" id="contentModal" tabindex="-1" aria-labelledby="contentModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="contentModalLabel">{{ contentType }}: {{ selectedContent?.title || selectedContent?.comment }}</h1>
      </div>
      <div class="modal-body">
        <p v-if="contentType !== '댓글'"><strong>내용:</strong> {{ selectedContent?.content }}</p>
        <p v-if="contentType !== '댓글'"><strong>캠핑장:</strong> {{ selectedContent?.name }}</p>
        <hr>
        <p><strong>작성일자:</strong> {{ selectedContent?.created_at }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
        <button type="button" class="btn btn-primary" @click="updataModal(selectedContent, contentType)">수정</button>
        <button type="button" class="btn btn-danger"  @click="openDeleteModal()" data-bs-toggle="modal" data-bs-target="#deleteModal">삭제</button>
      </div>
    </div>
  </div>
</div> -->
<!-- 상세모달 -->
<div class="modal fade" id="contentModal" tabindex="-1" aria-labelledby="contentModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="contentModalLabel">{{ contentType }}: {{ selectedContent?.title || selectedContent?.comment }}</h1>
      </div>
      <div class="modal-body">
        <p v-if="contentType !== '댓글'"><span class="my-detail-title">- 내용</span> <br>{{ selectedContent?.content }}</p>
        <p v-if="contentType == '리뷰'"><span class="my-detail-title">- 캠핑장</span> <br>{{ selectedContent?.camp_name }}</p>
        <p v-if="selectedContent?.main_img" class="my-detail-title"><hr>- 메인이미지</p>
        <img v-if="selectedContent?.main_img" :src="selectedContent.main_img" alt="Main Image" class="my-page-detailmodal">
        <p v-if="selectedContent?.other_img2" class="my-detail-title">- 부가이미지1</p>
        <img v-if="selectedContent?.other_img2" :src="selectedContent.other_img2" alt="Other Image 2" class="my-page-detailmodal">
        <p v-if="selectedContent?.other_img3" class="my-detail-title">- 부가이미지2</p>
        <img v-if="selectedContent?.other_img3" :src="selectedContent.other_img3" alt="Other Image 3" class="my-page-detailmodal">
        <p v-if="selectedContent?.other_img4" class="my-detail-title">- 부가이미지3</p>
        <img v-if="selectedContent?.other_img4" :src="selectedContent.other_img4" alt="Other Image 4" class="my-page-detailmodal">
        <p v-if="selectedContent?.other_img5" class="my-detail-title">- 부가이미지4</p>
        <img v-if="selectedContent?.other_img5" :src="selectedContent.other_img5" alt="Other Image 5" class="my-page-detailmodal">
        <hr>
        <p><strong>작성일자:</strong> {{ selectedContent?.created_at }}</p>
        <p v-if="contentType !== '댓글'"><strong>조회수:</strong> {{ selectedContent?.views }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
        
        <!-- <button type="button" class="btn btn-danger"  @click="openDeleteModal()" data-bs-toggle="modal" data-bs-target="#deleteModal">삭제</button> -->
      </div>
    </div>
  </div>
</div>


<!-- 수정 모달 -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true" @hidden.bs.modal="closeUpdateModal">
    <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="updateModalLabel">{{ contentType }} 수정</h1>
        </div>
        <div class="modal-body">
          <form v-if="contentType === '게시글' || contentType === '리뷰'">
            <div class="mb-3">
              <input type="hidden" id="id" v-model="selectedContent.id">
              <label for="title" class="form-label">제목</label>
              <input type="text" class="form-control" id="title" v-model="selectedContent.title">
            </div>
            <div class="mb-3">
              <label for="content" class="form-label">내용</label>
              <textarea class="form-control my-update-form" id="content" v-model="selectedContent.content" rows="5"></textarea>
            </div>
            <div class="mb-3">
              <label for="main_img" class="form-label">메인 이미지 업로드</label>
              <input type="file" class="form-control" id="main_img" accept="image/*" @change="handleImgUpload('main_img')">
              <img v-if="mainImgPreview" :src="mainImgPreview" alt="Main Image" style="max-width: 100%; margin-top: 10px;">
              <img v-else-if="selectedContent.main_img" :src="selectedContent.main_img" alt="Main Image" style="max-width: 100%; margin-top: 10px;">
            </div>
            <div class="mb-3">
              <label for="other_img2" class="form-label">부가 이미지 2 업로드</label>
              <input type="file" class="form-control" id="other_img2"  accept="image/*" @change="handleImgUpload('other_img2')">
              <img v-if="otherImg2Preview" :src="otherImg2Preview" alt="Other Image 2" style="max-width: 100%; margin-top: 10px;">
              <img v-else-if="selectedContent.other_img2" :src="selectedContent.other_img2" alt="Other Image 2" style="max-width: 100%; margin-top: 10px;">
            </div>
            <div class="mb-3">
              <label for="other_img3" class="form-label">부가 이미지 3 업로드</label>
              <input type="file" class="form-control" id="other_img3"  accept="image/*" @change="handleImgUpload('other_img3')">
              <img v-if="otherImg3Preview" :src="otherImg3Preview" alt="Other Image 3" style="max-width: 100%; margin-top: 10px;">
              <img v-else-if="selectedContent.other_img3" :src="selectedContent.other_img3" alt="Other Image 3" style="max-width: 100%; margin-top: 10px;">
            </div>
            <div class="mb-3">
              <label for="other_img4" class="form-label">부가 이미지 4 업로드</label>
              <input type="file" class="form-control" id="other_img4"  accept="image/*" @change="handleImgUpload('other_img4')">
              <img v-if="otherImg4Preview" :src="otherImg4Preview" alt="Other Image 4" style="max-width: 100%; margin-top: 10px;">
              <img v-else-if="selectedContent.other_img4" :src="selectedContent.other_img4" alt="Other Image 4" style="max-width: 100%; margin-top: 10px;">
            </div>
            <div class="mb-3">
              <label for="other_img5" class="form-label">부가 이미지 5 업로드</label>
              <input type="file" class="form-control" id="other_img5"  accept="image/*" @change="handleImgUpload('other_img5')">
              <img v-if="otherImg5Preview" :src="otherImg5Preview" alt="Other Image 5" style="max-width: 100%; margin-top: 10px;">
              <img v-else-if="selectedContent.other_img5" :src="selectedContent.other_img5" alt="Other Image 5" style="max-width: 100%; margin-top: 10px;">
            </div>
          </form>
          <form v-else-if="contentType === '댓글'">
            <div class="mb-3">
              <input type="hidden" id="id" v-model="selectedContent.id">
              <label for="comment" class="form-label">댓글 내용</label>
              <textarea class="form-control" id="comment" v-model="selectedContent.comment" rows="3"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="closeUpdateModal">취소</button>
          <button type="button" class="btn btn-primary" @click="updateContent">수정 완료</button>
        </div>
      </div>
    </div>
  </div>




<!-- 삭제 모달 -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" @hidden.bs.modal="closeDeleteModal">
    <div class="modal-dialog modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <h1>삭제하시겠습니까 ?</h1>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  @click="closeDeleteModal">취소</button>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="deleteContent(contentType)">완료</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref,watch, computed, onBeforeMount, watchEffect} from 'vue';
import { useStore } from 'vuex';
import { Modal } from 'bootstrap';


// 날짜를 가공하는 함수 정의
function getFormattedDate(dateTime) {
  return dateTime.split(' ')[0]; // 공백을 기준으로 나눠서 첫 번째 부분만 반환
}


// const selectedContent = ref(null);
// const contentType = ref('');
const store = useStore();
const contentType = ref('');

const selectedContent = ref({
  id: null,
  title: '',
  content: '',
  main_img: null,
  other_img2: null,
  other_img3: null,
  other_img4: null,
  other_img5: null,
  comment: '',
});

const mainImgPreview = ref('');
const otherImg2Preview = ref('');
const otherImg3Preview = ref('');
const otherImg4Preview = ref('');
const otherImg5Preview = ref('');

const formData = new FormData();

// const handleImgUpload = (fieldName) => (event) => {
const handleImgUpload = (fieldName) => {
const file = event.target.files[0];
  console.log(file);
  if (file) {
    const reader = new FileReader();
    reader.onload = () => {
      switch (fieldName) {
        case 'main_img':
          mainImgPreview.value = reader.result;
          selectedContent.value.main_img = file;
          break;
        case 'other_img2':
          otherImg2Preview.value = reader.result;
          selectedContent.value.other_img2 = file;
          break;
        case 'other_img3':
          otherImg3Preview.value = reader.result;
          selectedContent.value.other_img3 = file;
          break;
        case 'other_img4':
          otherImg4Preview.value = reader.result;
          selectedContent.value.other_img4 = file;
          break;
        case 'other_img5':
          otherImg5Preview.value = reader.result;
          selectedContent.value.other_img5 = file;
          break;
        default:
          break;
      }
      // 파일이 선택될 때마다 FormData에 직접 추가하는 코드 추가
      updateFormData(fieldName, file);
    };
    reader.readAsDataURL(file); // 파일을 읽어 base64 형식으로 변환하여 미리보기에 사용
  }
};

// FormData에 파일을 추가하는 함수 정의
const updateFormData = (fieldName, file) => {
  formData.set(fieldName, file); // fieldName에 따라 동적으로 설정
};

// 수정 함수
const updateContent = async () => {
  try {
    
    formData.append('id', selectedContent.value.id);
    formData.append('title', selectedContent.value.title);
    formData.append('content', selectedContent.value.content);


    switch (contentType.value) {
      case '게시글':
        await store.dispatch('updatePost', formData);
        await store.dispatch('setMypageContent'); // 수정 후 다시 게시글 목록을 가져옴
        break;
      case '리뷰':
        console.log('리뷰수정시작');
        await store.dispatch('updateReview', formData);
        await store.dispatch('setMypageReview'); // 수정 후 다시 리뷰 목록을 가져옴
        break;
      case '댓글':
        await store.dispatch('updateComment', selectedContent.value);
        await store.dispatch('setMypageComment'); // 수정 후 다시 댓글 목록을 가져옴
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

const closeUpdateModal = () => {
    isUpdateModalVisible.value = false;
  mainImgPreview.value = '';
  otherImg2Preview.value = '';
  otherImg3Preview.value = '';
  otherImg4Preview.value = '';
  otherImg5Preview.value = '';
  selectedContent.value = {
    id: null,
    title: '',
    content: '',
    main_img: null,
    other_img2: null,
    other_img3: null,
    other_img4: null,
    other_img5: null,
    comment: '',
  };
};

// 모달 상태 관리를 위한 ref 선언
const isUpdateModalVisible = ref(false);
const isDeleteModalVisible = ref(false);

// 모달 닫기 메소드 정의
// const closeUpdateModal = () => {
//   isUpdateModalVisible.value = false;
// };

const closeDeleteModal = () => {
  isDeleteModalVisible.value = false;
};

// 삭제 모달 열기
// const openDeleteModal = () => {
//   isDeleteModalVisible.value = true;
// };

// 모달 닫기와 backdrop 관리
watchEffect(() => {
  if (!isUpdateModalVisible.value && !isDeleteModalVisible.value) {
    // 모달 닫기
    $('#updateModal').modal('hide');
    $('#deleteModal').modal('hide');
    // backdrop 강제 제거
    $('.modal-backdrop').remove();
  }
});
// function prevPage() {
//  store.dispatch('commentPageGet', store.state.pagination.current_page-1);
// }

// function nextPage() {
//  store.dispatch('commentPageGet', store.state.pagination.current_page+1);
// }

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

function showStamp() {
  isstampVisible.value = true;
}

function showContent() {
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
  console.log(content);
  selectedContent.value = { ...content }; // 선택된 컨텐츠 데이터 설정
  contentType.value = type; // 컨텐츠 타입 설정
  // $('#contentModal').modal('hide'); // 상세 모달 닫기
  $('#updateModal').modal('show'); // 수정 모달 열기
  isUpdateModalVisible.value = true;
}

// 수정 모달 닫기
// function closeUpdateModal() {
//   $('#updateModal').modal('hide'); // 수정 모달 닫기
// }

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



// 삭제함수
const deleteContent = async () => {
  try {
    switch (contentType.value) {
      case '게시글':
        await store.dispatch('deletePost', selectedContent.value);
        await store.dispatch('setMypageContent'); // 수정 후 다시 게시글 목록을 가져옴
        closeDeleteModal();
        break;
      case '리뷰':
        await store.dispatch('deleteReview', selectedContent.value);
        await store.dispatch('setMypageReview'); // 수정 후 다시 리뷰 목록을 가져옴
        closeDeleteModal();
        break;
      case '댓글':
        await store.dispatch('deleteComment', selectedContent.value);
        await store.dispatch('setMypageComment'); // 수정 후 다시 댓글 목록을 가져옴
        closeDeleteModal();
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

// document.addEventListener('DOMContentLoaded', function() {
//     // 현재 활성화된 버튼을 추적하기 위한 변수
//     let activeButton = null;

//     // 버튼 클릭 시 활성화 상태를 표시하는 함수
//     function markActive(event) {
//         // 클릭된 요소를 가져옴
//         const currentButton = event.currentTarget;
        
//         // 이전에 활성화된 버튼에서 active 클래스를 제거
//         if (activeButton) {
//             activeButton.classList.remove('active');
//         }

//         // 현재 클릭된 버튼에 active 클래스를 추가
//         currentButton.classList.add('active');
        
//         // 활성화된 버튼을 업데이트
//         activeButton = currentButton;
//     }

//     // 모든 .my-page-link 요소에 클릭 이벤트 리스너를 추가
//     const links = document.querySelectorAll('.my-page-link');
//     links.forEach(link => {
//         link.addEventListener('click', markActive);
//     });
// });
// 현재 활성화된 버튼을 추적하기 위한 변수
let activeButton = ref(null);

// 버튼 클릭 시 활성화 상태를 표시하는 함수
const markActive = (event) => {
  // 클릭된 요소를 가져옴
  const currentButton = event.currentTarget;

  // 이전에 활성화된 버튼에서 active 클래스를 제거
  if (activeButton.value) {
    activeButton.value.classList.remove('active');
  }

  // 현재 클릭된 버튼에 active 클래스를 추가
  currentButton.classList.add('active');

  // 활성화된 버튼을 업데이트
  activeButton.value = currentButton;
};

</script>


<style  scope src="../css/user.css">

</style>
