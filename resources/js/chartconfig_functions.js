 export { alertsCenterList,alertsCenterListPopulate, casesPieChartData, casesPieChartOptions, setGraphCardLinks, drawChartData }
function alertsCenterList(messages)
{
    // id-s alerts-center-count alerts-center-items alerts center
    let items = document.getElementById("alerts-center-items").innerHTML;
    //console.log(items);
    document.getElementById("alerts-center-count").innerHTML = messages.alert_data_length;
    if(messages.latest_cases !== undefined)
    {
        var message = "There have been " + number_format(messages.latest_cases[0]) + " cases so far this month.";
        items += alertsCenterListPopulate(messages.latest_cases[1] ,message);
    }
    
    if(messages.latest_deaths !== undefined)
    {
        var message = "There have been " + number_format(messages.latest_deaths[0]) + " deaths in the current reporting month.";
        items += alertsCenterListPopulate(messages.latest_deaths[1] ,message, "fa-exclamation", "bg-warning");
    }
    if(messages.days_since_update !== undefined)
    {
        const bg_string = (messages.days_since_update[2] !== undefined && messages.days_since_update[2] === 1)? "bg-warning" 
        :(messages.days_since_update[2] !== undefined && messages.days_since_update[2] === 0)?"bg-info": "bg-danger";
        items += alertsCenterListPopulate(messages.days_since_update[1] ,messages.days_since_update[0], "fa-clock", bg_string);
    }
    document.getElementById("alerts-center-items").innerHTML = items;
    //console.log(items);
}

function alertsCenterListPopulate(date,message,icon, icon_color)
{
    icon = (icon === undefined)? "fa-file-alt": icon;
    icon_color = (icon_color === undefined)? "bg-primary": icon_color;
    
    var string = '<a class="dropdown-item d-flex align-items-center" href="#">';
    string +='<div class="mr-3">';
     string +='<div class="icon-circle ' + icon_color + '"><i class="fas ' + icon +' text-white"></i>';
     string +='</div>';
     string +='</div>';
     string += '<div>';
     string += '<div class="small text-gray-500">' + date + '</div>';
     string += '<span class="">' + message + '</span>';
     string +='</div>';
     return string += '</a>';
}

function casesPieChartData(chartObj)
{
    return {
        datasets: [{
            data: chartObj.graphData1,
            backgroundColor: ["rgb(230, 0, 50)","rgb(102, 140, 255)","rgb(217, 179, 255)", "rgb(179, 179, 179)", "rgb(0, 179, 0)", "rgb(255, 184, 51)"],
        }],

        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: chartObj.labels,

    };    
}

function casesPieChartOptions()
{
    return {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
              legend: {
                position: 'top',
              },
              title: {
                display: true,
                text: 'Total cases per month'
              }
            },
            tooltips: {
                xPadding: 15,
              yPadding: 15,
                callbacks: {
                    label: (tooltipItem, chart)=> {
                        
                    const returndisplay = new Array();
                    //console.log(chart.labels[tooltipItem.index]);
                    const label = chart.labels[tooltipItem.index] || '';
                    if(label !== "")
                    {
                        returndisplay[returndisplay.length] = label;
                    }
                    
                    returndisplay[returndisplay.length] = number_format(chart.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]);
                    // Return whatever is in the array (separated by ": " if length is 2 or on separate lines) as the tooltip label.
                    return (returndisplay.length === 2)?returndisplay.join(": "): returndisplay ; 

                }
              }
            }
          };
}

function setGraphCardLinks()
{
    const in_page_links = document.getElementsByClassName("in_page_link");
    var links_list = "";
    for(var i in in_page_links)
    {
        
        if(in_page_links[i].id !== undefined)
        {
            // Replace dashes in link name to formulate link title
            var label = in_page_links[i].id.replace(/\-/g, " ");
            // Capitalise all words in the link title (no 'php style' ucwords function in JavaScript).
            label = label.replace(/\w\S*/g, (w) => (w.replace(/^\w/, (c) => c.toUpperCase())));;
            links_list += '<a class="dropdown-item" href="#' + in_page_links[i].id +'">' + label + '</a>' + "\n";
        }
        
    }
    
    if(document.getElementsByClassName("stats-dropdown-menu")!== null)
    {
        var stats_dropdown = document.getElementsByClassName("stats-dropdown-menu");
        for (var n in document.getElementsByClassName("stats-dropdown-menu") )
        {
            if(stats_dropdown[n].innerHTML !== undefined)
            {
                stats_dropdown[n].innerHTML = stats_dropdown[n].innerHTML + links_list;
            }
            
        }
    }
    
    //console.log(links_list);
}

//* Draw the chart once all parameters have been set for each graph.
function drawChartData(chartConfig, chartname, extra_data)
{
    if(document.getElementById(chartname)!== null)
    {
        var ctx = document.getElementById(chartname);
        new Chart(ctx, chartConfig.config());         
    }    
}  



