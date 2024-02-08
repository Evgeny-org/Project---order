var swiper = new Swiper('#js-carousel', {  
  slidesPerView: 7,
  spaceBetween: 30,
  speed: 3000,
  loop: true,
  //allowTouchMove: false, // можно ещё отключить свайп
  autoplay: {
    delay: 0,
    disableOnInteraction: false // или сделать так, чтобы восстанавливался autoplay после взаимодействия
  }
});