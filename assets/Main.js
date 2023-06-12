import React, { Component } from "react";
import ReactDOM from 'react-dom';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
gsap.registerPlugin(ScrollTrigger);


class Main extends Component {

    state = {
        selectedImage: null,
    };

  componentDidMount() {
    // Sélectionnez toutes les images à animer
    const images = document.querySelectorAll('.imageDetailHomepage');
    const details = document.querySelectorAll('.detailHomepage');

    // Parcourez chaque image et ajoutez une animation avec ScrollTrigger
    images.forEach((image) => {
      gsap.to(image, {
        opacity: 1, // Opacité finale
        duration: 0.5, // Durée de l'animation
        scrollTrigger: {
          trigger: image, // Élément déclencheur (lui-même)
          start: 'top 80%', // Déclenche l'animation lorsque l'image atteint 80% de la fenêtre visible
        },
      });
    });

    details.forEach((detail) => {
        gsap.to(detail, {
          opacity: 1, // Opacité finale
          duration: 0.5, // Durée de l'animation
          scrollTrigger: {
            trigger: detail, // Élément déclencheur (lui-même)
            start: 'top 80%', // Déclenche l'animation lorsque l'image atteint 80% de la fenêtre visible
          },
        });
      });
  }

  componentWillUnmount() {
    // Supprimer les animations et les déclencheurs ScrollTrigger
    gsap.killTweensOf('.imageDetailHomepage');
    ScrollTrigger.getAll().forEach((trigger) => {
      trigger.kill();
    });
  }


  render() {
    return (
      <>

        <section id="firstImageHome">
          <img className="detailHomepage" src={"../uploads/projects/" + this.props.urls[0]} alt="Image projet" />
          <div id="masque"></div>
        </section>
        <h1 className="title detailHomepage">{this.props.title + " ( "+ this.props.dateData + " )"}</h1>
        <section className="descriptionHomepage detailHomepage">
          <p>{this.props.description}</p>
          <p>
            <b>Sources :</b>
            <ul>
              {this.props.sources.map((source, index) => (
                <li key={index} id={index}>
                  <i>{this.props.sources[index][0]}</i> : {this.props.sources[index][1]}
                </li>
              ))}
            </ul>
          </p>
        </section>

        <section className="galleryDetailHomepage">
            <ul>
                {this.props.urls.map((url, index) =>
                    <li key={index} id={index}>
                        {index===0 ? "" : (index%2 === 0 ? <img className="imageDetailHomepage imageDetailHomepageRight" src={"../uploads/projects/"+this.props.urls[index]} alt="Image projet"/> : <img className="imageDetailHomepage imageDetailHomepageLeft" src={"../uploads/projects/"+this.props.urls[index]} alt="Image projet"/>)}
                    </li>
                )}
            </ul>
            <div id="lastImageHome">
                <img src={"../uploads/projects/"+this.props.urls[0]} alt="Image projet"/>
            </div>
        </section>

      </>
    );
  }
}

export default Main;



/* 
  render() {
    const { visibleSections } = this.state;


    return (
      <div>
        <Element name="firstImageHome" className="element">
          <div id="firstImageHome">
            <img src={"../uploads/projects/" + this.props.urls[0]} alt="Image projet" />
            <div id="masque"></div>
          </div>
        </Element>
        <h1 className="title">{this.props.title + " ( " + this.props.dateData + " )"}</h1>
        <section className="descriptionHomepage">
          <p>{this.props.description}</p>
          <p>
            <b>Sources :</b>
            <ul>
              {this.props.sources.map((source, index) => (
                <li key={index} id={index}>
                  <i>{this.props.sources[index][0]}</i> : {this.props.sources[index][1]}
                </li>
              ))}
            </ul>
          </p>
        </section>
        <section className="galleryDetailHomepage">
          <ul>
            {this.props.urls.map((url, index) => (
              <li key={index} id={index}>
                <Element name={`section${index}`} className="section" ref={ref => this.state.sectionRefs['section'+{index}] = ref}>
                    <div className={`imageDetailHomepage ${visibleSections.includes(`section${index}`) ? 'hovered' : ''}`}>
                        <img src={"../uploads/projects/" + this.props.urls[index]} alt="Image projet" />
                    </div>
                </Element>
              </li>
            ))}
          </ul>
          <div id="lastImageHome">
            <img src={"../uploads/projects/" + this.props.urls[0]} alt="Image projet" />
          </div>
        </section>
      </div>
    );
  }
}

export default Main;
 */



/* 

  render() {

    return (
      <div>
        <section id="firstImageHome">
          <img src={"../uploads/projects/" + this.props.urls[0]} alt="Image projet" />
          <div id="masque"></div>
        </section>
        <h1 className="title">{this.props.title + " ( "+ this.props.dateData + " )"}</h1>
        <section className="descriptionHomepage">
          <p>{this.props.description}</p>
          <p>
            <b>Sources :</b>
            <ul>
              {this.props.sources.map((source, index) => (
                <li key={index} id={index}>
                  <i>{this.props.sources[index][0]}</i> : {this.props.sources[index][1]}
                </li>
              ))}
            </ul>
          </p>
        </section>
        <section className="galleryDetailHomepage">
          <ul>
            {this.props.urls.map((url, index) => (
              <li key={index} id={index}>
                <Element name={`image${index}`} className="element">

                {index === 0 ? (
                  ''
                ) : index % 2 === 0 ? (
                    <img
                    className={`imageDetailHomepageRight imageDetailHomepage ${this.state.hoveredImage === index ? 'hovered' : ''}`}
                    src={"../uploads/projects/" + this.props.urls[index]}
                    alt="Image projet"
                    onMouseEnter={() => this.handleHover(index)}
                    onMouseLeave={() => this.handleHover(null)}
                    onClick={() => this.scrollToImage(index)}
                  />
                ) : (
                    <img
                    className={`imageDetailHomepageLeft imageDetailHomepage ${this.state.hoveredImage === index ? 'hovered' : ''}`}
                    src={"../uploads/projects/" + this.props.urls[index]}
                    alt="Image projet"
                    onMouseEnter={() => this.handleHover(index)}
                    onMouseLeave={() => this.handleHover(null)}
                    onClick={() => this.scrollToImage(index)}
                  />
                )}


                  
                </Element>
              </li>
            ))}
          </ul>
          <div id="lastImageHome">
            <img src={"../uploads/projects/" + this.props.urls[0]} alt="Image projet" />
          </div>
        </section>
      </div>
    );
  }
}

export default Main; */






/*

    render() {

        const { isHovered } = this.state;

        return (
            <>
                <div id="firstImageHome" className={`hover-transition ${isHovered ? 'hovered' : ''}`}>
                    <img src={"../uploads/projects/"+this.props.urls[0]} alt="Image projet"/>
                    <div id="masque"></div>
                </div>

                <h1 className="title">{this.props.title + " ( "+ this.props.dateData + " )"}</h1>
                <section className="descriptionHomepage">
                    <p>{this.props.description}</p>
                    <p>
                        <b>Sources :</b> <ul>
                                            {this.props.sources.map((source, index) =>
                                                <li key={index} id={index}>
                                                    <i>{this.props.sources[index][0]}</i> : {this.props.sources[index][1]}
                                                </li>
                                            )}
                                        </ul>
                    </p>
                </section>

                <section className="galleryDetailHomepage">
                    <ul>
                        {this.props.urls.map((url, index) =>
                            <li key={index} id={index} className={`hover-transition ${isHovered ? 'hovered' : ''}`}>
                                {index===0 ? "" : (index%2 === 0 ? <img className="imageDetailHomepageRight" src={"../uploads/projects/"+this.props.urls[index]} alt="Image projet"/> : <img className="imageDetailHomepageLeft" src={"../uploads/projects/"+this.props.urls[index]} alt="Image projet"/>)}
                            </li>
                        )}
                    </ul>
                    <div id="lastImageHome">
                        <img src={"../uploads/projects/"+this.props.urls[0]} alt="Image projet"/>
                    </div>
                </section>
                
            </>
        );
    }
} */
