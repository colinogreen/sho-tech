/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

//React = require('react');
import React from 'react'
import ReactDOM from 'react-dom'

//ReactDOM = require('react-dom');
import { render } from 'react-dom'
window.React = React;
//import ReactDOM from 'react-dom'
//Babel = require("babel-standalone");

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

require('./components/Example');

import $ from 'jquery';

//const element = <h1>Hello, {name}</h1>;
export default class BTCPrice extends React.Component {
//class BTCPrice extends React.Component {

  constructor(props) {

    super(props);


    this.state = {

      data: {
          api_query:{
              "last_update": ""
          }

      }

    }

  }
  render() {
    return (
      <div>

        <h1>

        React.js Query

        </h1>


        <h2>Last update: {this.state.data.api_query.last_update}</h2>



        <hr/>

        <button

          onClick={this.fetch.bind(this)}

        >

          Fetch Latest
        </button>
      </div>

    );

  }
  fetch() {
    var context = this;

    $.ajax({

      url: '/forecast_data',
      method: 'GET',
      dataType: 'json',

      success: function(response) {

        context.setState({

          data: response

        });

      }

    });

  }


} 
//const BTCPrice = new BTCPrice();
//var btc_price = new BTCPrice();
 //const rate = btc_price.state.data.bpi.USD.rate;
 if(document.getElementById('div_weather_data')!== null)
 {
    render(<BTCPrice />,document.getElementById('div_weather_data'));     
 }
