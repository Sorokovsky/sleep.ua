import { enableFilters, isWebp, mobileMenu, targetPage } from "./modules/functions.js";
import Swiper from "swiper";
import { Pagination, Autoplay } from "swiper/modules";
new Swiper(".swiper", {
    modules: [Pagination, Autoplay],
    loop: true,
    speed: 900,
    autoplay: {
        delay: 1000,
    },
    pagination: {
        el: '.swiper-pagination'
    }
});
isWebp();
targetPage();
mobileMenu();
enableFilters();
document.body.querySelectorAll("*").forEach((element) => {
    element.innerHTML.replace("��", "");
});