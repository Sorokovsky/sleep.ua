import { isWebp, mobileMenu } from "./modules/functions.js";
import Swiper from "swiper";
import { Pagination, Autoplay } from "swiper/modules";
new Swiper(".swiper", {
    modules: [Pagination, Autoplay],
    loop: true,
    autoplay: {
        delay: 500
    },
    pagination: {
        el: '.swiper-pagination'
    }
});
isWebp();
mobileMenu();
