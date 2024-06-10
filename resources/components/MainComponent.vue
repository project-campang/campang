<template>
    <div class="main-main">
    <div class="main-logo">
        <img src="/img/logo-ko3.png" class="img-fluid" alt="Logo">
    </div>
        <div class="main-search">
            <div class="d-flex flex-wrap align-items-center justify-content-center">
                <span class="me-2">어느지역?</span>
                <div class="main-select-box me-2">
                    <select name="h_area1" class="select" onChange="cat1_change(this.value,h_area2)">
                        <option>-선택-</option>
                        <option value='1'>서울</option>
                        <option value='2'>부산</option>
                        <option value='3' selected>대구</option>
                        <option value='4'>인천</option>
                        <option value='5'>광주</option>
                        <option value='6'>대전</option>
                        <option value='7'>울산</option>
                        <option value='8'>강원</option>
                        <option value='9'>경기</option>
                        <option value='10'>경남</option>
                        <option value='11'>경북</option>
                        <option value='12'>전남</option>
                        <option value='13'>전북</option>
                        <option value='14'>제주</option>
                        <option value='15'>충남</option>
                        <option value='16'>충북</option>
                    </select>
                </div>
                <div class="main-select-box">
                    <select name="h_area2" class="select">
                        <option>-선택-</option>
                        <option value='193' selected>광양시</option>
                        <option value='194'>나주시</option>
                        <option value='195'>목포시</option>
                        <option value='196'>순천시</option>
                        <option value='197'>여수시</option>
                        <option value='198'>강진군</option>
                        <option value='199'>고흥군</option>
                        <option value='200'>곡성군</option>
                        <option value='201'>구례군</option>
                        <option value='202'>담양군</option>
                        <option value='203'>무안군</option>
                        <option value='204'>보성군</option>
                        <option value='205'>신안군</option>
                        <option value='206'>영광군</option>
                        <option value='207'>영암군</option>
                        <option value='208'>완도군</option>
                        <option value='209'>장성군</option>
                        <option value='210'>장흥군</option>
                        <option value='211'>진도군</option>
                        <option value='212'>함평군</option>
                        <option value='213'>해남군</option>
                        <option value='214'>화순군</option>
                    </select>
                </div>
            </div>
              <div class="d-flex flex-wrap align-items-center justify-content-center mt-3">
                  <span class="me-2">어디갈래?</span>
                  <div class="main-select-box me-2">
                      <select name="h_area3" class="select">
                          <option>-선택-</option>
                          <option value='1' selected>글램핑</option>
                          <option value='2'>오지/노지캠핑</option>
                          <option value='3'>카라반</option>
                      </select>
                  </div>
                  <button class="main-search-button">검색</button>
              </div>
          </div>
    </div>

</template> 
<script setup>






</script>
<style>
@import url(../css/main.css);
</style>  