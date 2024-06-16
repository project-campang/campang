<template>
    <div class="reserve-top text-center">
        <h1>상품 정보</h1>
        <img src="/img/sample1.jpg"  alt="">
        <p>태안 바다랑캠핑장</p>
       <p> *B1*파쇄석/차박가능/사이트옆주차가능</p>
    </div>
    <div class="reserve-middle">
        <span>
            입실일

            2024. 07. 13 (토)
        </span>
        <span>
            퇴실일

            2024. 07. 14 (일)
        </span>
        <div>
            <h3>예약객실수</h3>
            <p>객실수:1</p>
        </div>
    </div>
    <div class="text-center">
        캠핑 가는 날 D - 27
    </div>
    <div class="reserve-form">
        <h2 >예약자 정보</h2>
        <form @submit.prevent="register">
            <div class="mb-3">
                <label for="name" class="form-label">이름<span>(필수)</span></label>
                <input type="text" class="form-control" id="name" autocomplete="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">연락처<span>(필수)</span></label>
                <input type="email"  class="form-control" id="email" autocomplete="email">
            </div>
            <div class="mb-3">
                <label for="nick_name" class="form-label">이메일<span>(선택)</span></label>
                <input type="text"  class="form-control" id="nick_name" autocomplete="nickname">
            </div>
            <div>
                <h4>전체 동의</h4>
                <input type="checkbox" name="" id="">
                <label for="">예약 유의사항 및 취소/환불규정 동의</label>
                <br>
                <input type="checkbox" name="" id="">
                <label for="">개인정보 수집 및 이용 동의</label>
                <br>
                <input type="checkbox" name="" id="">
                <label for="">개인정보 제 3자 제공 동의 </label>
                <br>
                <input type="checkbox" name="" id="">
                <label for="">만 14세 이상 이용동의 (필수)
                    (※미성년자 서비스이용 불가)</label>
                </div>
                <button class="btn">예약하기</button>
                <button class="btn">취소</button>
            </form>
        </div>
</template>

<script>
</script>

<style scoped src="../css/main.css"></style>
