
<template>
    <div class="faq-main">
        <h1 class="faq-h1">자주 묻는 질문</h1>
        <hr>
      <div class="category-buttons">
        <button 
          v-for="category in categories" 
          :key="category" 
          :class="['btn', { active: category === currentCategory }]" 
          @click="currentCategory = category">
          {{ category }}
        </button>
      </div>
      <div class="accordion accordion-list" id="accordionExample">
        <div v-for="(faq, index) in filteredFAQs" :key="index" class="accordion-item">
          <h2 class="accordion-header" :id="'heading' + index">
            <button 
              class="accordion-button collapsed" 
              type="button" 
              data-bs-toggle="collapse" 
              :data-bs-target="'#collapse' + index" 
              aria-expanded="false" 
              :aria-controls="'collapse' + index">
              <span class="faq-q">Q. </span>{{ faq.question }}
            </button>
          </h2>
          <div 
            :id="'collapse' + index" 
            class="accordion-collapse collapse" 
            :aria-labelledby="'heading' + index" 
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <span class="faq-a">A. </span><span class="content-font">{{ faq.answer }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, computed } from 'vue';
  
  // 현재 선택된 카테고리
  const currentCategory = ref('사이트 이용 방법');
  
  // 카테고리 리스트
  const categories = ['사이트 이용 방법', '기타 질문', '안전 및 규정', '예약 관련'];
  
  // FAQ 데이터
  const faqs = {
    '예약 관련': [
      { question: '캠핑장 예약은 어떻게 하나요?', answer: '캠핑장 예약은 캠핑장 상세 페이지에 있는 예약버튼을 누르시면 사이트로 연결을 해드립니다.' },
      { question: '예약 변경이나 취소는 가능한가요?', answer: '예약 변경이나 취소는 예약 페이지에서 직접 하거나 고객센터에 문의하여 가능합니다.' },
      { question: '예약 확인은 어떻게 할 수 있나요?', answer: '마이페이지의 예약 내역에서 예약을 확인할 수 있습니다.' },
      { question: '캠핑장 예약 시 결제 방법은 무엇이 있나요?', answer: '신용카드, 계좌이체, 휴대폰 결제 등 다양한 결제 방법을 제공합니다.' },
      { question: '캠핑장 예약이 완료되면 어떤 확인을 받나요?', answer: '예약 완료 시 이메일로 예약 확인서가 발송됩니다.' },
      { question: '예약을 취소하면 환불이 가능한가요?', answer: '예약 취소 시 환불 규정에 따라 환불이 진행됩니다.' },
      { question: '예약이 가능한 캠핑장은 어디서 확인할 수 있나요?', answer: '예약 가능한 캠핑장은 홈페이지의 캠핑장 목록에서 확인할 수 있습니다.' },
      { question: '캠핑장 예약 시 최소 숙박 기간이 있나요?', answer: '캠핑장에 따라 최소 숙박 기간이 있을 수 있으니 예약 페이지에서 확인해 주세요.' },
      { question: '캠핑장 예약 시 필요한 정보는 무엇인가요?', answer: '예약 시 필요한 정보는 이름, 연락처, 결제 정보 등입니다.' },
      { question: '예약 확정 후 캠핑장 이용 관련 안내는 어떻게 받나요?', answer: '예약 확정 후 이메일이나 문자로 캠핑장 이용 관련 안내를 받게 됩니다.' }
    ],
    '기타 질문': [
      { question: '캠핑장 위치는 어떻게 확인하나요?', answer: '홈페이지에서 지도와 함께 캠핑장 위치를 확인할 수 있습니다.' },
      { question: '캠핑 장비 대여는 가능한가요?', answer: '일부 캠핑장에서는 캠핑 장비 대여 서비스를 제공합니다.' },
      { question: '반려동물 동반이 가능한 캠핑장은 어디인가요?', answer: '반려동물 동반이 가능한 캠핑장은 캠핑장 상세 페이지에서 확인할 수 있습니다.' },
      { question: '캠핑장 이용 시간은 어떻게 되나요?', answer: '캠핑장마다 이용 시간이 다를 수 있으니, 캠핑장 상세 페이지에서 확인해 주세요.' },
      { question: '캠핑장 이용 시 주의사항은 무엇인가요?', answer: '각 캠핑장의 이용 수칙을 확인하고 준수해 주세요.' },
      { question: '캠핑장 예약 시 주차는 어떻게 하나요?', answer: '캠핑장마다 주차 공간이 다르므로, 예약 시 주차 가능 여부를 확인해 주세요.' },
      { question: '캠핑장 이용 시 전기 시설을 이용할 수 있나요?', answer: '일부 캠핑장은 전기 시설을 제공하므로, 캠핑장 상세 페이지에서 확인해 주세요.' },
      { question: '캠핑장 주변에 식사할 곳이 있나요?', answer: '캠핑장 주변 식당 정보를 캠핑장 상세 페이지에서 확인할 수 있습니다.' },
      { question: '캠핑장 내에서 취사가 가능한가요?', answer: '일부 캠핑장은 취사 공간을 제공하므로, 캠핑장 상세 페이지에서 확인해 주세요.' },
      { question: '캠핑장 예약 후 체크인은 어떻게 하나요?', answer: '체크인 절차는 캠핑장마다 다를 수 있으므로, 예약 확인서에 안내된 내용을 참고하세요.' }
    ],
    '안전 및 규정': [
      { question: '캠핑장에서의 야외 화재는 허용되나요?', answer: '캠핑장 내에서의 모든 화재는 금지되어 있습니다. 안전을 위해 지켜주세요.' },
      { question: '캠핑장 내에서의 흡연은 가능한가요?', answer: '캠핑장 내 지정된 흡연 구역에서만 흡연이 가능합니다.' },
      { question: '캠핑장 내에서 음주가 허용되나요?', answer: '캠핑장 내에서는 음주가 허용되지만, 과도한 음주는 자제해 주세요.' },
      { question: '캠핑장 내에서의 쓰레기 처리는 어떻게 하나요?', answer: '캠핑장 내 지정된 쓰레기 처리 장소를 이용해 주세요.' },
      { question: '캠핑장 내에서의 애완동물 동반은 가능한가요?', answer: '애완동물 동반 가능 여부는 캠핑장마다 다르므로, 사전에 확인해 주세요.' },
      { question: '캠핑장 내에서의 소란 행위는 가능한가요?', answer: '캠핑장 내에서는 소란 행위를 자제하고, 조용히 이용해 주세요.' },
      { question: '캠핑장 내에서의 불법 행위는 어떻게 처리되나요?', answer: '캠핑장 내에서의 불법 행위는 즉시 제재될 수 있으며, 법적 조치를 받을 수 있습니다.' },
      { question: '캠핑장 내에서의 전기 사용은 어떻게 하나요?', answer: '캠핑장 내에서의 전기 사용은 허용되지만, 과도한 전기 사용은 자제해 주세요.' },
      { question: '캠핑장 내에서의 조명 사용은 가능한가요?', answer: '캠핑장 내에서의 조명 사용은 허용되지만, 이웃에게 불편을 주지 않도록 해 주세요.' },
      { question: '캠핑장 내에서의 애완동물 관리 규정은 무엇인가요?', answer: '애완동물은 항상 목줄을 착용하고, 다른 캠퍼에게 불편을 주지 않도록 관리해 주세요.' }
    ],
    '사이트 이용 방법': [
      { question: '회원 가입은 어떻게 하나요?', answer: '회원 가입은 상단에 "회원가입" 버튼을 클릭하면 필요한 정보를 입력하고 진행할 수 있습니다.' },
      { question: '프로필 사진변경은 어떻게 하나요?', answer: '로그인을 하신 후, 마이페이지에서 내정보수정 버튼을 클릭해서 수정할 수 있습니다.' },
      { question: '계정 정보를 변경하려면 어떻게 하나요?', answer: '마이페이지에서 계정 정보를 변경할 수 있습니다.' },
      { question: '예약 내역은 어디서 확인할 수 있나요?', answer: '마이페이지의 예약 내역에서 예약 정보를 확인할 수 있습니다.' },
      { question: '캠핑장 리뷰는 어떻게 작성하나요?', answer: '캠핑장 상세 페이지에서 리뷰 작성 버튼을 클릭하여 리뷰를 작성하거나, 리뷰 페이지에서 작성이 가능합니다. ' },
      { question: '사이트에서 제공하는 캠핑장 정보는 신뢰할 수 있나요?', answer: '저희 사이트는 최신 정보를 제공하기 위해 항상 업데이트를 진행하고 있습니다.' },
      { question: '사이트 이용 시 문제가 발생하면 어떻게 하나요?', answer: '고객센터에 문의하여 문제를 해결할 수 있습니다.' },
      { question: '사이트 내에서 결제 정보는 안전한가요?', answer: '저희 사이트는 안전한 결제를 위해 SSL 암호화 기술을 사용하고 있습니다.' },
      { question: '사이트에서 제공하는 이벤트 정보는 어디서 확인할 수 있나요?', answer: '이벤트 페이지에서 현재 진행 중인 이벤트 정보를 확인할 수 있습니다.' },
      { question: '사이트 이용 시 불편사항이 있으면 어디에 문의해야 하나요?', answer: '불편사항은 고객센터에 문의해 주세요. 최대한 빠르게 처리해 드리겠습니다.' }
    ]
  };
  
  // 선택된 카테고리의 FAQ만 필터링
  const filteredFAQs = computed(() => {
    return faqs[currentCategory.value] || [];
  });
  </script>
  
  <style scoped src="../css/faq.css">
  
  </style>
  