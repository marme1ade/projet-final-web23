import Button from 'react-bootstrap/Button';
import Container from 'react-bootstrap/Container';
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';

function TopBar() {
  return (
    <Navbar bg="dark" variant="dark" expand="lg">
      <Container fluid>
        <Navbar.Brand href="/">Projet Finale Web 2023</Navbar.Brand>
        <Navbar.Toggle aria-controls="navbarScroll" />
        <Navbar.Collapse id="navbarScroll">
          <Nav
            className="me-auto my-2 my-lg-0"
            style={{ maxHeight: '100px' }}
            navbarScroll
          >
            <Nav.Link href="partitions">Partitions</Nav.Link>
            <Nav.Link href="chats">Chats</Nav.Link>
          </Nav>
          
          <Button href="nouvelle-cle" variant="success">Générer une nouvelle clé d'API</Button>{' '}
        </Navbar.Collapse>
      </Container>
    </Navbar>
  );
}

export default TopBar;