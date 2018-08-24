google.charts.load('upcoming', {'packages':['corechart']});
google.charts.setOnLoadCallback(load);

function drawChart(set) {

    var first = google.visualization.arrayToDataTable([
        ['Category', 'Percent of Total', { role: 'style' }],
        ['Services',     72.6, 'red'],
        ['Industry',      24.7, 'blue'],
        ['Agriculture', 2.8, 'green'],
      ]);
      var second = google.visualization.arrayToDataTable([
        ['Category', 'Percent of Total', { role: 'style' }],
        ['Services',     73.8, 'red'],
        ['Industry',      23.6, 'blue'],
        ['Agriculture', 2.7, 'green'],
      ]);
      var third = google.visualization.arrayToDataTable([
        ['Category', 'Percent of Total', { role: 'style' }],
        ['Services',     77, 'red'],
        ['Industry',      21.3, 'blue'],
        ['Agriculture', 1.7, 'green'],
      ]);
      var fourth = google.visualization.arrayToDataTable([
        ['Category', 'Percent of Total', { role: 'style' }],
        ['Services',     79.6, 'red'],
        ['Industry',      18.9, 'blue'],
        ['Agriculture', 1.5, 'green'],
      ]);
      var fifth = google.visualization.arrayToDataTable([
        ['Category', 'Percent of Total', { role: 'style' }],
        ['Services',     79.5, 'red'],
        ['Industry',      18.9, 'blue'],
        ['Agriculture', 1.7, 'green'],
      ]);

    var options = {
        legend: 'none',
        backgroundColor: 'LightGrey',
        animation: {"startup": true, duration: 200},
      };

    var chart = new google.visualization.BarChart(document.getElementById('consumption'));

    if(set == 1) {
        document.getElementById("year").innerHTML = "1991";
        chart.draw(first, options);
    }
    if(set == 2) {
        document.getElementById("year").innerHTML = "1997";
        chart.draw(second, options);
    }
    if(set == 3) {
        document.getElementById("year").innerHTML = "2003";
        chart.draw(third, options);
    }
    if(set == 4) {
        document.getElementById("year").innerHTML = "2009";
        chart.draw(fourth, options);
    }
    if(set == 5) {
        document.getElementById("year").innerHTML = "2015";
        chart.draw(fifth, options);
    }

}

function load() {

    drawChart(1);
    
        setTimeout("drawChart(2);", 2000);
        setTimeout("drawChart(3);", 4000);
        setTimeout("drawChart(4);", 6000);
        setTimeout("drawChart(5);", 8000);

    setInterval(function() {

        drawChart(1);
        setTimeout("drawChart(2);", 2000);
        setTimeout("drawChart(3);", 4000);
        setTimeout("drawChart(4);", 6000);
        setTimeout("drawChart(5);", 8000);
        
    }, 10000)
}

$(document).ready(function() {
    
	$("#background").fadeIn(150);

});