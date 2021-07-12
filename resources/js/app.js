/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

//React = require('react');
import React from 'react'
import ReactDOM from 'react-dom'
import Babel from 'babel-standalone';


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
//export default class BTCPrice extends React.Component {
	
class DataRowTop extends React.Component {
	
	constructor(props){
		super(props);

	}
	render()
	{
		{/* dow= day of week | dwc = day weather code */}
    return (<div className="row">
       <div className="offset-1 col-2"><h4>{this.props.dow1}</h4><span>{this.props.dwc1}</span></div>  <div className="col-2">
           <h4>{this.props.dow2}</h4><span>{this.props.dwc2}</span></div> 
           <div className="col-2"><h4>{this.props.dow3}</h4><span>{this.props.dwc3}</span></div> 
           <div className="col-2"><h4>{this.props.dow4}</h4><span>{this.props.dwc4}</span></div> 
           <div className="col-2"><h4>{this.props.dow5}</h4>
               <span>{this.props.dwc5}</span></div> 
    </div>	);	
	}
}

class DataRowGeneral extends React.Component {
	
	constructor(props){
		super(props);
		
	}
	render()
	{
		{/* dow= day of week | dwc = day weather code */}
    return (    
	<div className={"row " + this.props.rowclass}>
           <div className="offset-1 col-2"><i className={this.props.itemclass}></i> &#160;<span>{this.props.day1_item}  {this.props.item_desc}</span></div>  
	<div className="col-2">
	<i className={this.props.itemclass}></i> &#160;<span>{this.props.day2_item} {this.props.item_desc}</span>
	</div> 
   <div className="col-2">
	<i className={this.props.itemclass}></i> &#160;<span>{this.props.day3_item} {this.props.item_desc}</span>
	</div> 
	<div className="col-2">
	<i className={this.props.itemclass}></i> &#160;<span>{this.props.day4_item} {this.props.item_desc}</span>
	</div> 
   	<div className="col-2">
		<i className={this.props.itemclass}></i> &#160;<span>{this.props.day5_item} {this.props.item_desc}</span>
		</div>
	</div>);	
	}
}

class WeatherData extends React.Component {

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
      //console.log(this.state.data);

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

	<DataRowTop dow1={day1.day_of_week} dow2={day2.day_of_week} dow3={day3.day_of_week} dow4={day4.day_of_week }dow5={day5.day_of_week}
	 dwc1={day1.day_weather_code} dwc2={day2.day_weather_code} dwc3={day3.day_weather_code} dwc4={day4.day_weather_code} dwc5={day5.day_weather_code} />
	
	<DataRowGeneral rowclass="temp-high" itemclass={temph} item_desc="&deg;" day1_item={day1.day_highest_temp} day2_item={day2.day_highest_temp} 
	day3_item={day3.day_highest_temp} day4_item={day4.day_highest_temp} day5_item={day5.day_highest_temp} />

	<DataRowGeneral rowclass="temp-high" itemclass={templ} item_desc="&deg;" day1_item={day1.day_lowest_temp} day2_item={day2.day_lowest_temp} 
	day3_item={day3.day_lowest_temp} day4_item={day4.day_lowest_temp} day5_item={day5.day_lowest_temp} />

	<DataRowGeneral rowclass="" itemclass={precip} item_desc="%" day1_item={day1.day_chance_rain} day2_item={day2.day_chance_rain} 
	day3_item={day3.day_chance_rain} day4_item={day4.day_chance_rain} day5_item={day5.day_chance_rain} />
	
	<DataRowGeneral itemclass={wind} item_desc="mph" day1_item={day1.day_wind_mph} day2_item={day2.day_wind_mph} 
	day3_item={day3.day_wind_mph} day4_item={day4.day_wind_mph} day5_item={day5.day_wind_mph} />
 

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
    render(<WeatherData />,document.getElementById('div_weather_data'));
    //fetch(<BTCPrice />,document.getElementById('div_weather_data'));
	//new BTCPrice.fetch();  
 }
/*
    <div className="row">
       <div className="offset-1 col-2"><h4>{this.state.data.api_query.day[1].day_of_the_week}</h4><span>{this.state.data.api_query.day[1].day_weather_code}</span></div>  <div className="col-2">
           <h4>{this.state.data.api_query.day[2].day_of_the_week}</h4><span>{this.state.data.api_query.day[2].day_weather_code}</span></div> 
           <div className="col-2"><h4>{this.state.data.api_query.day[3].day_of_the_week}</h4><span>{this.state.data.api_query.day[3].day_weather_code}</span></div> 
           <div className="col-2"><h4>{this.state.data.api_query.day[4].day_of_the_week}</h4><span>{this.state.data.api_query.day[4].day_weather_code}</span></div> 
           <div className="col-2"><h4>{this.state.data.api_query.day[5].day_of_the_week}</h4>
               <span>{this.state.data.api_query.day[5].day_weather_code}</span></div> 
    </div>
      <div className="row">
           <div className="offset-1 col-2"><i className={wind}></i> &#160;<span>{day1.day_wind_mph} mph</span></div>  <div className="col-2"><i className={wind}></i> &#160;<span>{day2.day_wind_mph} mph</span></div> 
               <div className="col-2"><i className={wind}></i> &#160;<span>{day3.day_wind_mph} mph</span></div> <div className="col-2"><i className={wind}></i> &#160;<span>{day4.day_wind_mph} mph</span></div> 
                   <div className="col-2"><i className={wind}></i> &#160;<span>{day5.day_wind_mph} mph</span></div> 
        </div>  
*/