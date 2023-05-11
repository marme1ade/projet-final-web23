import axios from "axios";

var token = 'zjUtRsPKxAVWIkGk';

export default axios.create({
    baseURL: "http://brunellelou-webfinale.loc",
    responseType: "json",
    headers:{
        'Authorization': `Bearer ${token}`,
    }
})