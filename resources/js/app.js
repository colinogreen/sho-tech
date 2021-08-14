/**
 ** NOTE: For /cstats page code, see ./appstats.js **
 *
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

import React from 'react'
import ReactDOM from 'react-dom'
import Babel from 'babel-standalone';


//const ReactD = require('react-dom');
import { render } from 'react-dom'
window.React = React;
window.ReactDOM = ReactDOM;

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

require('./components/Example');

import $ from 'jquery';

class TodayWeatherRows extends React.Component {
	
	constructor(props){
		super(props);

	}
	render()
	{
		//console.log("Top temp: " + this.props.top_temp); <div className="offset-3 col"><h3>Today</h3> &#160;<i className="fas fa-temperature-high"></i></div>
		//const loadmsg =  (<span style={{fontStyle:'italic'}}>loading ...</span>);
		const loadmsg =  "loading ...";
	const dynamic_data = (this.props.extra_data_name !== undefined && this.props.extra_data !== undefined )
	? this.props.extra_data_name + ": " + this.props.extra_data
	: loadmsg; //span style={{fontStyle:'italic'}}
        
        const day_period_temp_icon = this.props.top_temp === this.props.day_period_temp ? "fas fa-temperature-high": "fas fa-temperature-low";
        // <br /><i className="fas fa-temperature-low"></i><span>{this.props.min_temp} &deg;C </span>
	
    return (
	

        <div className="col-auto">
            <div className="row" >      
		<div className="col-12 col-sm-auto order-sm-first main_icon">
		<h3 className="d-block d-sm-none">Today</h3>
		<i className={this.props.weather_icon}></i>
		<p className="text-sm-center">{this.props.weather_desc}</p>
		</div>  
		<div className="w-100 d-block d-sm-none"></div>   	  
		<div className="col-12 col-sm-auto">  

			<h3 className="d-none d-sm-block">{this.props.day_period}</h3>
			<span className="today_tonight_temp"><i className={day_period_temp_icon}></i> {this.props.day_period_temp}&deg;C</span>
			 

				
		</div>
            </div>
            <div className="row">
                <div id="today-weather-row-extra" className="col-auto dynamic_display"><span id="today-weather-row-extra-span" >{dynamic_data}</span> </div>
            </div>
    	</div>		

	
		);	
	}
}
function weatherIcon()
{
	
}	
class MultiWeatherRowTop extends React.Component {
	
	constructor(props){
		super(props);

	}
	
	getWeatherIcon(dwc)
	{
		return  (dwc !== undefined && (dwc.includes("fas")||dwc.includes("far"))
		?(<i className={dwc }></i>)
		:(dwc !== undefined)? dwc: "");
	}
	render()
	{
		{/* dow= day of week | dwc = day weather code */}
		//console.log("dwc1 status: " + this.props.dwc1);
		//const dwc1 = (this.props.dwc1 !== undefined && this.props.dwc1.includes("fas")?(<i className={this.props.dwc1 }></i>): "");
		const dwc1 = this.getWeatherIcon(this.props.dwc1);
		const dwc2 = this.getWeatherIcon(this.props.dwc2);
		const dwc3 = this.getWeatherIcon(this.props.dwc3);
		const dwc4 = this.getWeatherIcon(this.props.dwc4);
		const dwc5 = this.getWeatherIcon(this.props.dwc5);
		const dwi1 = this.getWeatherIcon(this.props.dwi1);
		const dwi2 = this.getWeatherIcon(this.props.dwi2);
		const dwi3 = this.getWeatherIcon(this.props.dwi3);
		const dwi4 = this.getWeatherIcon(this.props.dwi4);
		const dwi5 = this.getWeatherIcon(this.props.dwi5);
		//console.log("dw status: " + dw);
		//console.log("dwc1 includes: " + this.props.dwc1.toString().includes("fas"));
    return (<div className="row weather_row_top">
       <div className="col-2"><h4>{this.props.dow1}</h4><span>{dwi1}</span><br />{dwc1}</div>  <div className="col-2">
           <h4>{this.props.dow2}</h4><span>{dwi2}</span><br />{dwc2}</div> 
           <div className="col-2"><h4>{this.props.dow3}</h4><span>{dwi3}</span><br />{dwc3}</div> 
           <div className="col-2"><h4>{this.props.dow4}</h4><span>{dwi4}</span><br />{dwc4}</div> 
           <div className="col-2"><h4>{this.props.dow5}</h4>
               <span>{dwi5}</span><br />{dwc5}</div> 
    </div>	);	
	}
}

class MultiWeatherRowGeneral extends React.Component {
	
	constructor(props){
		super(props);
		
	}
	render()
	{
		{/* dow= day of week | dwc = day weather code */}
    return (    
	<div className={"row " + this.props.rowclass}>
           <div className="col-2"><i className={this.props.itemclass}></i> &#160;<span>{this.props.day1_item}{this.props.item_desc}</span></div>  
	<div className="col-2">
	<i className={this.props.itemclass}></i> &#160;<span>{this.props.day2_item}{this.props.item_desc}</span>
	</div> 
   <div className="col-2">
	<i className={this.props.itemclass}></i> &#160;<span>{this.props.day3_item}{this.props.item_desc}</span>
	</div> 
	<div className="col-2">
	<i className={this.props.itemclass}></i> &#160;<span>{this.props.day4_item}{this.props.item_desc}</span>
	</div> 
   	<div className="col-2">
		<i className={this.props.itemclass}></i> &#160;<span>{this.props.day5_item}{this.props.item_desc}</span>
		</div>
	</div>);	
	}
}

class WeatherData extends React.Component {

  constructor(props) {

    super(props);
	const loadmsg = "loading data ..."; 
	this.extra_data_name = loadmsg; 
	this.extra_data = loadmsg;
	
    this.state = {

      data: {
          api_query:{
              "last_update": "",
              "day": [{},{},{},{},{},{}],
			"message":""
          }

      }

    }

  }
  render() {

	if(this.state.data.api_query.message !== undefined && this.state.data.api_query.message !== null && this.state.data.api_query.message !== "")
	{
		// * Return the error and display nothing else...
		//console.log("this.state.data.api_query.message contains:");
		//console.log(this.state.data.api_query.message);
		//console.log(this.state.data.api_query.message.length);
		  const innerHtml = { __html: this.state.data.api_query.message }

		return (
		     <div className="row">
         <div className="col-12 offset-md-2 col-md-8">
			<h3>Error retrieving data</h3>
			<p dangerouslySetInnerHTML={innerHtml}></p>
			<p >Please try again later.</p>
		</div>
		</div>
			
		);
	}
	// ... * Or continue to create weather data display
    const precip = "fas fa-tint";
    const temph = "fas fa-temperature-high";
    const templ = "fas fa-temperature-low";
    const wind = "fas fa-wind";
    
    const location = this.state.data.api_query.location;
    const day1 = this.state.data.api_query.day[1];
    const day2 = this.state.data.api_query.day[2];
    const day3 = this.state.data.api_query.day[3];
    const day4 = this.state.data.api_query.day[4];
    const day5 = this.state.data.api_query.day[5];

	//var extra_data_name = "placehold"; var extra_data;
	var count = 0;
	setInterval(function(){
		var sec = new Date().getSeconds();

		if(sec % 3 === 0 && sec % 6 === 0 && day1.max_uv_index !== undefined)
		{
			this.extra_data_name = "Max UV Index";
			this.extra_data = day1.max_uv_index;
			
		}
		else if(sec % 3 === 0 && day1.feels_like_temp !== undefined)
		{
			this.extra_data_name = "Temp feels like";
			this.extra_data = day1.feels_like_temp + " &deg;";			
		}
		if(document.getElementById("today-weather-row-extra-span")!== null && this.extra_data_name !== undefined && this.extra_data !== undefined)
		{
			document.getElementById('today-weather-row-extra-span').innerHTML = this.extra_data_name + ": "+ this.extra_data;
		}
		
	}, 1000);    

	// Removed style from top div | border:'2px solid #ccc', borderRadius: '8px'
    return (
             
      <div>



     <div className="row weather_data_today align-items-center justify-content-sm-start justify-content-center">
        <div className="col-12 weather_location_desc order-last order-sm-first">
          
        <h6>
        Weather forecast for {location}
        </h6>
         </div>
         <div className="col-12 order-last order-sm-first">
             <p style={{}}><i className="fas fa-clock"></i> <span className="text-muted" style={{fontStyle:'italic'}}>Met Office update: {this.state.data.api_query.last_forecast_update}</span></p>
         </div>
        <TodayWeatherRows weather_icon={day1.day_weather_icon} weather_desc={day1.day_weather_desc}top_temp={day1.day_highest_temp} min_temp={day1.day_lowest_temp} 
        day_period={day1.day_period} day_period_temp={day1.day_period_temp}/>
     </div>
    <div className="weather_data_five_day">


	
	<MultiWeatherRowTop dow1={day1.day_of_week} dow2={day2.day_of_week} dow3={day3.day_of_week} dow4={day4.day_of_week }dow5={day5.day_of_week}
	  dwc1={day1.day_weather_desc} dwc2={day2.day_weather_desc} dwc3={day3.day_weather_desc} dwc4={day4.day_weather_desc} dwc5={day5.day_weather_desc} 
	dwi1={day1.day_weather_icon} dwi2={day2.day_weather_icon} dwi3={day3.day_weather_icon} dwi4={day4.day_weather_icon} dwi5={day5.day_weather_icon}/>
	
	<MultiWeatherRowGeneral rowclass="temp_high" itemclass={temph} item_desc="&deg;" day1_item={day1.day_highest_temp} day2_item={day2.day_highest_temp} 
	day3_item={day3.day_highest_temp} day4_item={day4.day_highest_temp} day5_item={day5.day_highest_temp} />

	<MultiWeatherRowGeneral rowclass="temp_low" itemclass={templ} item_desc="&deg;" day1_item={day1.day_lowest_temp} day2_item={day2.day_lowest_temp} 
	day3_item={day3.day_lowest_temp} day4_item={day4.day_lowest_temp} day5_item={day5.day_lowest_temp} />

	<MultiWeatherRowGeneral rowclass="" itemclass={precip} item_desc="%" day1_item={day1.day_chance_rain} day2_item={day2.day_chance_rain} 
	day3_item={day3.day_chance_rain} day4_item={day4.day_chance_rain} day5_item={day5.day_chance_rain} />
	
	<MultiWeatherRowGeneral itemclass={wind} item_desc="mph" day1_item={day1.day_wind_mph} day2_item={day2.day_wind_mph} 
	day3_item={day3.day_wind_mph} day4_item={day4.day_wind_mph} day5_item={day5.day_wind_mph} />
 

    </div> 

     <p style={{fontSize:'0.8em', fontStyle:'italic'}}>Last data update: {this.state.data.api_query.last_api_update}</p>


        <button id="btn-fetch-latest" className="form-control btn_fetch_latest" onClick={this.fetch.bind(this)}> 
          Fetch Latest
        </button>
      </div>
      

    );

  }
  componentDidMount()
  {
	this.fetch();// Get the data on the first load of the page.
  }
  fetch() {
    var context = this;

	var url_string = window.location.pathname.split("/weather/")[1];
	var url_data= "/forecast_data";
	if(url_string !== undefined)
	{
		url_data += "/" + url_string;
	}

    $.ajax({

      url: url_data,
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

//** Basic Javascript/JQuery (mainly) with calls to React.js classes/functions */

if(document.getElementById('div_clock')!== null)
{
    setInterval(tick, 1000);
}


if(document.getElementById('div-weather-data')!== null)
{
   render(<WeatherData />,document.getElementById('div-weather-data'));

}


if(document.getElementById("btn-fetch-latest")!== null)
{
	// When the Weather data Fetch update button is pressed, make it look like something is being attempted, 
	// as it won't usually retrieve an update due to Laravel/php data caching length.
	const btnfetchlatest = document.getElementById("btn-fetch-latest");
	btnfetchlatest.addEventListener("click",function(){
		const origHTML = btnfetchlatest.innerHTML;
		btnfetchlatest.innerHTML = '<i class="fas fa-cog fa-spin"></i> Checking ...';
		setTimeout(function()
		{
			btnfetchlatest.innerHTML = origHTML;
		}, 750);
	})
}
