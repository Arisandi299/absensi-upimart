export function navbar(){
    const navbar = document.querySelector("nav");
    const menu = document.querySelector(".list");
    const exit = document.querySelector(".close");

    menu.onclick = () => {
        navbar.classList.add("show");
    }

    exit.onclick = () => {
        navbar.classList.remove("show")
    }

}