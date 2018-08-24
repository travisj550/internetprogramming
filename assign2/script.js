function resetForm() {
	
    document.getElementById("mainForm").reset();
}

function validateForm() {
	
	var p = document.forms["mainForm"]["principle"].value;
	var r = document.forms["mainForm"]["rate"].value;
	var t = document.forms["mainForm"]["time"].value;
	
	var s = document.forms["mainForm"]["goal"].value;
	
	document.getElementById("test").innerHTML = s;
	
	if(p < 0 || p == 0) {
		document.getElementById("amount").innerHTML = "Please enter an amount larger than 0 with up to 2 decimal places:";
		document.mainForm.principle.focus();
		return false;
	}
	if(r < 0 || r == 0) {
		document.getElementById("interest").innerHTML = "Please enter an annual interest rate larger than 0 with up to 2 decimal places:"
		document.mainForm.rate.focus();
		return false;
	}
	if(t < 0 || t == 0) {
		document.getElementById("date").innerHTML = "Please enter a number of months larger than 0 with up to 2 decimal places:";
		document.mainForm.time.focus();
		return false;
	}
	switch(s) {
		case "savings":
			saveFunction();
			break;
		case "debt":
			debtFunction();
			break;
	}
	return true;
}

function saveFunction() {
	
	var a = document.forms["mainForm"]["principle"].value;
	var r = document.forms["mainForm"]["rate"].value;
	var t = document.forms["mainForm"]["time"].value;
	var comp = document.forms["mainForm"]["compounding"].value;
	var n = 0;
	
	if(comp == 1)
		n=1;
	if(comp == 12)
		n=12;
	if(comp == 365)
		n=365;
	
	r /= 100;
	t /= 12;
	
	var p = a / ((1 + r/n) ** (n*t));
	
	p /= 12;
	var out = p.toFixed(2);
	
	document.getElementById("test").innerHTML = out;
	
	
	return true;
}

function debtFunction() {
	
	var p = document.forms["mainForm"]["principle"].value;
	var r = document.forms["mainForm"]["rate"].value;
	var t = document.forms["mainForm"]["time"].value;
	
	r /= 100;
	t /= 12;
	
	var a = (r * p) / (1 - (1+r) ** (-t));
	
	a /= 12;
	var out = a.toFixed(2);
		
	document.getElementById("first").innerHTML = "Your monthly savings or payment will need to be:";
	
	document.getElementById("test").innerHTML = out;
	
	return true;
}