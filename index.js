" use strict";
let section_left        = document.querySelector('section.left_section');
let section_rules       = document.querySelector('div.rules');

let section_details     = document.createElement('details');
let section_summary     = document.createElement('summary');

let screen_mobile = false;

function active_details(){
    screen_mobile = true;
    document.querySelector('div.rules').remove();
    section_left.prepend(section_details);
    section_summary.textContent = "Cliquez pour obtenir les consignes à respecter pour la saisie du formulaire";
    section_details.prepend(section_summary);
    section_details.prepend(section_rules);
}; 

if (innerWidth <950){
    active_details();
}
else {
    screen_mobile = false;
}

window.addEventListener('resize', ()=>{
    if (innerWidth <950 && screen_mobile == false){
        active_details();
    }
    else {
        if (innerWidth > 950 && screen_mobile == true){
            screen_mobile = false;
            document.querySelector('summary').remove();
            document.querySelector('details').remove();
            section_left.prepend(section_rules);
        }
    }
});