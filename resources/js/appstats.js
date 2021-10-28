/*
 ** NOTE: This js file is for /cstats page code. See ./app.js for weather app, etc. code. **
 * NOTE: Currently based on Chart.js 2.9.4 ! https://www.chartjs.org/docs/2.9.4/
 */
//const ChartConfigSetup = require('./chartconfigsetup');
import ChartConfigSetup from './chartconfigsetup';
import { alertsCenterList,alertsCenterListPopulate, casesPieChartData, casesPieChartOptions, setGraphCardLinks, drawChartData } from './chartconfig_functions';
window.ChartConfigSetup = ChartConfigSetup; // Allow access to ChartConfigSetup in browser window html/script tags, for now

require('./bootstrap');

import $ from 'jquery';

//var global_result; //* Debugging in console. REMOVE when finished
var post_data; //* Debugging in console. REMOVE
document.addEventListener('DOMContentLoaded', function () {
//new Greeting().sayGoodbye();

    function formatTodaysDate() {
        var d = new Date(),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) 
            month = '0' + month;
        if (day.length < 2) 
            day = '0' + day;

        return [year, month, day].join('-');
    }

    //post_data = $.post("/cvstats", {"date_from":"2020-02-01", "date_to":formatTodaysDate() , "_token": $('meta[name="csrf-token"]').attr('content')}, function(result){
    $.ajax({url:"/cvstats", type: "POST", data: {"date_from":"2020-02-01", "date_to":formatTodaysDate() },
        dataType:  "json",headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Stop calls that are not from this web (sub)domain's Laravel app
    }})
    .done(function(result){
        
        //console.log("Debug Result:"); console.log(result);

       if(result === null || result === undefined)
       {
           console.log("== Error: Result status ===");
           console.log(result);
           displayNumericData();
           alert("No data!");
           return false;
       }
       
       if(result.message === undefined || result.message === null)
       {
           console.log("== Error: result.message status ===");
           console.log(result);
           displayNumericData();
           alert("No data message!");
           return false;
       }
           testingFunction(result);      
           //console.log("== Last Modified ==="); console.log(result);
           resultProcess(result);
           //return true;
    })
    .fail(function( jqXHR, textStatus ) {
        console.log( "Request failed: " + textStatus );
    });

});

function displayNumericData(data_object, data_date)
{
    if(data_object === undefined || data_object === null)
    {
        data_object = {};
        data_object.data  ="<i class=\"fas fa-cross\"></i>";
    
        if(data_date === undefined || data_date === null)
        {
            data_object.date = "(No data!)";
        }
    }
    

        $("#total_cases_to_date").html(number_format(data_object.data));
        $("#total_cases_to_date_date").html(data_object.date);
        $("#total_deaths_to_date").html(number_format(data_object.data));
        $("#total_deaths_to_date_date").html(data_object.date);
        $("#total_cases_for_date_date").html(data_object.date);
        $("#total_cases_for_date").html(number_format(data_object.data));
        $("#total_deaths_for_date_date").html(data_object.date);
        $("#total_deaths_for_date").html(number_format(data_object.data));
        $("#average_weekly_cases_date").html(number_format(data_object.data));
        $("#average_weekly_cases_date_date").html(data_object.date);
}
function resultProcess(result)
{

       if(document.getElementById("total_cases_to_date")!== null)
       {         
            const cases_to_date = result.message[result.message.length -1].cases;
            const cases_today = result.message[result.message.length -1].cases_today;
            const deaths_to_date = result.message[result.message.length -1].expired;
            const deaths_today = result.message[result.message.length -1].expired_today;
            const to_date_date = result.message[result.message.length -1].date_format;
            const weekly_average_cases = result.message[result.message.length -1].cases_average;
            //console.log(cases_to_date);

            $("#total_cases_to_date").html(number_format(cases_to_date));
            $("#total_cases_to_date_date").html(to_date_date);
            $("#total_deaths_to_date").html(number_format(deaths_to_date));
            $("#total_deaths_to_date_date").html(to_date_date);
            $("#total_cases_for_date_date").html(to_date_date);
            $("#total_cases_for_date").html(number_format(cases_today));
            $("#total_deaths_for_date_date").html(to_date_date);
            $("#total_deaths_for_date").html(number_format(deaths_today));
            $("#average_weekly_cases_date").html(number_format(weekly_average_cases));
            $("#average_weekly_cases_date_date").html(to_date_date);
       }
        const cColor = "rgba(78, 115, 223, 1)"; // Blue-ish alternating bar chart colors
        const cColor2 = "rgba(104, 135, 227, 1)"; // Blue-ish alternating bar chart colors
        
        const dColor = "rgba(230, 138, 0, 1)"; // Orangey alternating bar chart colors
        const dColor2 = "rgba(255, 163, 26, 1)"; // Orangey alternating bar chart colors
       
       //** Graph Covid Cases In the UK | START
        const cConfig = new ChartConfigSetup(result); //* Updated way of doing things
        cConfig.getGraphLabels("date");
        cConfig.getGraphData1("cases");
        cConfig.getGraphData2("cases_today");
        //c_extra_config = {label:"Total Cases", labels:caseslabels, data_array:casesdata, todaydata:casestodaydata};
        //cConfig.label = "Total Cases";
        cConfig.dataExtraConfig({label:"Total Cases"}); //  labels data_array todaydata

        drawChartData(cConfig,"covidCasesChart");
        
        //** Graph Covid Cases In the UK | END
        //////////////////////////////////////
        const start_item = (result.message.length -7);
        
        //////////////////////////////////////
        //** Graph: Average Weekly Cases trend | START
        const av_start_item = (result.message.length -15);
        const loop_step = 7;
        const cAvgWeek = new ChartConfigSetup(result); //* Updated way of doing things
        cAvgWeek.getGraphAveragesLabels("date", av_start_item, loop_step);
        cAvgWeek.getGraphAveragesData("cases_average", av_start_item, loop_step);
        //cAvgWeek.getGraphData1("cases_today",start_item);

        cAvgWeek.dataExtraConfig({label:"Average"}); //  labels data_array todaydata
            
        drawChartData(cAvgWeek,"weeklyAverageCasesTrendChart");       
        //** Graph: Average Weekly Cases trend | END
        
        //////////////////////////////////////
        
        //** Graph Covid Expired In the UK | START
        const dConfig = new ChartConfigSetup(result); //* Updated way of doing things
        dConfig.getGraphLabels("date");
        dConfig.getGraphData1("expired");
        dConfig.getGraphData2("expired_today");

        dConfig.dataExtraConfig({label:"Total Deaths", borderColor:dColor, pointBorderColor:dColor, pointBackgroundColor:dColor}); //  labels data_array todaydata
            
        drawChartData(dConfig,"covidDeathsChart");
        
        //** Graph Covid Expired In the UK | END
        //////////////////////////////////////
        //
        //** Graph: Cases Last Seven Days | START
        
        const c7Config = new ChartConfigSetup(result); //* Updated way of doing things
        c7Config.getGraphLabels("date", start_item);
        c7Config.getGraphData2("cases", start_item);
        c7Config.getGraphData1("cases_today",start_item);

        c7Config.dataExtraConfig({label:"Cases for day", extratotal_label:"Total to date", type: "bar", 
            backgroundColor:[cColor, cColor2, cColor, cColor2, cColor, cColor2, cColor]}); //  labels data_array todaydata
            
        drawChartData(c7Config,"casesSevenDays");     
 
        // Graph: Cases Last Seven Days | END
        //////////////////////////////////////
        //
        //** Graph: Expired Last Seven Days | START
        
        //start_item = (result.message.length -7);
        const d7Config = new ChartConfigSetup(result); //* Updated way of doing things
        d7Config.getGraphLabels("date", start_item);
        d7Config.getGraphData2("expired", start_item);
        d7Config.getGraphData1("expired_today",start_item);

        d7Config.dataExtraConfig({label:"Deaths for day",extratotal_label:"Total to date", type: "bar", 
            backgroundColor:[dColor, dColor2, dColor, dColor2, dColor, dColor2, dColor]}); //  labels data_array todaydata
            
        drawChartData(d7Config,"deathsSevenDays");       
        //** Graph: Expired Last Seven Days | END
        
        ///////////////////////////////////////
        //** Graph: Average Weekly Expired trend | START

        const dAvgWeek = new ChartConfigSetup(result); //* Updated way of doing things
        dAvgWeek.getGraphAveragesLabels("date", av_start_item, loop_step);
        dAvgWeek.getGraphAveragesData("expired_average", av_start_item, loop_step);
        //cAvgWeek.getGraphData1("cases_today",start_item);
        //console.log("Average Week Deaths Debug");
        
        //** NEW: October 2021: Restrict line graph for Avg expired per week.
        const d_opt_set = dAvgWeek.getOptionsSettings();
        //console.log(d_opt_set);
        d_opt_set.scales.yAxes[0].ticks.suggestedMin = 50;
        //console.log(d_opt_set.scales.yAxes[0].ticks.suggestedMin);
        dAvgWeek.setOptionsSettings(d_opt_set);
        
        dAvgWeek.dataExtraConfig({label:"Average",borderColor:dColor, pointBorderColor:dColor2, pointBackgroundColor:dColor}); //  labels data_array todaydata

            
        drawChartData(dAvgWeek,"weeklyAverageExpiredTrendChart");       
        //** Graph: Average Weekly Expired trend | END        
        ///////////////////////////////////////
        //** Pie chart: Monthly total cases for six months | START
        
        const cSixMonths = new ChartConfigSetup(result); //* Updated way of doing things
        //console.log('cSixMonths = new ChartConfigSetup(result.message);');
        cSixMonths.getSixIndividualMonthsData("cases_today");
       
        cSixMonths.dataExtraConfig({label:"Cases per month", type: "pie"}); //  labels data_array todaydata
        
        cSixMonths.setDataSettings(casesPieChartData(cSixMonths)) ; 
        cSixMonths.setOptionsSettings(casesPieChartOptions());
        
        drawChartData(cSixMonths,"monthlyCasesTotalsSixMonth"); 
        
        //** Pie chart: Monthly total cases for six months | END
        
        setGraphCardLinks(); // Create links dynamically on the Graph display card menu

        alertsCenterList(cSixMonths.getAlertMessages());    
}
