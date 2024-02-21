import Swiper from 'swiper';
import {Navigation, Pagination} from "swiper/modules";

Swiper.use([Pagination, Navigation]);

const swiper = new Swiper('.best-orders__swiper', {
  loop: false,
  slidesPerView: 5,
  spaceBetween: 25,
  keyboard: {
    enabled: true,
  },
  navigation: {
    nextEl: '.best-orders__btn--next',
    prevEl: '.best-orders__btn--prev',
  },
})