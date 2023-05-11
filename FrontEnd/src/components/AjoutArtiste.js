import React from 'react';
import { Container, Row, Col } from 'react-bootstrap';
import Button from 'react-bootstrap/Button';
import Form from 'react-bootstrap/Form';
import Api from '../utils/Api';

class AjoutArtiste extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      nom:'',
      description:'',
    }

    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
    this.clearInput = this.clearInput.bind(this);
  }

  handleChange(event) {
    const name = event.target.name;
    const value = event.target.value;

    this.setState({
        [name]: value
    });
  }

  handleSubmit = (e) => {
    const artiste = {
      nom: this.state.nom,
      description: this.state.description,
    };
    this.props.ajouterArtiste(artiste);
    e.preventDefault();
    this.clearInput();
  }

  clearInput() {
    this.setState({
      nom: '',
      description: '',
    })
  }

  render() {
    return (
      <Container >
        <Row>
          <Col>
          <h1>Partitions</h1>
          Afin de consulter, modifier, ou ajouter une partition de musique, il vous faut d'abbord sélectionner un artiste. Ensuite vous pourrez sélectionner une de ses compositions et y ajouter une partition de musique.
          </Col>
          <Col></Col>
          <Col>
            <Form onSubmit={this.handleSubmit}>
              <h2>Ajouter un artiste</h2>
              <Form.Group className="mb-3" controlId="formBasicText">
                <Form.Label>Nom</Form.Label>
                <Form.Control type="text" placeholder="Nom" name="nom" value={this.state.nom} onChange={this.handleChange}/>
              </Form.Group>
  
              <Form.Group className="mb-3" controlId="formBasicPassword">
                <Form.Label>Descrition</Form.Label>
                <Form.Control as="textarea" placeholder="Description" name="description" value={this.state.description} onChange={this.handleChange}/>
              </Form.Group>
              <Button variant="success" type="submit">
                Ajouter l'artiste
              </Button>
            </Form>
          </Col>
        </Row>
  
      </Container>
    );
  }
}

export default AjoutArtiste;