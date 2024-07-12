
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
  const categories = ['사이트 이용 방법', '안전 및 규정', '광고 신청', '기타 질문'];
  
  // FAQ 데이터
  const faqs = {
    '사이트 이용 방법': [
      { question: '회원 가입은 어떻게 하나요?', answer: '회원 가입은 상단에 "회원가입" 버튼을 클릭하면 필요한 정보를 입력하고 진행할 수 있습니다.' },
      { question: '계정 정보를 변경하려면 어떻게 하나요?', answer: '마이페이지에서 내 정보 수정 버튼을 클릭해서 계정 정보를 변경할 수 있습니다.' },
      // { question: '예약 내역은 어디서 확인할 수 있나요?', answer: '마이페이지의 예약 내역에서 예약 정보를 확인할 수 있습니다.' },
      { question: '캠핑장 리뷰는 어떻게 작성하나요?', answer: '커뮤니티 페이지의 리뷰 게시판에서 작성이 가능합니다. ' },
      { question: '캠핑장 예약은 어떻게 하나요?', answer: '캠핑장 예약은 캠핑장 상세 페이지에 있는 예약버튼을 누르시면 사이트로 연결을 해드립니다.' },
      { question: '사이트에서 제공하는 캠핑장 정보는 신뢰할 수 있나요?', answer: '저희 사이트는 한국 관광 공사로부터 검증된 정보를 제공 중이며 항상 업데이트를 진행하고 있습니다.' },
      // { question: '사이트 이용 시 문제가 발생하면 어떻게 하나요?', answer: '캠팡 카카오톡 채널로 문의주시면 빠르게 문제를 해결할 수 있습니다.' },
      // { question: '사이트 내에서 결제 정보는 안전한가요?', answer: '저희 사이트는 안전한 결제를 위해 SSL 암호화 기술을 사용하고 있습니다.' },
      // { question: '사이트에서 제공하는 이벤트 정보는 어디서 확인할 수 있나요?', answer: '이벤트 페이지에서 현재 진행 중인 이벤트 정보를 확인할 수 있습니다.' },
      { question: '사이트 이용 시 불편사항이 있으면 어디에 문의해야 하나요?', answer: '캠팡 카카오톡 채널로 문의주세요. 최대한 빠르게 처리해 드리겠습니다.' }
    ],
    '안전 및 규정': [
      { question: '캠핑장 내에서의 애완동물 동반은 가능한가요?', answer: '애완동물 동반 가능 여부는 캠핑장마다 다르므로, 사전에 확인해 주세요.' },
      { question: '캠핑장 내에서의 흡연은 가능한가요?', answer: '캠핑장 내 지정된 흡연 구역에서만 흡연이 가능합니다.' },
      { question: '캠핑장 내에서 음주가 허용되나요?', answer: '캠핑장 내에서는 음주가 허용되지만, 과도한 음주는 자제해 주세요.' },
      { question: '캠핑장 내에서의 쓰레기 처리는 어떻게 하나요?', answer: '캠핑장 내 지정된 쓰레기 처리 장소를 이용해 주세요. 특히 음식물 쓰레기 처리에 주의해주세요. 이는 야생동물 방지 및 환경 보호를 위한 조치입니다.' },
      { question: '캠핑장에서의 야외 화재는 허용되나요?', answer: '캠핑장 내에서의 모든 화재는 금지되어 있습니다. 안전을 위해 지켜주세요.' },
      { question: '야외 화재 경보가 울릴 경우 대응 방법은 어떻게 되나요?', answer: '즉시 캠핑장 직원에게 신고하고, 안전 구역으로 대피해 주세요.' },
      { question: '캠핑장 내에서의 금지품목은 무엇인가요?', answer: '캠핑장 내에서는 폭죽, 불법 약물 등의 금지품목을 반입하거나 사용하실 수 없습니다.' },
      { question: '캠핑장 내에서의 불법 행위는 어떻게 처리되나요?', answer: '캠핑장 내에서의 불법 행위는 즉시 제재될 수 있으며, 법적 조치를 받을 수 있습니다.' },
    ],
    // '예약 관련': [
    //   { question: '예약 변경이나 취소는 가능한가요?', answer: '예약 변경이나 취소는 예약 페이지에서 직접 하거나 고객센터에 문의하여 가능합니다.' },
    //   { question: '예약 확인은 어떻게 할 수 있나요?', answer: '마이페이지의 예약 내역에서 예약을 확인할 수 있습니다.' },
    //   { question: '캠핑장 예약 시 결제 방법은 무엇이 있나요?', answer: '신용카드, 계좌이체, 휴대폰 결제 등 다양한 결제 방법을 제공합니다.' },
    //   { question: '캠핑장 예약이 완료되면 어떤 확인을 받나요?', answer: '예약 완료 시 이메일로 예약 확인서가 발송됩니다.' },
    //   { question: '예약을 취소하면 환불이 가능한가요?', answer: '예약 취소 시 환불 규정에 따라 환불이 진행됩니다.' },
    //   { question: '예약이 가능한 캠핑장은 어디서 확인할 수 있나요?', answer: '예약 가능한 캠핑장은 홈페이지의 캠핑장 목록에서 확인할 수 있습니다.' },
    //   { question: '캠핑장 예약 시 최소 숙박 기간이 있나요?', answer: '캠핑장에 따라 최소 숙박 기간이 있을 수 있으니 예약 페이지에서 확인해 주세요.' },
    //   { question: '캠핑장 예약 시 필요한 정보는 무엇인가요?', answer: '예약 시 필요한 정보는 이름, 연락처, 결제 정보 등입니다.' },
    //   { question: '예약 확정 후 캠핑장 이용 관련 안내는 어떻게 받나요?', answer: '예약 확정 후 이메일이나 문자로 캠핑장 이용 관련 안내를 받게 됩니다.' }
    // ],
    '광고 신청': [
      { question: '사이트에 광고를 게시하려면 어떻게 해야 하나요?', answer: '페이지 하단의 "광고 게시하기" 버튼을 클릭하여 필요 정보를 입력해 신청이 가능하고, 필요 시 카카오톡 채널로 연락주시면 됩니다.' },
      { question: '광고 게시의 요금 체계는 어떻게 되나요?', answer: '광고 게시의 요금은 게재 기간, 광고 형식, 위치 등에 따라 달라질 수 있습니다. 자세한 요금 정보는 문의해 주세요.' },
      { question: '광고 콘텐츠에 대한 가이드라인은 어떻게 되나요?', answer: '영업장 광고의 경우 규정 준수 검증을 위해 저희 사이트에 등록된 상태에 한해 서비스를 제공합니다.' },
      { question: '광고 게시의 최소 기간은 얼마인가요?', answer: '일반적으로 광고 게시의 최소 기간은 1일부터 시작될 수 있습니다.' },
      { question: '광고 콘텐츠의 제출 기한은 어떻게 되나요?', answer: '광고 콘텐츠는 게시 예정일 전에 제출되어야 합니다. 일정 기간 전에 제출해야 정확한 검토와 준비가 가능합니다.' },
      { question: '광고 게시 후에 변경이나 취소가 가능한가요?', answer: '광고 게시 후 변경이나 취소를 원하실 경우 가능한 경우에 따라 조정할 수 있습니다. 카카오톡 채널로 연락주세요.' }
    ],
    '기타 질문': [
      { question: '캠핑장 위치는 어떻게 확인하나요?', answer: '캠핑장 모아보기에서 지도와 함께 캠핑장 위치를 확인할 수 있습니다.' },
      { question: '캠핑 장비 대여는 가능한가요?', answer: '일부 캠핑장에서는 캠핑 장비 대여 서비스를 제공합니다.' },
      // { question: '반려동물 동반이 가능한 캠핑장은 어디인가요?', answer: '반려동물 동반이 가능한 캠핑장은 캠핑장 상세 페이지에서 확인할 수 있습니다.' },
      // { question: '캠핑장 이용 시간은 어떻게 되나요?', answer: '캠핑장마다 이용 시간이 다를 수 있으니, 상세 페이지에서 예약하기 버튼을 눌러 확인해 주세요.' },
      // { question: '캠핑장 이용 시 주의사항은 무엇인가요?', answer: '각 캠핑장의 이용 수칙을 확인하고 준수해 주세요.' },
      { question: '캠핑장 예약 시 주차는 어떻게 하나요?', answer: '캠핑장마다 주차 공간이 다르므로, 예약 시 주차 가능 여부를 확인해 주세요.' },
      // { question: '캠핑장 이용 시 전기 시설을 이용할 수 있나요?', answer: '일부 캠핑장은 전기 시설을 제공하므로, 캠핑장 상세 페이지에서 확인해 주세요.' },
      { question: '캠핑장 주변에 식사할 곳이 있나요?', answer: '캠핑장 주변 식당 정보를 캠핑장 모아보기에서 확인할 수 있습니다.' },
      { question: '캠핑장 주변에 관광 명소는 어떤 것들이 있나요?', answer: '캠핑장 주변 관광 명소를 캠핑장 모아보기에서 확인할 수 있습니다.' },
      // { question: '캠핑장 예약 후 체크인은 어떻게 하나요?', answer: '체크인 절차는 캠핑장마다 다를 수 있으므로, 예약 확인서에 안내된 내용을 참고하세요.' },
      { question: '캠핑장 내에서의 전기 사용은 어떻게 하나요?', answer: '캠핑장 내에서의 전기 사용은 허용되지만, 과도한 전기 사용은 자제해 주세요.' },
      { question: '캠핑장 내에서의 조명 사용은 가능한가요?', answer: '캠핑장 내에서의 조명 사용은 허용되지만, 이웃에게 불편을 주지 않도록 해 주세요.' },
    ]
  };
  
  // 선택된 카테고리의 FAQ만 필터링
  const filteredFAQs = computed(() => {
    return faqs[currentCategory.value] || [];
  });
  </script>
  
  <style scoped src="../css/faq.css">
  
  </style>
  