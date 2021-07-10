/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

//React = require('react');
import React from 'react'
import ReactDOM from 'react-dom'



//const ReactD = require('react-dom');
import { render } from 'react-dom'
window.React = React;
window.ReactDOM = ReactDOM;
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
              "last_update": "",
              //"day": [0,1,2,3,4,5,6],
              "day": [{},{},{},{},{},{}],
          }

      }

    }

  }
  render() {
      console.log(this.state.data);
      //var txt = (<p>Extra text tester</p>);
//      var wdata = "";
//      for(var i=1; i<6;i++)
//      {
//          wdata += (    );
//      }

    const precip = "fas fa-tint";
    const temph = "fas fa-temperature-high";
    const templ = "fas fa-temperature-low";
    const wind = "fas fa-wind";
    
    const day1 = this.state.data.api_query.day[1];
    const day2 = this.state.data.api_query.day[2];
    const day3 = this.state.data.api_query.day[3];
    const day4 = this.state.data.api_query.day[4];
    const day5 = this.state.data.api_query.day[5];
    
    return (
             
      <div>
          
        <h3>
        Weather forecast for [city]
        </h3>

     <div className="" style={{border:'2px solid #ccc', borderRadius: '8px'}}>
     <div className="row">
         <div className="col-12 offset-md-8 col-md-4">
             <h5 style={{}}><i className="fas fa-clock"></i> Last Update: {this.state.data.api_query.last_forecast_update}</h5>
         </div>
     </div>
    <div className="weather_table">
    <div className="row">
       <div className="offset-1 col-2"><h4>{this.state.data.api_query.day[1].day_of_the_week}</h4><span>{this.state.data.api_query.day[1].day_weather_code}</span></div>  <div className="col-2">
           <h4>{this.state.data.api_query.day[2].day_of_the_week}</h4><span>{this.state.data.api_query.day[2].day_weather_code}</span></div> 
           <div className="col-2"><h4>{this.state.data.api_query.day[3].day_of_the_week}</h4><span>{this.state.data.api_query.day[3].day_weather_code}</span></div> 
           <div className="col-2"><h4>{this.state.data.api_query.day[4].day_of_the_week}</h4><span>{this.state.data.api_query.day[4].day_weather_code}</span></div> 
           <div className="col-2"><h4>{this.state.data.api_query.day[5].day_of_the_week}</h4>
               <span>{this.state.data.api_query.day[5].day_weather_code}</span></div> 
    </div>
    <div className="row temp-high">
           <div className="offset-1 col-2"><i className={temph}></i> &#160;<span>{day1.day_highest_temp} &deg;</span></div>  <div className="col-2"><i className={temph}></i> &#160;<span>{day2.day_highest_temp} &deg;</span></div> 
               <div className="col-2"><i className={temph}></i> &#160;<span>{day3.day_highest_temp} &deg;</span></div> <div className="col-2"><i className={temph}></i> &#160;<span>{day4.day_highest_temp} &deg;</span></div> 
                   <div className="col-2"><i className={temph}></i> &#160;<span>{day5.day_highest_temp} &deg;</span></div> 
        </div>  
    <div className="row temp-low">
           <div className="offset-1 col-2"><i className={templ}></i> &#160;<span>{day1.day_lowest_temp} &deg;</span></div>  <div className="col-2"><i className={templ}></i> &#160;<span>{day2.day_lowest_temp} &deg;</span></div> 
               <div className="col-2"><i className={templ}></i> &#160;<span>{day3.day_lowest_temp} &deg;</span></div> <div className="col-2"><i className={templ}></i> &#160;<span>{day4.day_lowest_temp} &deg;</span></div> 
                   <div className="col-2"><i className={templ}></i> &#160;<span>{day5.day_lowest_temp} &deg;</span></div> 
        </div> 
     <div className="row">
           <div className="offset-1 col-2"><i className={precip}></i> &#160;<span>{day1.day_chance_rain} %</span></div>  <div className="col-2"><i className={precip}></i> &#160;<span>{day2.day_chance_rain} %</span></div> 
               <div className="col-2"><i className={precip}></i> &#160;<span>{day3.day_chance_rain} %</span></div> <div className="col-2"><i className={precip}></i> &#160;<span>{day4.day_chance_rain} %</span></div> 
                   <div className="col-2"><i className={precip}></i> &#160;<span>{day5.day_chance_rain} %</span></div> 
        </div>   
      <div className="row">
           <div className="offset-1 col-2"><i className={wind}></i> &#160;<span>{day1.day_wind_mph} mph</span></div>  <div className="col-2"><i className={wind}></i> &#160;<span>{day2.day_wind_mph} mph</span></div> 
               <div className="col-2"><i className={wind}></i> &#160;<span>{day3.day_wind_mph} mph</span></div> <div className="col-2"><i className={wind}></i> &#160;<span>{day4.day_wind_mph} mph</span></div> 
                   <div className="col-2"><i className={wind}></i> &#160;<span>{day5.day_wind_mph} mph</span></div> 
        </div>  
    </div> {/* End weather table*/}

     </div>
     <p style={{fontSize:'0.8em', fontStyle:'italic'}}>Last API update: {this.state.data.api_query.last_api_update}</p>

        <hr/>

        <button className="form-control" onClick={this.fetch.bind(this)}> {/* Check for new data and display it on button press */}

          Fetch Latest
        </button>
      </div>
      

    );

  }
componentDidMount(){
	this.fetch();// Get the data on the first load of the page.
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



function tick() {
  const element = (

    <p style={{fontStyle:'italic', fontColor:'#ccc'}}>It is {new Date().toLocaleTimeString()}.</p>
  );
  ReactDOM.render(element, document.getElementById('div_clock'));
  }
 if(document.getElementById('div_clock')!== null)
 {
    //tick();
    setInterval(tick, 1000);
 }

//setInterval(tick, 1000);


//const BTCPrice = new BTCPrice();
//var btc_price = new BTCPrice();
 //const rate = btc_price.state.data.bpi.USD.rate;
 if(document.getElementById('div_weather_data')!== null)
 {
    render(<BTCPrice />,document.getElementById('div_weather_data'));
    //fetch(<BTCPrice />,document.getElementById('div_weather_data'));
	//new BTCPrice.fetch();  
 }
