import { isWebp } from "./modules/functions.js";
isWebp();
const menuLinks = document.querySelectorAll(".menu__link");
menuLinks.forEach((item) => {
    if (item.href == location.href) {
        item.classList.add("active");
    }
});
