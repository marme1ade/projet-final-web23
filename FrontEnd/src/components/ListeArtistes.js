import React from 'react';
import Button from 'react-bootstrap/Button';
import Card from 'react-bootstrap/Card';
import { Container } from 'react-bootstrap';

class ListeArtistes extends React.Component {
    constructor(props) {
        super(props);
    }

    handleSubmit = (e) => {
      const artisteId = e.target.value;
      e.preventDefault();
      this.props.recupererCompositions(artisteId);
    }

    render() {
        const recupererCartesArtistes = this.props.listeArtistes.map((artiste) => {
            return (
              <Card className="mt-2" bg="dark" variant="dark" text="white">
                <Card.Body>
                  <Card.Title>{artiste.nom}</Card.Title>
                  <Card.Text hidden> a </Card.Text>
                  <Card.Text>
                    {artiste.description}
                  </Card.Text>
                  <Button variant="secondary" value={artiste.id} onClick={this.handleSubmit}>Consulter</Button>
                </Card.Body>
              </Card>
            )
        });

        return (
            <Container>
                {recupererCartesArtistes}
            </Container>         
        );
    }
}

export default ListeArtistes;