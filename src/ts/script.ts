import { isWebp } from "./modules/functions.js";
isWebp();
const menuLinks: NodeListOf<HTMLAnchorElement> = document.querySelectorAll(".menu__link");
menuLinks.forEach((item: HTMLAnchorElement) => {
    if(item.href == location.href)
    {
        item.classList.add("active");
    }
});