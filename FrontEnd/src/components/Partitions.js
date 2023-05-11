import React from "react";
import { Container, Row, Col } from 'react-bootstrap';
import ListeArtistes from './ListeArtistes';
import AjoutArtiste from './AjoutArtiste';
import AjoutCompo from './AjoutCompo';
import ListeCompos from "./ListeCompos";
import ListePartitions from './ListePartitions';
import AjoutPartition from './AjoutPartition';
import Api from '../utils/Api';

class Partitions extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
        isLoaded : false,
        artisteSelect : null,
        compositionSelect : null,
        listeCompositions: null,
        listePeriodes: null,
        listeArtistes : [],
    };
    this.ajouterArtiste = this.ajouterArtiste.bind(this);
    this.ajouterCompo = this.ajouterCompo.bind(this);
    this.ajouterPartition = this.ajouterPartition.bind(this);
    this.recupererCompositions = this.recupererCompositions.bind(this);
    this.recupererPartitions = this.recupererPartitions.bind(this);
    this.downloadPartition = this.downloadPartition.bind(this);
    this.deletePartition = this.deletePartition.bind(this);
    this.modifierCompo = this.modifierCompo.bind(this);
  }

  componentDidMount() {
    this.recupererArtistes();
    this.recupererPeriode();
  }

  recupererPeriode = () => {
    Api({
      method: 'get',
      url: '/periode',
    })
    .then((reponse) => {
      const listePeriodes = reponse.data;
      this.setState({ 
          listePeriodes : listePeriodes,
          isLoaded : true
      }); 
    });
  }

  recupererArtistes = () => {
      Api({
          method: 'get',
          url: '/artiste',
        })
        .then((reponse) => {
          const listeArtistes = reponse.data;
          this.setState({ 
              listeArtistes : listeArtistes,
              isLoaded : true
          }); 
        });
  }

  recupererCompositions(artisteId) {
    Api({
        method: 'post',
        url: '/compositions',
        data: {
          'artiste': artisteId,
        }
      })
      .then((reponse) => {
        const listeCompositions = reponse.data;
        const artiste = this.state.listeArtistes.find(( artiste ) => artiste.id == artisteId);
        this.setState({ 
            artisteSelect: artiste,
            listeCompositions: listeCompositions,
            isLoaded: true
        }); 
      });
  }

  recupererPartitions(compositionId) {
    Api({
        method: 'post',
        url: '/partitions',
        data: {
          'id_composition': compositionId,
        }
      })
      .then((reponse) => {
        const listePartitions = reponse.data;
        const composition = this.state.listeCompositions.find(( composition ) => composition.id == compositionId);
        this.setState({ 
            compositionSelect: composition,
            listePartitions: listePartitions,
            isLoaded: true
        }); 
      });
  }

  ajouterArtiste(artiste) {
    Api({
      method: 'POST',
      url: '/artiste',
      data: {
        'nom': artiste.nom,
        'description': artiste.description,
      }
    })
    .then((response) => {
      artiste.id = response.data.id;
      const artistes = [...this.state.listeArtistes, artiste];
      this.setState({listeArtistes: artistes});
    })
  }

  ajouterCompo(compo) {
    Api({
      method: 'POST',
      url: '/composition',
      data: {
        'id_periode': compo.id_periode,
        'id_artiste': compo.id_artiste,
        'nom': compo.nom,
        'description': compo.description,
      }
    })
    .then((response) => {
      compo.id = response.data.id;
      const compos = [...this.state.listeCompositions, compo];
      this.setState({listeCompositions: compos});
    })
  }

  modifierCompo(compo) {
    Api({
      method: 'put',
      url: '/composition',
      params: {
        'id': compo.id,
        'id_periode': compo.id_periode,
        'nom': compo.nom,
        'description': compo.description,
      }
    })
    .then((response) => {
      console.log(response);
      this.recupererCompositions(this.state.artisteSelect.id);
    });
  }

  ajouterPartition(formData, partition) {
    formData.append('id_periode', partition.id_periode);
    formData.append('id_composition', partition.id_composition);
    formData.append('nom', partition.nom);
    formData.append('upload_par', partition.upload_par);

    Api({
      method: 'POST',
      url: '/partition',
      data: formData,
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
    .then((response) => {
      partition.id = response.data.id;
      const partitions = [...this.state.listePartitions, partition];
      this.setState({listePartitions: partitions});
    })
  }

  downloadPartition(partition) {
    Api({
      method: 'get',
      url: '/partitionDownload',
      responseType: 'blob',
      params: {
        'id': partition.id
      }
    })
    .then((response) => {
      const href = URL.createObjectURL(response.data);  
      const link = document.createElement('a');
      link.href = href;
      link.setAttribute('download', partition.nom_fichier);
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
      URL.revokeObjectURL(href);
    });
  }

  deletePartition(id) {
    Api({
      method: 'delete',
      url: '/partition',
      params: {
        'id': id
      }
    })
    .then((response) => {
      this.recupererPartitions(this.state.compositionSelect.id);
    });
  }

  render() {
    if(!this.state.isLoaded) {
      return(<h1>Chargement en cours...</h1>);
    }

    if(this.state.compositionSelect != null){
      return (
        <Container>
          <Row className="pt-5">
            <AjoutPartition ajouterPartition={this.ajouterPartition} compositionSelect={this.state.compositionSelect}></AjoutPartition>
          </Row>
          <Row className="pt-5">
            <Col><h2>Télécharger une partition</h2></Col>
          </Row>
          <ListePartitions listePartitions={this.state.listePartitions} downloadPartition={this.downloadPartition} deletePartition={this.deletePartition}></ListePartitions>
        </Container>
      );
    }
    else if(this.state.artisteSelect != null){
      return (
        <Container>
          <Row className="pt-5">
            <AjoutCompo ajouterCompo={this.ajouterCompo} artisteSelect={this.state.artisteSelect} listePeriodes={this.state.listePeriodes}></AjoutCompo>
          </Row>
          <Row className="pt-5">
            <Col><h2>Choisir une composition</h2></Col>
          </Row>
          <ListeCompos modifierCompo={this.modifierCompo} recupererPartitions={this.recupererPartitions} listeCompositions={this.state.listeCompositions} listePeriodes={this.state.listePeriodes}></ListeCompos>
        </Container>
      );
    }
    return (
      <Container>
        <Row className="pt-5">
          <AjoutArtiste ajouterArtiste={this.ajouterArtiste}></AjoutArtiste>
        </Row>
        <Row className="pt-5">
          <Col><h2>Choisir un artiste</h2></Col>
        </Row>
        <ListeArtistes recupererCompositions={this.recupererCompositions} listeArtistes={this.state.listeArtistes}></ListeArtistes>
      </Container>
    );
  }
}

export default Partitions;