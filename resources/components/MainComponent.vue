<template>
    <!-- 첫번째 -->
    <div class="main-main" data-section="1">
        <div class="main-logo">
            <img src="/img/logo-ko3.png" class="img-fluid" alt="Logo" loading="lazy">
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
    
    <!-- 두번째 -->
    <div class="bg-white white-main main-second" data-section="2">
        <div class="main-left">
            <div class="main-left-img">
                <img src="/img/logo-ko3.png" class="main-left-img" alt="" loading="lazy">
            </div>
            <div class="main-rank">
                <button type="button" class="main-rank-btn-left"><h3>캠핑러</h3></button>
                <button type="button" class="main-rank-btn-right" id="campingzang"><h3>캠핑장</h3></button>
                <div class="main-rank-box">
                    <div>
                        <img src="/img/logo-ko3.png" alt="">
                        <p>이나라</p>
                    </div>
                    <div>
                        <img src="/img/logo-ko3.png" alt="">
                        <p>이나라</p>
                    </div>
                    <div>
                        <img src="/img/logo-ko3.png" alt="">
                        <p>이나라</p>
                    </div>
                </div>
            </div>
            <div class="main-pang">
                <a href="#">나도 도장 찍으러가기 <img src="/img/stamp2.png" alt="" loading="lazy"></a>
            </div>
        </div>
        <div class="main-right" data-section="3">
            <div class="main-right-top">
                <div>
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAB3UlEQVR4nO2Yz0pCQRSHPw1rla1a9QJlK7f1BgWFbesBglbRpl6gVZogrXuDiggifIDaqxmBT2Ch2B8CwxsDx83h3qteLceYDw7IeO45v5l7zjgjOBwOx39jGTgFysC7mPmcA1JYzDRQAL4BL8DMd3kggYXiiyHCtd3ZNonCAOK7Zt6ENTWvy6YCbACzYpvAo/JpA0tYwKmP+KSP3xxQVb5ZLKCiRJnVDiKjfEtYQEuJMiUTRFL5trCAiZ9AedJLKKdEPUrDaszYk/I9wQJSPttoVVY7KZbxEW+20UUsIR/hh8yKLbRLQo4H/Yq/te0ogQjKS2kECW9Lz1gnXvdEVnaYN7GSNKw1Ne9wOBz2MAWkgT3gTO7Gz0Ad+BKry1hRfPbkmalxiTZH5m3gCmhGOEZ0rQlcSqywY/hI77/nwOcQooPsU2KbHCNnAbgAOr8g3FPWkVwm50jYARo9ktalnA7l6GxWcR6YEZuXsS3gSHxfesRsSO6hOAhJUAOOpRljEWKbZ9ISoxaSZz+q+NWAvwnv5doYZ3TEJeaDTz6jYSVK0BsV6APYjbja/RKTHB8q93WUYK8qyBp/x7rKbfplYPSr/Gu8YfN7ltnAjFuw5ybA+FfdG2MPOhwOB735AXEPv3mzNAbBAAAAAElFTkSuQmCC">
                    <p class="count">0</p>
                    <p>가입유저수</p>
                </div>
                <div>
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAABRklEQVR4nO2XTUoDQRCFP7IzJ1BcewkFfyDn0JxFguJC4jF0EX/OY9zpSgXJ0sWUDGQRim6nh55MtaY+qF09eG+6qpsBx3Gcv84OcAO8AN+ANFTdMwemwLa1+QPgI8F0rN6Bfcsvn2N+NYTJSUw7MC/LurYIMFcmLoGtBN0QuFLaZwzQC1sbS2UYWOze0WPQtz6bShkYtNAOlLbCgDdlYtRCO1LaVwx4VCYWwDhBN172rmrvMeA4MEZ1TX7RXAT6K+AQIyYRQ0eB3pNI4HOMOQuMxEOg7ykwcqcUQspS5iz92km5FnOu3V5oepjMH64mPIA1fgLW+Al0yR4wC7ywFrUA7oDdNuY/CzAugZ//pBCzAsxKpG5TApQwNhKpr5QAWmSNtPXjATpGNv4EpIDllZwdKK0asTYoGx9AU/wX//cBHMdxWBs/iVR1mpOpR3EAAAAASUVORK5CYII=">
                    <p class="count">0</p>
                    <p>도장갯수</p>
                </div>
                <div>
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAADJ0lEQVR4nO2ZW4iNURTHf8Y9lyHkFrlLHsTDGEXIeEDmweWFGpdMeaAmkZTk0hgRjSRTKCOaSAh54MFtppAakonRPJBLE5P7zDBjjrbWqeP0nXP2/r5v5fb9a9WZ+dbe//U/e39rr70ORIgQIcK/jiygUD5PAfKBvgHm6wNMBFYAZcAzoEp4VLEIaAA6SQAxoE0CqAQqgL3ALmAHsBHYLn+XAieBm8BToEnGe9kcTRHtgHtCZFbC4GGaYILYBU0h+QlEp+R/m5SEfAeGawmpSiAy2yIbGCqkGmJ2aoiY7UG0XJ5dVxJSD3QOW8gND6Jr8mylkpAYsDRMEdNTkJhsNQroBnxUElIZppAraYiKxeew4qpMCkPE5Awkr4EOQK6ikLIwhFy0IJonvveVhHySDOkbE+Q9yER0VvyLFFdlbRAhZyxJWoABUjelKzuCWI1UFs4Y53jQrZdxFYqrMtOPkBOOJI/lG5ulKOS0q4iRsl1cifKUC8kWYLCLkKM+ic7J+DWKq7LFVsQQ4KtPklapWHsAH5SEvAQ62gg5GJCoROY5oLgqCzKJMCm0MSDJG6ALMNryDPJjVzMJ2RcS0TKLGi2ItQFjU4noB3y2mOSBRaV71+NGGbaVphJSYjlBkWSnTH450gmpUxLyTq4Pv8AUZO8dSpFCC99ymXuD4qqsShay1XLgZfEfZPEiNwP9gd6WW9aPVSeK6Cl9KpuBSxLGVVv4bxbfMsVVycWxnVMvaTWOYssxXYERclhqCCmPB/TKcsC2pO2YYzluteOVIOZoTfGW7SHZz+mcv8h+T8YTC6JaoL2D8JgPMwnlJ7pLT/d4ivdlt1e+lnfAhmihcv+r1is400iYIad8ndzMUnXbh1levm6L/1wlIbcIAectyUxvzDbbxSysQXZQnt8rcDKmWRJfEv+CAME3yi1xvm0p74o7FkGYA3S8BPDcIfhm6dIsllSuClOyH5ESPl1Qx8R/XQa/VinVTU+5F78BJs1OBfanOJ++yc8Qpth76/H8kfzCNZA/CFkJol4kBLsnqTKokVpvDH8B4qJKpcOSLSnddDIjRIgQ4T/ED2uQkyLQdFZFAAAAAElFTkSuQmCC">
                    <p class="count">0</p>
                    <p>캠핑장 수</p>
                </div>
            </div>
            <div class="main-right-middle">
                <div class="main-mini-search">
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
            <div class="main-right-bottom">
                <div class="main-right-board">
                    <a href="#">캠핑꿀팁 게시판</a>
                </div>
                <div class="right-board">
                    <a href="#">1위 이거 안쓰면 후회합니다</a>
                </div>
                <div class="right-tv">
                    <a href="#">캠팡 유튜브 <img src="/img/tv.png" alt="" loading="lazy"></a>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- 세번째 -->
    <div class="bg-white">
        <div class="third-main">
            <div class="third-main-fff">
                <div class="third-main-p">
                    <h1>이세상 모든 캠핑장을 정복할 때 까지</h1>
                    <p>캠핑은 이 세상의 모든 캠핑장을 담을때 까지 달리고 또 달립니다.</p>
                    <p>여러분과 함께!</p>
                    <a href="#">캠핑장 구경가기</a>
                </div>
            </div>
        </div>
    </div>
    <!-- 네번째 -->
    <div class="bg-white">
        <div class="last-main">
            <div class="last-left">
                <h2>추천캠핑장</h2>
                <img src="/img/puz.png" alt="" loading="lazy">
            </div>
            <div class="last-right">
                <h2>캠팡 추천 브랜드</h2>
                <div class="last-right-box">
                    <div>
                        <img src="/img/calmen.png" alt="" loading="lazy">
                        <p>콜맨</p>
                    </div>
                    <div>
                        <img src="/img/calmen.png" alt="" loading="lazy">
                        <p>콜맨</p>
                    </div>
                    <div>
                        <img src="/img/calmen.png" alt="" loading="lazy">
                        <p>콜맨</p>
                    </div>
                    <div>
                        <img src="/img/calmen.png" alt="" loading="lazy">
                        <p>콜맨</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
// 스크롤 이벤트
function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    }
}

function observeSections() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            } else {
                entry.target.classList.remove('visible');
            }
        });
    }, {
        threshold: 0.1
    });

    const sections = document.querySelectorAll('[data-section]');
    sections.forEach(section => observer.observe(section));
}

window.addEventListener('load', observeSections);
window.addEventListener('scroll', throttle(observeSections, 200));

//  캠핑러 캠핑장 버튼 

function toggleBtn() {
    const campingzang = document.querySelector('#campingzang');

    

}

// 카운터
const counter = ($counter, max) => {
  let now = 0;

  const handle = setInterval(() => {
    $counter.innerHTML = Math.ceil(now);

    // 목표 수치에 도달하면 정지
    if (now >= max) {
      clearInterval(handle);
      if (max === 100) {
        $counter.innerHTML = '100+'; // 목표 수치가 100이면 100+로 표시
      }
    } else {
      // 증가되는 값이 계속하여 작아짐
      const step = (max - now) / 10;
      // 값을 적용시키면서 다음 차례에 영향을 끼침
      now += step;
    }
  }, 50);
}

window.onload = () => {
  // 카운트를 적용시킬 모든 요소
  const $counters = document.querySelectorAll(".count");
  
  $counters.forEach(($counter, index) => {
    // 목표 수치 설정
    let max;

    if (index === 0) {
      max = 1000; // 첫 번째 항목의 목표 수치 설정
    } else if (index === 1 || index === 2) {
      max = 100; // 두 번째와 세 번째 항목의 목표 수치 설정
    }

    setTimeout(() => counter($counter, max), 2000 * index);
  });
};



</script>

<style>
@import url('../css/main.css');


</style>
