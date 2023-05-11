import React from 'react';
import { Container, Row, Col, Alert } from 'react-bootstrap';
import Button from 'react-bootstrap/Button';
import Form from 'react-bootstrap/Form';
import Api from '../utils/Api';

class NouvelleCle extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      usager: '',
      mdp: '',
      nouvelle: false,
      cle: "?",
    };
    this.handleChange = this.handleChange.bind(this);
    this.handleCheck = this.handleCheck.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
    this.clearInput = this.clearInput.bind(this);
  }

  getCle(usager, mdp, nouvelle) {
    Api({
      method: 'PUT',
      url: '/cle',
      data: {
        base: btoa(usager + " " + mdp),
        nouvelle: nouvelle,
      }
    })
    .then((response) => {
      console.log(nouvelle);
      console.log(response);
      this.setState({
        cle: response.data.cle
      });
    })
  }

  handleChange(event) {
    console.log(event);
    const name = event.target.name;
    const value = event.target.value;
    this.setState({
        [name]: value
    });
  }

  handleCheck(event) {
    this.setState({
        nouvelle: event.target.checked
    });
  }

  handleSubmit = (e) => {
    e.preventDefault();
    this.getCle(this.state.usager, this.state.mdp, this.state.nouvelle);
    this.clearInput();
  }

  clearInput() {
    this.setState({
      usager: '',
      mdp: '',
      nouvelle: 0,
    })
  }

  render() {
    return (
      <Container>
        <Row>
          <Col></Col>
          <Col>
            <Form onSubmit={this.handleSubmit}>
              <h2>Générer une nouvelle clé d'API</h2>
              <Form.Group className="mb-3" controlId="formBasicText">
                <Form.Label>Usager</Form.Label>
                <Form.Control type="text" placeholder="Entrer l'usager" name="usager" value={this.state.usager} onChange={this.handleChange}/>
              </Form.Group>
  
              <Form.Group className="mb-3" controlId="formBasicPassword">
                <Form.Label>Mot de passe</Form.Label>
                <Form.Control type="password" placeholder="Mot de passe" name="mdp" value={this.state.mdp} onChange={this.handleChange}/>
              </Form.Group>

              <Form.Group className="mb-3" controlId="formNewKey">
                <Form.Label>Renouveler la clé</Form.Label>
                <Form.Check type="switch" checked={this.state.nouvelle} name="nouvelle" onChange={this.handleCheck}/>
              </Form.Group>
              <Button variant="primary" type="submit">
                Obtenir Clé
              </Button>
            </Form>
            <Alert key="info" variant="info" className='m-5'>Cle : {this.state.cle}</Alert>
          </Col>
          <Col></Col>
        </Row>
  
      </Container>
    );
  }
}

export default NouvelleCle;