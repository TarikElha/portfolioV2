/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// You can specify which plugins you need => Test Bootstrap.
import { Tooltip, Toast, Popover } from 'bootstrap';

// start the Stimulus application
import './bootstrap';








//Affichage modal homepage project picture
document.addEventListener("click", openModal);
const modal = document.querySelector(".modal");

function openModal(e){
    if(e.target.className === "imgProject"){
        const imgProjectElement = e.target;
        const imgProjectTitle = imgProjectElement.dataset.title;
        const imgProjectDescription = imgProjectElement.dataset.description;
        const imgProjectUrl = imgProjectElement.dataset.imageUrl;
        const imgProjectDate = imgProjectElement.dataset.date;
        const imgProjectSouces = imgProjectElement.dataset.sources;
        
        modal.style.display = "block";

        const headerModalTitle = document.createElement("div");
        headerModalTitle.className = "headerModalTitle title";
        const headerModalDate = document.createElement("div");
        headerModalDate.className = "headerModalDate";
        const mainModal = document.createElement("div");
        mainModal.className = "mainModal";
        const mainModalImage = document.createElement("img");
        mainModalImage.className = "mainModalImage";
        const mainModalDescription = document.createElement("div");
        mainModalDescription.className = "mainModalDescription";

        headerModalTitle.textContent = imgProjectTitle;
        headerModalDate.textContent = imgProjectDate;
        mainModalImage.src = "../uploads/projects/" + imgProjectUrl;
        mainModalDescription.textContent = imgProjectDescription;

        const arrayImgProjectSouces = JSON.parse(imgProjectSouces);
        let sources = document.createElement("div");
        const sourcesTitle = document.createElement("div");
        sourcesTitle.className = "title";
        sourcesTitle.innerHTML = "Sources :";

        sources.appendChild(sourcesTitle);

        let sourceContent = document.createElement("div");

        for(let i = 0; i<arrayImgProjectSouces.length; i++){
            sourceContent.innerHTML += arrayImgProjectSouces[i][0] + " : <br>" + arrayImgProjectSouces[i][1] + "<br><br>";
        }

        sources.appendChild(sourcesTitle);
        sources.appendChild(sourceContent);

        mainModalDescription.appendChild(sources);

        const modalContent = document.querySelector(".modalContent");
        const modalSubContent = document.createElement("div");
        modalSubContent.className = "modalSubContent";
        modalContent.appendChild(modalSubContent);

        modalSubContent.appendChild(headerModalTitle);
        modalSubContent.appendChild(headerModalDate);
        modalSubContent.appendChild(mainModal);
        mainModal.appendChild(mainModalImage);
        mainModal.appendChild(mainModalDescription);
    }
}

//fermeture modal => bouton fermer et clique exterieur à la fenêtre
const closeModalElement = document.querySelector(".closeModal");
closeModalElement.addEventListener("click", closeModal);

window.onclick = function(event) {
    if (event.target == modal) {
        closeModal();
    }
}

function closeModal(){
    document.querySelector(".modalSubContent").remove();
    modal.style.display = "none";
}

//clique sur dark/light mode button
document.querySelector('.buttonDarkLightMode').addEventListener('click', switchDarkLightMode);

function switchDarkLightMode(){
console.log('OK');
    const bodyElementStyle = getComputedStyle(document.body);

    //Si le fond est dark
    if(bodyElementStyle.backgroundColor == "rgb(40, 40, 40)"){
        document.body.style.backgroundColor = "#f2eee9";
        document.body.style.color = "black";

        document.querySelector('.modalContent').style.color = "black";
        document.querySelector('.modalContent').style.backgroundColor = "#f2eee9"

        document.querySelector('.buttonDarkLightMode').children[0].src = "/build/images/button/lightButton.png";
        document.querySelector('.contactHeader').children[0].style.color = "black";
        document.querySelector('.titleHeader').style.color = "black";
        
    }
    else{
        document.body.style.backgroundColor = "#282828";
        document.body.style.color = "#ffffff";

        document.querySelector('.modalContent').style.backgroundColor = "#282828";
        document.querySelector('.modalContent').style.color = "#ffffff";

        document.querySelector('.buttonDarkLightMode').children[0].src = "/build/images/button/darkButton.png";
        document.querySelector('.contactHeader').children[0].style.color = "#ffffff";
        document.querySelector('.titleHeader').style.color = "#ffffff";
    }
}

//Message flash duration
/* const flashMessage = document.querySelector(".flash-success");
flashMessage.style.opacity = "1";

setInterval(function(){
    if(flashMessage.style.opacity > 0)
        flashMessage.style.opacity-=0.05;
    else
        flashMessage.style.display = "none";
    },150); */


// SCROLL horizontal des photos de projet. Réagit avec la "molette" de la souris, nous allons l'implémenter avec des boutons.
let scrollAmount = 0;
const imageContainer = document.querySelector('.projectPictures');

imageContainer.addEventListener('wheel', (event) => {
    console.log("YATTAAA");
    event.preventDefault();
    const scrollDelta = event.deltaY * 0.2;
    scrollAmount += scrollDelta;
    imageContainer.scrollLeft = scrollAmount;
});
