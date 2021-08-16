/**
 * Create the settings for each graph that can be easily edited before the graph is drawn ...
 * ... by calling a new chart class and sending this classes data() method in the process.
 * This process makes things easier, avoiding drilling down through chart config object levels.
 * @type void
 */
class ChartConfigSetup
{  
    constructor(result_data){

        //this.extraData = extra_data;
        this.labels_array = [];
        this.result_data = result_data;
        
        this.optionsSettings; // use with setConfigSettings/setConfigSettingsItem etc. methods
        this.dataSettings; // use with setDataSettings/setDataSettingsItem etc. methods
        //console.log("this.configOptions: " + this.configOptions);
        //this.data = {};
        
        this.graphData1 = [];
        this.graphData2 = [];
        this.averages_array = [];
        
        this.extratotal_label;
        //* Set defaults for the main chart visual look and data controls
        this.type = "line";
        this.labels = [];
        this.label = "my label";
        this.lineTension = 0.3;
        this.backgroundColor = "rgba(78, 115, 223, 0.05)";
        this.borderColor = "rgba(78, 115, 223, 1)";
        this.pointRadius = 3;
        this.pointBackgroundColor = "rgba(78, 115, 223, 1)";
        this.pointBorderColor = "rgba(78, 115, 223, 1)";
        this.pointHoverRadius = 3;
        this.pointHoverBackgroundColor = "rgba(78, 115, 223, 1)";
        this.pointHoverBorderColor = "rgba(78, 115, 223, 1)";
        this.pointHitRadius = 10;
        this.pointBorderWidth = 2;
        //this.data_array = [];
        //this.todaydata =[];// Colin's custom entry
    }
    
    getAlertMessages()
    {
        const messages = {};
        messages.latest_cases = this.getMonthTotalToDate("cases_today");
        messages.latest_deaths = this.getMonthTotalToDate("expired_today");
        const days_since_update = this.getDaysSinceDataUpdate();
        //console.log("days_since_update: " + days_since_update);
        if(Number.isInteger(days_since_update) && days_since_update > 0){
            let day_string = (days_since_update === 1)? "day": "days";
            messages.days_since_update = ["It has been " + days_since_update + " " + day_string + " since the last data update", new Date().toDateString(), days_since_update];
        }
        //console.log("Days since data update: " + this.getDaysSinceDataUpdate());
        //console.log("The getAlertMessages() length is: " + Object.keys(messages).length);
        messages.alert_data_length = Object.keys(messages).length;
        return messages;
    }
    
    getDaysSinceDataUpdate()
    {
        //console.log("getDataUpdateDays():" + this.getComputerDateFormat());
        const today_date = this.getComputerDateFormat();
        const last_update = this.getLastDataUpdate();
        const diffInMs   = new Date(today_date) - new Date(last_update);
        return diffInMs / (1000 * 60 * 60 * 24);

    }
    /**
     * Get the date that the last record refers to in string form
     * @returns {ChartConfigSetup.result_data.date}
     */
    getLastDataUpdate()
    {
        return this.result_data[this.result_data.length -1].date;
    }
    
    getComputerDateFormat(dayoffset)
    {
        //console.log("dayoffset: " + dayoffset);
        let t = new Date();
        if(dayoffset !== undefined && dayoffset.isInteger())
        {
            t = new Date().getDate() - dayoffset;
        }
        
        return t.getFullYear() + "-" + this.getFormattedMonthNumeric(t) + "-" + t.getDate();        
    }
    
    getFormattedMonthNumeric(date)
    {
        //if(date.isNumeric())
        return  ('0' + (date.getMonth()+1)).slice(-2);
    }
    
    getMonthTotalToDate(label)
    {
        const last_item_num = (this.result_data.length-1);
        const last_item = this.result_data[last_item_num];
        //console.log("Last item date: ")
        //const first_item_num = (this.result_data.length-7);
        const first_item_num = (last_item_num - (new Date(last_item['date']).getDate())+1);
        const first_item = this.result_data[first_item_num];
        const latest_date = new Date(last_item['date']);
        
        //console.log("Last item date: " + last_item['date']);
        //console.log("First item date: " + first_item['date']);

        var total = 0;
        for(var i = first_item_num; i<= last_item_num; i++)
        {
            //console.log("Adding total for '" + label + "' (" + this.result_data[i][label] + ") on day " + i + " - Date: " + this.result_data[i].date) ;
            total += parseInt(this.result_data[i][label]);
        }
        
        return [total, latest_date.toDateString()];
        
        
    }
    
    getSixIndividualMonthsData(object_label)
    {
        //const casesmonth = {};
        //console.log("this.result_data for " + object_label);
        //console.log(this.result_data);
        for(var i = 1; i < 7; i++)
        {
            var tot = 0;
            //var dtset = new Date().setMonth(new Date().getMonth()-i);
            const last_record_date = this.result_data[this.result_data.length-1].date; // Get the date of the last record to base the six months data calc on
            var dtset = new Date(last_record_date).setMonth(new Date().getMonth()-i);
            var dt = new Date(dtset);
            
            //console.log("getSixIndividualMonthsData start date:");
            //console.log(dt);
            
            var date_match = dt.getFullYear() + "-" + this.getFormattedMonthNumeric(dt);

            for(var n in this.result_data)
            {
                var cd = new Date(this.result_data[n].date);
                //console.log(this.result_data[n].date);
                //var dateeval = cd.getFullYear() + "-" + (cd.getMonth()+1);
                var dateeval = cd.getFullYear() + "-" + this.getFormattedMonthNumeric(cd);
                if(dateeval === date_match)
                {
                    //"Date match on " + this.result_data[n].date;
                    tot += parseInt(this.result_data[n][object_label]); //** SOLVE LIVE SERVER JSON ENCODING OF AJAX CALL DATA BEFORE REMOVING parseInt FUNCTION

                }

            }

            //casesmonth[dt.toLocaleString('en-GB', {year:'numeric', month:'long'})] = tot;
            this.labels[this.labels.length] = dt.toLocaleString('en-GB', {year:'numeric', month:'long'});
            this.graphData1[this.graphData1.length] = tot;
        }
        
        //console.log("DEBUG Function: getSixIndividualMonthsData( ..) : casesmonth");
        //console.log(casesmonth);
    }
    
    getGraphAveragesLabels(object_label, start_array_item, loop_step)
    {
        this.labels = this.getGraphAveragesItem(object_label, start_array_item, loop_step);
    }  
    
    getGraphAveragesData(object_label, start_array_item, loop_step)
    {
        this.graphData1 = this.getGraphAveragesItem(object_label, start_array_item, loop_step);
    }   
    
    getGraphAveragesItem(object_name, start_array_item, loop_step)
    {       
        start_array_item = (start_array_item === undefined)? 0: start_array_item;
        //const avstart = (this.data_array.length < start_array_item)? this.data_array.length: start_array_item;
        //console.log("start_array_item: " + start_array_item);
        //console.log("loop_step: " + loop_step);
        var graphdata = new Array();
        for(var n = start_array_item; n < this.result_data.length; n+= loop_step)
        {
            graphdata[graphdata.length] =  this.result_data[n][object_name];
        }
            //console.log(return_array);
        return graphdata;
    } 
    
    getGraphLabels(object_label, start_array_item)
    {
        //console.log(this.result_data);
        this.labels = this.getGraphData(object_label,start_array_item);
    }
    
    getGraphData1(object_label,start_array_item)
    {
        //console.log(this.result_data);
        this.graphData1 = this.getGraphData(object_label,start_array_item);
    }
    
    getGraphData2(object_label,start_array_item)
    {
        this.graphData2 = this.getGraphData(object_label,start_array_item);
    }
    
    getGraphData(object_label, start_array_item)
    {
       start_array_item = (start_array_item === undefined)? 0: start_array_item;
       //console.log("start_array_item: " + start_array_item);
       //var itemcount = 0;
       var graphdata = new Array();
       for(var i= start_array_item ; i < this.result_data.length; i++)
       {
           graphdata[graphdata.length] = this.result_data[i][object_label];

       } 
       
       return graphdata;
    }
    isObject(obj)
    {
        return Object.prototype.toString.call(obj) === '[object Object]';
    }
    
    //** Main Call when setting up chart. use setDataSettings...() and setOptionsSettings...() methods first, if necessary
    config()
    {
        return {
          type: this.type,
          //data: this.dataObject,
          data: this.getDataSettings(),
          options: this.getOptionsSettings()
          
        };
    };
    
    dataExtraConfig(extra_settings)
    {

        if(this.isObject(extra_settings))
        {
            for(var k in extra_settings)
            {
                this[k] = extra_settings[k];
            }
        }
    }
    setDataSettingsItem(item, settingsObject)
    {
        if(this.isObject(settingsObject))
        {
            this.dataSettings[item]= settingsObject;
        }
        
    }
    setDataSettings(object)
    {
        if(this.isObject(object))
        {
            this.dataSettings = object;
        }
        
    }     
    getDataSettings()
    {
        if(this.dataSettings ===  undefined)
        {
            //const data = {};
            
            return {
            labels: this.labels,
            datasets: [{
              label: this.label,
              lineTension: this.lineTension,
              backgroundColor: this.backgroundColor,
              borderColor: this.borderColor,
              pointRadius: this.pointRadius,
              pointBackgroundColor:this.pointBackgroundColor,
              pointBorderColor: this.pointBorderColor,
              pointHoverRadius: this.pointHoverRadius,
              pointHoverBackgroundColor: this.pointHoverBackgroundColor,
              pointHoverBorderColor: this.pointHoverBorderColor,
              pointHitRadius: this.pointHitRadius,
              pointBorderWidth: this.pointBorderWidth,
              data: this.graphData1,
              data2:this.graphData2, // For extra graph data
            }]

          };
        }
        
        return this.dataSettings;

    }

     
    setOptionsSettingsItem(item, settingsObject)
    {
        if(this.isObject(settingsObject))
        {
            this.optionsSettings[item]= settingsObject;
        }
        
    }
    setOptionsSettings(object)
    {
        if(this.isObject(object))
        {
            this.optionsSettings = object;
        }
        
    }    
    getOptionsSettings()
    {
        if(this.optionsSettings === undefined)
        {
            return this.defaultOptionsSettings(); // Return default if the options have not been set
        }
        return this.optionsSettings;
    }
    
    //* Default for if nothing was set before call from Chart.js class.
    defaultOptionsSettings()
    {
        //this.configSettings = {
        return {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
              padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
              }
            },
            scales: {
              xAxes: [{
                time: {
                  unit: 'date'
                },
                gridLines: {
                  display: false,
                  drawBorder: false
                },
                ticks: {
                  maxTicksLimit: 7
                }
              }],
              yAxes: [{
                ticks: {
                  maxTicksLimit: 5,
                  padding: 10,
                  // Include a dollar sign in the ticks
                  callback: function(value, index, values) {
                    //return '$' + number_format(value);
                    return value;
                  }
                },
                gridLines: {
                  color: "rgb(234, 236, 244)",
                  zeroLineColor: "rgb(234, 236, 244)",
                  drawBorder: false,
                  borderDash: [2],
                  zeroLineBorderDash: [2]
                }
              }]
            },
            legend: {
              display: false
            },
            tooltips: {
              backgroundColor: "rgb(255,255,255)",
              bodyFontColor: "#858796",
              titleMarginBottom: 10,
              titleFontColor: '#6e707e',
              titleFontSize: 14,
              borderColor: '#dddfeb',
              borderWidth: 1,
              xPadding: 15,
              yPadding: 15,
              displayColors: false,
              intersect: false,
              mode: 'index',
              caretPadding: 10,
              enabled:true,
              callbacks: {
                label: (tooltipItem, chart)=> {
                //console.log(chart.datasets[tooltipItem.datasetIndex].todaydata);
                  const datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                  //var todaytotal = "Day total: " + todaydata[tooltipItem.index] || '';
                  //console.log("extratotal_label: " + this.extratotal_label);
                  const extratotal_label = this.extratotal_label !== undefined ? this.extratotal_label + ": " : "Day total";
                  
                  const extra_total_value = (chart.datasets[tooltipItem.datasetIndex].data2[tooltipItem.index]) 
                  ? extratotal_label + ": " +number_format(chart.datasets[tooltipItem.datasetIndex].data2[tooltipItem.index]) : "";
                  
                  const extratotal = extra_total_value || '';
                  
                  // return array so that cumulative total and day total appear on separate lines.
                  return [datasetLabel + ': ' + number_format(tooltipItem.yLabel),extratotal] ;

                }//.bind(this) // important so that this.isObject(obj) can be seen by the callback (if not using arrow function). 
              }
            }
          };
    }

}

module.exports = ChartConfigSetup;


