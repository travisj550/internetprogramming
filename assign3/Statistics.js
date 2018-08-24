$(document).ready(function() {

	$("#stats").fadeIn(100,function(){
		$("#input").fadeIn(150);
		$("#input").focus();
	});

	$("#submit").click(function(){
	    $("#results").hide();
		$("#results").fadeIn();
	});

});

function createArray() {
	
	var string = document.forms["mainForm"]["data"].value;
	var x=0;
	
	var data = string.match(/-*\d+\.*\d*/g);
	
	data.sort(function(a, b){return a - b});
	
	var stats = {n:0, s:0, mean:0, med:0, mode:0, vari:0, std:0};
	
	stats = findN(data, stats);
	document.getElementById("n").innerHTML = "Count: " + stats.n;
	
	stats = findSum(data, stats);
	document.getElementById("s").innerHTML = "Summation: " + stats.s.toFixed(2);
	
	stats = findMean(data, stats);
	document.getElementById("mean").innerHTML = "Mean: " + stats.mean.toFixed(2);
	
	stats = findMedian(data, stats);
	document.getElementById("med").innerHTML = "Median: " + stats.med.toFixed(2);
		
	stats = findVariance(data, stats);
	document.getElementById("vari").innerHTML = "Variance: " + stats.vari.toFixed(2);
	
	stats = findStandardDeviation(data, stats);
	document.getElementById("std").innerHTML = "Standard Deviation: " + stats.std.toFixed(2);
	
	stats = findMode(data, stats);
	document.getElementById("mode").innerHTML = "Mode: " + stats.mode;
}

function findN(data, stats) {
	
	stats.n = data.length;
		
	return stats;
}

function sumFunction(s, n) {
	return Number(s) + Number(n);
}

function findSum(data, stats) {
	
	stats.s = data.reduce(sumFunction);
	
	return stats;
}

function findMean(data, stats) {
	
	stats.mean = stats.s/stats.n;
	
	return stats;
}

function findMedian(data, stats) {
	
	if(stats.n % 2 == 0) {
		stats.med = (Number(data[stats.n/2 - 1]) + Number(data[stats.n/2])) / 2;
	}
	else {
		stats.med = Number(data[Math.floor(stats.n/2)]);
	}
		
	return stats;
}

function findMode(data, stats) {
	
	var freq = new Array(stats.n);
		
	for(i=0; i<stats.n; i++) {
		freq[i] = new Array(2);
	}
	
	var temp=0;
		
	for(i=0; i<stats.n; i++) {
		
		temp = Number(data[i]);
		
		for(j=0; j<stats.n; j++) {

			if(temp == freq[j][0]) {
				freq[j][1]++;
				break;
			}
			else if(typeof freq[j][0] !== 'number'){
				freq[j][0] = temp;
				freq[j][1] = 1;
				break;
			}
		}
	}
	
	var current=0;
	
	for(i=0; i<stats.n; i++) {
		
		if(freq[i][1] > current) {
			current = freq[i][1];
		}
	}
	
	var modes = new Array(0);
	
	for(i=0; i<stats.n; i++) {
		
		if(freq[i][1] == current) {
			modes.push(freq[i][0]);
		}
	}
	
	stats.mode = modes.toString();
		
	return stats;
}

function findVariance(data, stats) {
		
	var temp = 0;
	
	for(i=0; i<stats.n; i++) {
		temp += data[i]**2
	}
		
	stats.vari = (temp - (stats.s**2 / stats.n)) / (stats.n-1);
	
	return stats;
}

function findStandardDeviation(data, stats) {
	
	stats.std = Math.sqrt(stats.vari);
		
	return stats;
}
