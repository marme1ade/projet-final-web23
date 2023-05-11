import React from 'react';
import { Container, Row } from 'react-bootstrap';
import Button from 'react-bootstrap/Button';
import Form from 'react-bootstrap/Form';

class ModifierComposition extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      id_periode:'',
      nom: '',
      description: '',
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
    e.preventDefault();
    const compo = {
      id: this.props.compoAModifier.id,
      id_periode: this.state.id_periode,
      nom: this.state.nom,
      description: this.state.description,
    };
    this.props.modifierCompo(compo);
    this.props.desactiverModification();
    this.clearInput();
  }

  clearInput() {
    this.setState({
      id_periode: '',
      nom: '',
      description: '',
    })
  }

  render() {
    const optionsPeriodes = this.props.listePeriodes.map((periode) => {
      return(
        <option value={periode.id}>{periode.nom}</option>
      )
    });

    return (
      <Container className='p-5'>
        <Row>
            <Form onSubmit={this.handleSubmit}>
              <h2>Modification de {this.props.compoAModifier.nom}</h2>
              <Form.Group className="mb-3" controlId="formNom">
                <Form.Label>Nom</Form.Label>
                <Form.Control type="text" placeholder="Nom" name="nom" value={this.state.nom} onChange={this.handleChange}/>
              </Form.Group>
              <Form.Group className="mb-3" controlId="formPeriode">
                <Form.Label>Période</Form.Label>
                <Form.Select aria-label="Période" name="id_periode" value={this.state.id_periode} onChange={this.handleChange}>
                  {optionsPeriodes}
                </Form.Select>
              </Form.Group>
              <Form.Group className="mb-3" controlId="formDescription">
                <Form.Label>Descrition</Form.Label>
                <Form.Control as="textarea" placeholder="Description" name="description" value={this.state.description} onChange={this.handleChange}/>
              </Form.Group>
              <Button variant="success" type="submit">
                Modifier la composition
              </Button>
            </Form>
        </Row>
      </Container>
    );
  }
}

export default ModifierComposition;