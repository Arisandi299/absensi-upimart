const closes = document.querySelector(".close");
const menu = document.querySelector(".menu");
const nav = document.querySelector("nav")

export function Navbar () {
    menu.onclick = e => {
        nav.classList.add("show-nav");
    }
    
    closes.onclick = e => {
        nav.classList.remove("show-nav")
    }
}