import './App.css';
import React from 'react';
import { Routes, Route } from "react-router-dom";
import TopBar from './components/TopBar';
import NouvelleCle from './components/NouvelleCle';
import Partitions from './components/Partitions';
import Chats from './components/Chats';

class App extends React.Component {

  render(){
    return (
      <div>
        <TopBar />
        <Routes>
          <Route path="/" element={<Partitions />} />
          <Route path="/nouvelle-cle" element={<NouvelleCle />} />
          <Route path="/chats" element={<Chats />} />
          <Route path="/partitions" element={<Partitions />} />
        </Routes>
        </div>
    );
  }
}

export default (App);