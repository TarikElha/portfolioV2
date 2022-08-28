/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

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

        
        modal.style.display = "block";
        //modal.innerHTML = imgProjectTitle+" / "+imgProjectDescription+" / "+imgProjectUrl+" / "+imgProjectDate;

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
const flashMessage = document.querySelector(".flash-success");
flashMessage.style.opacity = "1";

setInterval(function(){
    if(flashMessage.style.opacity > 0)
        flashMessage.style.opacity-=0.05;
    else
        flashMessage.style.display = "none";
    },150);

