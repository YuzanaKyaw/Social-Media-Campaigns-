// google translate
function googleTranslateElementInit() {
    new google.translate.TranslateElement({ pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.Vertical }, 'google_translate_element');
}

// admin navbar item
let menuItem = document.querySelectorAll('.admin-navbar li');

menuItem.forEach((item) => {

    item.addEventListener('click', () => {

        let active = item.classList.contains('active');

        menuItem.forEach((el) => {
            el.classList.remove('active');
        });
        if (active) item.classList.remove('active');
        else item.classList.add('active');
    });
});



// toogle button 

let tooglebtn = document.querySelector('#nav-toogle');
let sidenav = document.querySelector('.admin-navbar');
tooglebtn.addEventListener('click', navActive);

function navActive() {
    let navactive = sidenav.classList.contains('nav-active');
    if (navactive) sidenav.classList.remove('nav-active');
    else sidenav.classList.add('nav-active')
}

function deleteConfirm(id) {

    if (confirm("Are you sure? You want to delete")) {
        window.location = 'delete_category.php?id=' + id;
    } else {
        alert("Cancel");
    }
}

function deleteContent(id) {
    if (confirm("Are you sure? You want to delete this content.")) {
        window.location = 'delete_content.php?id=' + id;
    } else {
        alert("Cancel");
    }

}



// slide show

// let slider = document.querySelector('.slide-show .slider');
//     let slideItem = document.querySelectorAll('.slide-show .slider .slide-item');
//     let slideNav = document.querySelectorAll('.slide-show .slide-nav li');
//     let prev = document.getElementById('prev');
//     let next = document.getElementById('next');
//     let active = 0;
//     let lengthItems = slideItem.length - 1;

//     next.onclick = function() {
//         if (active + 1 > lengthItems) {
//             active = 0
//         } else {
//             active = active + 1
//         }
//         reloadSlideshow();
//     }

//     prev.onclick = function(){
//         if(active-1<0){
//             active=lengthItems
//         }else{
//             active=active-1
//         }
//         reloadSlideshow();
//     }

//     // slideNav.forEach(li,key)=>(
//     //     li.addEventListener('click',function(){
//     //         active=key;
//     //         reloadSlideshow()
//     //     })
//     // )
//     function reloadSlideshow() {
//         let checkLeft = slideItem[active].offsetLeft;
//         slider.style.left = -checkLeft + 'px';

//         // let activeEle = document.querySelectorAll('.slide-show .slide.nav li.slide-active');
//         // activeEle.classList.remove('slide-active');
//         // slideNav[active].classList.add('slide-active');
//     }