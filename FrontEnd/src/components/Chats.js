import React from 'react';
import axios from 'axios';
import Image from 'react-bootstrap/Image'
import { Container, Row, Col } from 'react-bootstrap';

class Chats extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            isLoaded: false,
            chat: null,
        }
    }

    componentDidMount() {
        this.genererChat();
    }

    genererChat = () => {
        axios({
          method: 'get',
          url: 'https://api.thecatapi.com/v1/images/search',
          headers:{
            'x-api-key': 'live_VAi9IiaDcIONrm0wibC28hmQsVuOhRo9warf79o2IcpAUNsQdL5OnR8DlL3IxFF4'
          }
        })
        .then((response) => {
            const chat = response.data[0];
            this.setState({chat: chat, isLoaded: true});
        })
    }

    render() {
        if(!this.state.isLoaded) {
          return (
              <div>En chargement...</div>
          )
        }

        const url = this.state.chat.url;
        const height = this.state.chat.height;
        const width = this.state.chat.width;
        
        return (
          <Container fluid>
            <Row>
              <Col></Col>
              <Col><h2>Photo de chat aléatoire : </h2></Col>
              <Col></Col>
            </Row>
            <Row>
              <Col></Col>
              <Col><Image fluid src={url} height={height} width={width}></Image></Col>
              <Col></Col>
            </Row>
          </Container>
        );
    }
}

export default Chats;