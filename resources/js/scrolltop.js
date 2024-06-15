import { ref, onMounted } from 'vue';

export function useBackToTop() {
  const btnBackToTop = ref(null);

  onMounted(() => {
    window.addEventListener('scroll', handleScroll);
  });

  function handleScroll() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
      btnBackToTop.value.style.display = 'block';
    } else {
      btnBackToTop.value.style.display = 'none';
    }
  }

  function backToTop() {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  }

  return {
    btnBackToTop,
    backToTop
  };
}
