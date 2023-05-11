import React from 'react';
import { Container, Row, Col } from 'react-bootstrap';
import Button from 'react-bootstrap/Button';
import Form from 'react-bootstrap/Form';

class AjoutPartition extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      nom: '',
      file: null,
    }

    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
    this.handleFileChange = this.handleFileChange.bind(this);
    this.clearInput = this.clearInput.bind(this);
  }

  handleChange(event) {
    const name = event.target.name;
    const value = event.target.value;

    this.setState({
        [name]: value
    });
  }

  handleFileChange(event) { 
    const file = event.target.files[0]
    this.setState({
      file: file,
    });
  }

  handleSubmit = (e) => {
    e.preventDefault();
    const formData = new FormData();
    formData.append('inputFile', this.state.file);

    const partition = {
      'id_periode': this.props.compositionSelect.id_periode,
      'id_composition': this.props.compositionSelect.id,
      'nom': this.state.nom,
      'upload_par': 1,
    };
    
    this.props.ajouterPartition(formData, partition);
    this.clearInput();
  }

  clearInput() {
    this.setState({
      nom: '',
      formData: null,
    })
  }

  render() {
    return (
      <Container >
        <Row>
          <Col>
          <h1>{this.props.compositionSelect.nom}</h1>
          </Col>
          <Col></Col>
          <Col>
            <Form onSubmit={this.handleSubmit}>
              <h2>Ajouter une partition</h2>
              <Form.Group className="mb-3" controlId="formNom">
                <Form.Label>Nom</Form.Label>
                <Form.Control type="text" placeholder="Nom" name="nom" value={this.state.nom} onChange={this.handleChange}/>
              </Form.Group>
              <Form.Group className="mb-3" controlId="inputFile">
                <Form.Label>Fichier</Form.Label>
                <Form.Control type="file" name="inputFile"onChange={this.handleFileChange}/>
              </Form.Group>
              <Button variant="success" type="submit">
                Téléverser la partition
              </Button>
            </Form>
          </Col>
        </Row>
  
      </Container>
    );
  }
}

export default AjoutPartition;