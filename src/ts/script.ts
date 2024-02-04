import { isWebp, mobileMenu } from "./modules/functions.js";
import Swiper from "swiper";
import { Pagination, Autoplay } from "swiper/modules";
new Swiper(".swiper", {
    modules: [Pagination, Autoplay],
    loop: true,
    speed: 500,
    autoplay: {
        delay: 1000,
    },
    pagination: {
        el: '.swiper-pagination'
    }
});
isWebp();
mobileMenu(); 