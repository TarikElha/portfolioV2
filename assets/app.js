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

// SWUP
import Swup from 'swup'
const swup = new Swup()

import Main from './Main';

import React from 'react';
import ReactDOM from 'react-dom';

import Cropper from 'cropperjs';
import axios from 'axios';
import Routing from '../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.js'
import Routes from './routes.json'

Routing.setRoutingData(Routes)

document.addEventListener("click", checkImage);
let currentReactInstance = null;
const modal = document.querySelector(".modal");

function checkImage(e){
    if(e.target.className === "logoHeader" || e.target.className === "titleHeader")
      ReactDOM.unmountComponentAtNode(document.getElementById('homePortfolio'));
    if(e.target.className === "imgProject"){

        ReactDOM.unmountComponentAtNode(document.getElementById('homePortfolio'));

        const imgProjectElement = e.target;
        const imgProjectTitle = imgProjectElement.dataset.title;
        const imgProjectDescription = imgProjectElement.dataset.description;

/*         // On va retirer le premier et dernier caractère de la chaîne qui correspond aux accolades=> [ ].
        const images = imgProjectElement.dataset.imageUrl.slice(1, imgProjectElement.dataset.imageUrl.length-1);
        
        // Ensuite nous supprimons les guillemets.
        const imagesFinish = images.replace('"', ''); */

        const images = imgProjectElement.dataset.imageUrl;
        let imagesClean=""
        for (let i = 0; i < images.length; i++) {
            if (images[i] !== '[' && images[i] !== ']' && images[i] !== '"'){
                imagesClean+=images[i];
            }

        }

        // Enfin, nous transformons la chaîne de caractères en tableau en utilisant le séparateur de la virgule.
        const imgProjectUrl = imagesClean.split(',');
        const imgProjectDate = imgProjectElement.dataset.date;
        const imgProjectSources = imgProjectElement.dataset.sources;
        const arrayImgProjectSources = JSON.parse(imgProjectSources);

        ReactDOM.render(<Main title={imgProjectTitle}
                            description={imgProjectDescription}
                            urls={imgProjectUrl}
                            dateData={imgProjectDate}
                            sources={arrayImgProjectSources}
                            />, document.getElementById('homePortfolio'));
    }
}








//Affichage modal homepage project picture
/* document.addEventListener("click", openModal);
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
} */

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
/* let scrollAmount = 0;
const imageContainer = document.querySelector('.projectPictures');

imageContainer.addEventListener('wheel', (event) => {
    console.log("YATTAAA");
    event.preventDefault();
    const scrollDelta = event.deltaY * 0.2;
    scrollAmount += scrollDelta;
    imageContainer.scrollLeft = scrollAmount;
}); */


// Caroussel




function HoverCarousel( elm, settings ){
    this.DOM = {
      scope: elm,
      wrap: elm.querySelector('ul').parentNode
    }
    
    this.containerWidth = 0;
    this.scrollWidth = 0;
    this.posFromLeft = 0;    // Stripe position from the left of the screen
    this.stripePos = 0;    // When relative mouse position inside the thumbs stripe
    this.animated = null;
    this.callbacks = {}
    
    this.init()
  }
  
  HoverCarousel.prototype = {
    init(){
      this.bind()
    },
    
    destroy(){
      this.DOM.scope.removeEventListener('mouseenter', this.callbacks.onMouseEnter)
      this.DOM.scope.removeEventListener('mousemove', this.callbacks.onMouseMove)
    },
  
    bind(){
      this.callbacks.onMouseEnter = this.onMouseEnter.bind(this)
      this.callbacks.onMouseMove = e => {
        if( this.mouseMoveRAF ) 
          cancelAnimationFrame(this.mouseMoveRAF)
  
        this.mouseMoveRAF = requestAnimationFrame(this.onMouseMove.bind(this, e))
      }
      
      this.DOM.scope.addEventListener('mouseenter', this.callbacks.onMouseEnter)
      this.DOM.scope.addEventListener('mousemove', this.callbacks.onMouseMove)
    },
    
    // calculate the thumbs container width
    onMouseEnter(e){
      this.nextMore = this.prevMore = false // reset
  
      this.containerWidth       = this.DOM.wrap.clientWidth;
      this.scrollWidth          = this.DOM.wrap.scrollWidth; 
      // padding in percentage of the area which the mouse movement affects
      this.padding              = 0.2 * this.containerWidth; 
      this.posFromLeft          = this.DOM.wrap.getBoundingClientRect().left;
      var stripePos             = e.pageX - this.padding - this.posFromLeft;
      this.pos                  = stripePos / (this.containerWidth - this.padding*2);
      this.scrollPos            = (this.scrollWidth - this.containerWidth ) * this.pos;
  
      // temporary add smoothness to the scroll 
      this.DOM.wrap.style.scrollBehavior = 'smooth';
      
      if( this.scrollPos < 0 )
        this.scrollPos = 0;
      
      if( this.scrollPos > (this.scrollWidth - this.containerWidth) )
        this.scrollPos = this.scrollWidth - this.containerWidth
  
      this.DOM.wrap.scrollLeft = this.scrollPos
      this.DOM.scope.style.setProperty('--scrollWidth',  (this.containerWidth / this.scrollWidth) * 100 + '%');
      this.DOM.scope.style.setProperty('--scrollLleft',  (this.scrollPos / this.scrollWidth ) * 100 + '%');
  
      // lock UI until mouse-enter scroll is finihsed, after aprox 200ms
      clearTimeout(this.animated)
      this.animated = setTimeout(() => {
        this.animated = null
        this.DOM.wrap.style.scrollBehavior = 'auto';
      }, 200)
  
      return this
    },
  
    // move the stripe left or right according to mouse position
    onMouseMove(e){
      // don't move anything until inital movement on 'mouseenter' has finished
      if( this.animated ) return
  
      this.ratio = this.scrollWidth / this.containerWidth
      
      // the mouse X position, "normalized" to the carousel position
      var stripePos = e.pageX - this.padding - this.posFromLeft 
      
      if( stripePos < 0 )
          stripePos = 0
  
      // calculated position between 0 to 1
      this.pos = stripePos / (this.containerWidth - this.padding*2) 
      
      // calculate the percentage of the mouse position within the carousel
      this.scrollPos = (this.scrollWidth - this.containerWidth ) * this.pos 
  
      this.DOM.wrap.scrollLeft = this.scrollPos
      
      // update scrollbar
      if( this.scrollPos < (this.scrollWidth - this.containerWidth) )
        this.DOM.scope.style.setProperty('--scrollLleft',  (this.scrollPos / this.scrollWidth ) * 100 + '%');
  
      // check if element has reached an edge
      this.prevMore = this.DOM.wrap.scrollLeft > 0
      this.nextMore = this.scrollWidth - this.containerWidth - this.DOM.wrap.scrollLeft > 5
      
      this.DOM.scope.setAttribute('data-at',
        (this.prevMore  ? 'left ' : ' ')
        + (this.nextMore ? 'right' : '')
      )
    }
  }






// Cropper////////////////////////////////////////////////////////////////
console.log("CROPPER");




const init = () => {

  let cropper;
  var preview = document.getElementById('imageProject')
  var file_input = document.getElementById('project_imageProject')

  window.previewFile  = function ()
  {
/*       if(document.getElementsByClassName("cropper-container")[0])
        document.getElementsByClassName("cropper-container")[0].remove();
      console.log("Erase !"); */

      let file = file_input.files[0]
      let reader = new FileReader()

      reader.addEventListener('load', function (event)
      {
          preview.src = reader.result

      }, false)

      if (file)
      {
        reader.readAsDataURL(file)
      }
  }

  if(preview){
    preview.addEventListener('load', function (event)
    {

      if (cropper) {
        cropper.destroy();
      }

        cropper = new Cropper(preview, {
            aspectRatio: 1/1
        })
    })
  }

  let form = document.getElementById('project_form')
  if(form){
    form.addEventListener('submit', function (event)
    {console.log("send");
        event.preventDefault()
        cropper.getCroppedCanvas({
            maxHeight: 1000,
            maxWidth: 1000
        }).toBlob(function (blob)
        {
            ajaxWithAxios(blob)
        })
    })
  }
  
  function ajaxWithAxios(blob)
  {
      //let url = "http://localhost:8000"+Routing.generate('project_image')
      let url = "http://localhost:8000/admin/project/image"
      console.log(url)
      let data = new FormData(form)
      console.log(data)
      data.append('file', blob)
      console.log(data)
      axios({
          method: 'post',
          url: url,
          data: data,
          headers: {
          'X-Requested-With': 'XMLHttpRequest',
          "Access-Control-Allow-Origin" : "*",
          },
      })
      .then((response) => {
          console.log(response)
      })
      .catch((error) => {
          console.error(error)
      })
  }



}

// Eviter le blocage du onChange par swup.
swup.on('contentReplaced', init);
document.addEventListener('DOMContentLoaded', function() {
  init();
});



/////////////////////////////////////////////////////////////////////











var carouselElm = document.querySelector('.carousel')
//console.log(carouselElm)

if (carouselElm){
  new HoverCarousel(carouselElm)
}

  // Assurez-vous que le script est chargé sur toutes les pages
document.addEventListener("DOMContentLoaded", function() {
  // Initialisez le carrousel sur la page d'accueil
  if (window.location.pathname === '/') {
    var carouselElm = document.querySelector('.carousel');
    new HoverCarousel(carouselElm);
  }
});


// Écoutez l'événement de transition de page de Swup
document.addEventListener('swup:contentReplaced', function() {
  // Réinitialisez le carrousel sur la nouvelle page
  var carouselElm = document.querySelector('.carousel');
  if (carouselElm) {
    new HoverCarousel(carouselElm);
  }
});
