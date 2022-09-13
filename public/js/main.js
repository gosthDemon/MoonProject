//Declaramos variables
var body = document.getElementById("body");
var side_menu = document.getElementById("main_container");
var nav_menu = document.getElementById("nav");
let listElements = document.querySelectorAll('.list__button--click');
const elements = document.querySelectorAll('.open');
const activeList = document.querySelectorAll('.nav__link--inside');
const btn_open = document.querySelectorAll('.btn-open');

//Abrir el sub manu al cargar la pagina
window.onload = open_subMenu();
function open_subMenu () {
    activeList.forEach((element) => {
        if(element.classList.contains( 'active-button' )){
                let height = 0;
                let parentElement = element.parentNode;
                let grandparent = parentElement.parentNode;
                let arrowElement = grandparent.previousElementSibling;
                arrowElement.classList.toggle('arrow');
                arrowElement.children[0].classList.add('active-button');
                arrowElement.children[1].classList.add('active-button');
                
                if(grandparent.clientHeight == "0"){
                    height=grandparent.scrollHeight;
                }
                grandparent.style.height = `${height}px`;
        }
    })
}

//Open Close Menu
btn_open.forEach((element) => {
    element.addEventListener('click', function(){
            open_close_menu();
    })
})

//Close menu if screen < 760px
if(window.innerWidth > 760){
    body.classList.add("body_move");
    side_menu.classList.add("menu__side_move");
}else{
    body.classList.add("body_remove");
    side_menu.classList.add("menu__side_remove");
}

//Evento para mostrar y ocultar menú
function open_close_menu(){
    //Si la pantalla es menor a 760px
    if(window.innerWidth < 760){
        if(body.classList.contains( 'body_move' )){
            body.classList.add("body_remove");
            side_menu.classList.add("menu__side_remove");
        }else{
            body.classList.remove("body_remove");
            side_menu.classList.remove("menu__side_remove");
        }
    }
    //Si es mayor a 760px
    body.classList.toggle("body_move");
    side_menu.classList.toggle("menu__side_move");
    if(body.classList.contains('body_move')){
        nav_menu.classList.remove("back-menu");
    }else{
        nav_menu.classList.add("back-menu");
    }
    
}

//Open Sub Menu y girar elemento
listElements.forEach(listElement => {
    listElement.addEventListener('click', ()=>{
        listElement.classList.toggle('arrow');
        let height = 0;
        let menu = listElement.nextElementSibling;
        if(menu.clientHeight == "0"){
            height=menu.scrollHeight;
        }
        menu.style.height = `${height}px`;
    })
});

//Abrir el menu con los botones de submenus
elements.forEach((element) => {
    element.addEventListener('click', function(){
        body.classList.add("body_move");
        side_menu.classList.add("menu__side_move");
        if(body.classList.contains('body_move')){
            nav_menu.classList.remove("back-menu");
        }else{
            nav_menu.classList.add("back-menu");
        }
    })
})


