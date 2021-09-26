" use strict";
let section_left    = document.querySelector('section.left_section');

let mode_d_emploi = [
    'Simplifiez votre saisie en utilisant les caractères en minuscule',
    'Précisez les voyelles accentuées: à-â-ä-é-è-ê-ë-ì-î-ï-ò-ô-ö-ù',
    'Si besoin la cédille de la lettre ç avec la touche 9 du clavier alphabétique',
    'Pour les prénoms composés, utilisez le tiret de la touche 6 du clavier alphabétique',
    'Séparez tous vos pénoms par un espace',
    'Indiquez vos pénoms dans le même ordre que votre fiche d\'état civil'
]

let screen_mobile = false;

if (innerWidth <950){
    
    screen_mobile = true;

    let section_details  = document.createElement('details');
    section_left.appendChild(section_details);

    let section_summary  = document.createElement('summary');
    section_summary.textContent = "Cliquez pour obtenir les consignes à respecter pour la saisie du formulaire";
    section_details.appendChild(section_summary);

    let section_div  = document.createElement('div');
    section_div.className += 'rules';
    section_details.appendChild(section_div);
    
    let section_ul  = document.createElement('ul');
    section_div.appendChild(section_ul);
    mode_d_emploi.forEach(texte => {
        let section_li  = document.createElement('li');
        section_li.textContent = texte;
        section_ul.appendChild(section_li);
    });

}
else {

    screen_mobile = false;

    let section_div  = document.createElement('div');
    section_div.className += 'rules';
    section_left.appendChild(section_div);
    
    let section_ul  = document.createElement('ul');
    section_div.appendChild(section_ul);
    mode_d_emploi.forEach(texte => {
        let section_li  = document.createElement('li');
        section_li.textContent = texte;
        section_ul.appendChild(section_li);
    });

}

window.addEventListener('resize', ()=>{
    if (innerWidth <950 && screen_mobile == false){

        screen_mobile = true;
        section_div.remove();
        section_summary.remove();
        section_details.remove();
        
        let section_details  = document.createElement('details');
        section_left.appendChild(section_details);

        let section_summary  = document.createElement('summary');
        section_summary.textContent = "Cliquez pour obtenir les consignes à respecter pour la saisie du formulaire";
        section_details.appendChild(section_summary);
        let section_div  = document.createElement('div');
            section_div.className += 'rules';
            section_left.appendChild(section_div);
            
            let section_ul  = document.createElement('ul');
            section_div.appendChild(section_ul);
            mode_d_emploi.forEach(texte => {
                let section_li  = document.createElement('li');
                section_li.textContent = texte;
                section_ul.appendChild(section_li);
            });
    }
    else {
        if (innerWidth > 950 && screen_mobile == true){
            screen_mobile = false;

            section_div.remove();
            section_summary.remove();
            section_details.remove();

            let section_div  = document.createElement('div');
            section_div.className += 'rules';
            section_left.appendChild(section_div);
            
            let section_ul  = document.createElement('ul');
            section_div.appendChild(section_ul);
            mode_d_emploi.forEach(texte => {
                let section_li  = document.createElement('li');
                section_li.textContent = texte;
                section_ul.appendChild(section_li);
            });
        
        }
    }
});