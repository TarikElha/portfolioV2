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
        mainModalImage.src = imgProjectUrl;
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
