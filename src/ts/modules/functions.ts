import { burger, menu, header, } from "./variables.js";
export function openPopub(popub:HTMLElement | Element): void{
    if(!popub.classList.contains('_active')){
        popub.classList.add('_active');
    }
}
export function closePopub(popub:HTMLElement| Element){
    if(popub.classList.contains('_active')){
        popub.classList.remove('_active');
    }
}
const burgerToggle = () => {
    if(burger!.classList.contains("_active")){
        burger!.classList.remove("_active");
        document.body.classList.remove("_lock");
        burger!.children[0].classList.remove("_active");
        closePopub(menu!); 
    }
    else if(!burger!.classList.contains("_active")){
        burger!.classList.add("_active");
        document.body.classList.add("_lock");
        burger!.children[0].classList.add("_active");
        openPopub(menu!);
    }
}
export const mobileMenu = () =>{
    if (window.innerWidth <= 991) {
        burger!.addEventListener('click', burgerToggle);
    }
}
export function paralaxOnMove(paralax:HTMLElement){
    if (window.innerWidth >= 991){
        let centerX = window.innerWidth / 2,
        centerY = window.innerHeight / 2,
        paralaxX = 30,
        speed = 0.23,
        paralaxY = -30;
    paralax.style.transform = `translate(${paralaxX}px, ${paralaxY}px)`;
    document.addEventListener('mousemove', (e) => {
        if(e.clientX < centerX){
            paralaxX = paralaxX - speed;           
        }
        else if(e.clientX > centerX){
            paralaxX = paralaxX + speed;           
        }
        if(e.clientY > centerY){
            paralaxY = paralaxY + speed;           
        }
        else if(e.clientY < centerY){
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
}
function headerFix(){
    let headerHeight:number = Number(window.getComputedStyle(header!, null).getPropertyValue("height").replace("px", "")) /2;
    if(window.scrollY > headerHeight){
        console.log(window.scrollY >= headerHeight);
        header!.classList.add("fixed");
    }else{
        header!.classList.remove("fixed");
    }
}
export function isWebp(){
    function testWebP(callback:Function) {

        let webP = new Image();
        webP.onload = webP.onerror = function () {
        callback(webP.height == 2);
        };
        webP.src = "data:image/webp;base64,UklGRjoAAABXRUJQVlA4IC4AAACyAgCdASoCAAIALmk0mk0iIiIiIgBoSygABc6WWgAA/veff/0PP8bA//LwYAAA";
        }
        
        testWebP(function (support:boolean) {
        
        if (support == true) {
        document.querySelector('body')!.classList.add('webp');
        }else{
        document.querySelector('body')!.classList.add('no-webp');
        }
    });
}
export async function registerServiceWarker():Promise<void>{
    if ('serviceWorker' in navigator) {
        const response = await navigator.serviceWorker.register('../sw.js');
    }
}
export function targetPage() {
    const menuLinks: NodeListOf<HTMLAnchorElement> = document.querySelectorAll(".menu__link");
    menuLinks.forEach((item: HTMLAnchorElement) => {
        if(item.href == location.href || item.href.replace("//", "") == location.href)
        {
            item.classList.add("_active");
        }
    });
}
export function enableFilters(selector: string = '.checkbox > input'): void {
    let currentLocation: string = location.href;
    const filters: NodeListOf<HTMLInputElement> = document.querySelectorAll(selector);
    filters.forEach((filter: HTMLInputElement) => {
        filter.onchange = (event: Event ) => {
           const target: HTMLInputElement = event.target as HTMLInputElement;
           let resultLocation: string = currentLocation;
           if(target.checked) {
            if(currentLocation.endsWith("/")) {
                resultLocation += "?"; 
            } else {
                resultLocation += "&";
            }
            resultLocation += target.name + '=' + target.value;
            
           }
           else
           {
            if(currentLocation.includes(`?${target.name}=${target.value}`)) {
                resultLocation = currentLocation.replace(`?${target.name}=${target.value}`, '');
            } else {
                resultLocation = resultLocation.replace(`&${target.name}=${target.value}`, '');
            }
            resultLocation = resultLocation.replace("/&", "/?");
           }
           const timer = setTimeout(() => {
            location.href = resultLocation;
        }, 500);

        }
    });
}