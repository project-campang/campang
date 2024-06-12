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
                <button type="button" class="main-rank-btn-right"><h3>캠핑장</h3></button>
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
                    <img src="/img/logo-ko3.png" alt="">
                    <p>100+</p>
                    <p>가입유저수</p>
                </div>
                <div>
                    <img src="/img/logo-ko3.png" alt="">
                    <p>100+</p>
                    <p>도장갯수</p>
                </div>
                <div>
                    <img src="/img/logo-ko3.png" alt="">
                    <p>100+</p>
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
</script>
<style>
@import url('../css/main.css');


</style>
