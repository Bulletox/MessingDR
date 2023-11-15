document.addEventListener('DOMContentLoaded', function () {
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const carouselContent = document.getElementById('carousel-content');
  
    let currentIndex = 0;
  
    prevBtn.addEventListener('click', function () {
      if (currentIndex > 0) {
        currentIndex--;
      } else {
        currentIndex = 3;
      }
      updateCarousel();
    });
  
    nextBtn.addEventListener('click', function () {
      if (currentIndex < 3) {
        currentIndex++;
      } else {
        currentIndex = 0;
      }
      updateCarousel();
    });
  
    function updateCarousel() {
      const translateValue = -currentIndex * 100 + '%';
      carouselContent.style.transform = 'translateX(' + translateValue + ')';
    }
  });
  