import React from 'react';
import Button from 'react-bootstrap/Button';
import Card from 'react-bootstrap/Card';
import { Container, Badge } from 'react-bootstrap';
import ModifierComposition from './ModifierComposition';

class ListeCompos extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
          compoAModifier: 0
        }
        this.desactiverModification = this.desactiverModification.bind(this);
    }

    desactiverModification() {
      this.setState({
        compoAModifier: 0
      })
    }

    handleSubmit = (e) => {
      const idCompo = e.target.value;
      e.preventDefault();
      this.props.recupererPartitions(idCompo);
    }

    handleModifier = (e) => {
      const idCompo = e.target.value;
      const compo = this.props.listeCompositions.find((compo) => compo.id == idCompo);
      this.setState({
        compoAModifier: compo
      })
    }

    render() {
        const recupererCartesCompos = this.props.listeCompositions.map((compo) => {

            const periode = this.props.listePeriodes.find((periode) => periode.id == compo.id_periode).nom;

            if(this.state.compoAModifier.id != 0)
            {
              if(this.state.compoAModifier.id == compo.id)
              {
                return(
                  <ModifierComposition desactiverModification={this.desactiverModification} compoAModifier={this.state.compoAModifier} modifierCompo={this.props.modifierCompo} listePeriodes={this.props.listePeriodes}></ModifierComposition>
                );
              } 
            }

            return (
              <Card className="mt-2" bg="dark" variant="dark" text="white">
                <Card.Body>
                  <Card.Title>{compo.nom}</Card.Title>
                  <Badge bg="primary">{periode}</Badge>
                  <Card.Text hidden> a </Card.Text>
                  <Card.Text>
                    {compo.description}
                  </Card.Text>
                  <Button variant="secondary" value={compo.id} onClick={this.handleSubmit}>Consulter les partitions</Button>
                  <Button variant="warning" className="ms-3" value={compo.id} onClick={this.handleModifier}>Modifier</Button>
                </Card.Body>
              </Card>
            );
        });

        return (
            <Container>
                {recupererCartesCompos}
            </Container>         
        );
    }
}

export default ListeCompos;