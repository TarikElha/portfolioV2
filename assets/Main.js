import React from 'react';

export default class Main extends React.Component{    
    
    

    constructor(props){
        super(props);
    }

    /*

    componentDidMount() {
        if(this.props.collaboratorsData || this.props.sectionsData){
            this.setState({ 
                collaborators: JSON.parse(this.props.collaboratorsData),
                sections: JSON.parse(this.props.sectionsData),
            });
        }
      }

    //Metre à jour les données enfants
    handleChangeCollaborators(newCollaborators){
        this.setState({
            collaborators: newCollaborators
        });
    }

    handleChangeSections(newSections){
        this.setState({
            sections: newSections
        });
    }

    //Envoyer à l'enregistrement.
    handleClick(e){
        e.preventDefault();
        
        let formData = new FormData();
                    
        let objArr = {
            "title": document.getElementById('titleAnnounce').value,
            "collaborators": this.state.collaborators,
            "sections": this.state.sections,
        };

        formData.append('objArr',JSON.stringify(objArr))

        console.log(this.props.announceId);
        //Si c'est une édition d'annonce
        if(this.props.announceId){
            
            axios.post('/api/rh/announce/edit/'+this.props.announceId, formData)
            .then(function (response) {
                console.log('Edition de l annonce');
                console.log(response)
                document.getElementById('submitAnnounceMessage').innerHTML = response.data.message;

                document.getElementById("titleAnnounce").value = "";

                setTimeout(function(){document.location.href="/rh/announce";}, 4000);
                
                
            })
            .catch(function (error) {
                console.log('error:');
                console.log(error);
            });
        }
        //Sinon c'est une nouvelle annonce
        else{
            //axios setUser + setAnnonce. Envoyer title, sections et collaborators.
            axios.post('/api/rh/announce/new', formData)
                        .then(function (response) {
                            console.log('Creation de l annonce');
                            console.log(response)
                            document.getElementById('submitAnnounceMessage').innerHTML = response.data.message;

                            document.getElementById("titleAnnounce").value = "";

                            setTimeout(function(){document.location.href="/rh/announce";}, 4000);
                            
                            
                        })
                        .catch(function (error) {
                            console.log('error:');
                            console.log(error);
                        });
        } 
    }   */

    render() {
        return (
            <>
                <div id="firstImageHome">
                    <img src={"../uploads/projects/"+this.props.urls[0]} alt="Image projet"/>
                    <div id="masque"></div>
                </div>

{/*                {this.props.url.map((url, index) =>
                        {console.log(typeof(url[0]))}
                    )} */}

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
                            <li key={index} id={index}>
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
}
