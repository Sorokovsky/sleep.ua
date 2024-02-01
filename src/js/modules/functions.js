import { burger, menu, header, } from "./variables.js";
export function openPopub(popub) {
    if (!popub.classList.contains('_active')) {
        popub.classList.add('_active');
    }
}
export function closePopub(popub) {
    if (popub.classList.contains('_active')) {
        popub.classList.remove('_active');
    }
}
const burgerToggle = () => {
    if (burger.classList.contains("_active")) {
        burger.classList.remove("_active");
        document.body.classList.remove("_lock");
        burger.children[0].classList.remove("_active");
        closePopub(menu);
    }
    else if (!burger.classList.contains("_active")) {
        burger.classList.add("_active");
        document.body.classList.add("_lock");
        burger.children[0].classList.add("_active");
        openPopub(menu);
    }
};
export const mobileMenu = () => {
    if (window.innerWidth <= 991) {
        burger.addEventListener('click', burgerToggle);
    }
};
export function paralaxOnMove(paralax) {
    if (window.innerWidth >= 991) {
        let centerX = window.innerWidth / 2, centerY = window.innerHeight / 2, paralaxX = 30, speed = 0.23, paralaxY = -30;
        paralax.style.transform = `translate(${paralaxX}px, ${paralaxY}px)`;
        document.addEventListener('mousemove', (e) => {
            if (e.clientX < centerX) {
                paralaxX = paralaxX - speed;
            }
            else if (e.clientX > centerX) {
                paralaxX = paralaxX + speed;
            }
            if (e.clientY > centerY) {
                paralaxY = paralaxY + speed;
            }
            else if (e.clientY < centerY) {
                paralaxY = paralaxY - speed;
            }
            paralax.style.transform = `translate(${paralaxX}px, ${paralaxY}px)`;
            centerY = e.clientY;
            centerX = e.clientX;
        });
    }
}
export const headerScroll = () => {
    headerFix();
    document.addEventListener('scroll', headerFix);
};
function headerFix() {
    let headerHeight = Number(window.getComputedStyle(header, null).getPropertyValue("height").replace("px", "")) / 2;
    if (window.scrollY > headerHeight) {
        console.log(window.scrollY >= headerHeight);
        header.classList.add("fixed");
    }
    else {
        header.classList.remove("fixed");
    }
}
export function isWebp() {
    function testWebP(callback) {
        let webP = new Image();
        webP.onload = webP.onerror = function () {
            callback(webP.height == 2);
        };
        webP.src = "data:image/webp;base64,UklGRjoAAABXRUJQVlA4IC4AAACyAgCdASoCAAIALmk0mk0iIiIiIgBoSygABc6WWgAA/veff/0PP8bA//LwYAAA";
    }
    testWebP(function (support) {
        if (support == true) {
            document.querySelector('body').classList.add('webp');
        }
        else {
            document.querySelector('body').classList.add('no-webp');
        }
    });
}
export async function registerServiceWarker() {
    if ('serviceWorker' in navigator) {
        const response = await navigator.serviceWorker.register('../sw.js');
    }
}
