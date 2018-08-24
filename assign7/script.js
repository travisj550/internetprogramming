function reveal(ident) {

    var x = document.getElementById(ident);

    if (x.style.display === "none") {
        x.style.display = "inline";
    }
    else {
        x.style.display = "none";
    }
}

function toggle(ident, todo) {

    var x = document.getElementById(ident);

    if (todo == 1) {
        x.style.display = "table-row";
    }
    if (todo == 0) {
        x.style.display = "none";
    }
}
/*
function toTop(assocArray) {

    var allIDArr = assocArray.match(/\d+/g);

    document.getElementById("test").innerHTML = allIDArr;

    document.getElementById("top").innerHTML = 
    "<form id=\"filter\" accept-charset=\"utf-8\">\
    <input type=\"text\" onkeyup=\"javascript:filterTable(this.value, " + "\'" + allIDArr + "\'" + ")\"></input>\
    </form>";
}
*/

function modifyRow(rowNum, assocArray) {

    for(i=0; i<10; i++) {

        reveal(i + " " + rowNum);

    }
    for(i=0; i<10; i++) {

        reveal("input" + i + " " + rowNum);

    }
}

function removeRow(rowNum, assocArray) {

    document.getElementById(rowNum + " submit").innerHTML = 
    "<form accept-charset=\"utf-8\" method=\"post\" action=\"remove.php\">\
    \
    <input type=\"hidden\" name=\"cpuid\" value=\"" + assocArray["cpuID"] + "\"></input>\
    <td class='a'>\
    <input class=\"a\" type=\"submit\" value=\"Confirm\"></input>\
    </td>\
    </form>";
}

function filterTable(string, allID) {

    if(string.length == 0) {

        //testing
        //document.getElementById("test").innerHTML = allID;
        //Display entire table
        for(var i=0; i<allID.length; i++) {

            toggle(allID[i], 1);
        }
        return;
    }

    else {
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {


            var str = xmlhttp.responseText;
            var id = str.match(/\d+/g);

            //testing
            //document.getElementById("test2").innerHTML = id;

            //responsetext should probably be inside this if
            if(this.readyState == 4 && this.status == 200) {
                //Display filtered results as a table
                for(var i=0; i<allID.length; i++) {

                    var found=0;
                    for(var j=0; j<id.length; j++) {

                        if(allID[i] == id[j]) {
                            toggle(id[j], 1);
                            found=1;
                            break;
                        }
                    }
                    if(found == 0) {
                        toggle(allID[i], 0);
                    }
                }
            }
        };
        //POST to php script. GET if laggy
        //need to parse original string into substrings...
        xmlhttp.open("GET", "filter.php?in1=" + string, true);
        //Pull vars from user input and send. Iterate through an array of vars?
        //Or a maximum number of vars...
        xmlhttp.send();
    }
}