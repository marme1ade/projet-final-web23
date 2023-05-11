import React from 'react';
import Button from 'react-bootstrap/Button';
import Card from 'react-bootstrap/Card';
import Form from 'react-bootstrap/Form';
import { Container } from 'react-bootstrap';

class ListePartitions extends React.Component {
    constructor(props) {
        super(props);
    }

    handleSubmit = (e) => {
      e.preventDefault();
      const partition = this.props.listePartitions.find(( partition ) => partition.id == e.target.value);
      this.props.downloadPartition(partition);
    }

    handleDelete = (e) => {
      e.preventDefault();
      this.props.deletePartition(e.target.value);
    }

    render() {
        const recupererCartesPartitions = this.props.listePartitions.map((partition) => {

            return (
              <Card className="mt-2" bg="dark" variant="dark" text="white">
                <Card.Body>
                  <Card.Title>{partition.nom}</Card.Title>
                  <Button variant="success" value={partition.id} onClick={this.handleSubmit}>Télécharger</Button>
                  <Button variant="danger" className="ms-3" value={partition.id} onClick={this.handleDelete}>Supprimer</Button>
                </Card.Body>
              </Card>
            )
        });

        return (
            <Container>
                {recupererCartesPartitions}
            </Container>         
        );
    }
}

export default ListePartitions;