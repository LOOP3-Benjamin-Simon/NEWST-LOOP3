//definér højden af main-HTML-tagget
const main = document.querySelector('main');
let main_height = main.clientHeight;

//definér højden af footeren
const footer = document.querySelector('footer');
let footer_height = footer.clientHeight;

//definér viewport-højden
let vp_height = window.innerHeight;

//Her undersøger vi, om der er nok indhold i "main"-containeren til at udfylde viewporten. 
//Hvis main-højden er mindre end viewporten, så skal footeren positioneres til absolute og derved fastgøres i bundet af viewporten.
//Hvis main-højden er større end viewporten, så skal footeren positioneres til relativ og følger dermed indholdet. 
if(main_height<vp_height){
    footer.setAttribute("style","position: absolute; bottom:0; width:100vw");
} else {
    footer.setAttribute("style","positon:relative; width:100vw");
}

