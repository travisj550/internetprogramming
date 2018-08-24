function reveal(ident) {

    var x = document.getElementById(ident);

    if (x.style.display === "none") {
        x.style.display = "inline";
    } else {
        x.style.display = "none";
    }
}

function modifyRow(rowNum, assocArray) {

    for(i=0; i<10; i++) {

        reveal(i + " " + rowNum);

    }
    for(i=0; i<10; i++) {

        reveal("input" + i + " " + rowNum);

    }

/*
    document.getElementById(rowNum).innerHTML = 
    "\
    <form accept-charset=\"utf-8\" method=\"post\" action=\"modify.php\">\
    <td class=\"a\"><input class=\"a\" type=\"text\" name=\"brand\" value=\"" + assocArray["cpuBrand"] + "\"></input></td>\
    <td class=\"a\"><input class=\"a\" type=\"text\" name=\"model\" value=\"" + assocArray["cpuModel"] + "\"></input></td>\
    <td class=\"a\"><input class=\"a\" type=\"text\" name=\"freq\" value=\"" + assocArray["cpuFreq"] + "\"></input></td>\
    <td class=\"a\"><input class=\"a\" type=\"text\" name=\"cores\" value=\"" + assocArray["cpuCoreCount"] + "\"></input></td>\
    <td class=\"a\"><input class=\"a\" type=\"text\" name=\"threads\" value=\"" + assocArray["cpuThreadCount"] + "\"></input></td>\
    <td class=\"a\"><input class=\"a\" type=\"text\" name=\"socket\" value=\"" + assocArray["cpuSocket"] + "\"></input></td>\
    <td class=\"a\"><input class=\"a\" type=\"text\" name=\"igpu\" value=\"" + assocArray["cpuIGPU"] + "\"></input></td>\
    <td class=\"a\"><input class=\"a\" type=\"text\" name=\"l1\" value=\"" + assocArray["cpuL1"] + "\"></input></td>\
    <td class=\"a\"><input class=\"a\" type=\"text\" name=\"l2\" value=\"" + assocArray["cpuL2"] + "\"></input></td>\
\
    <td class='a'>\
    <input class=\"a\" type=\"submit\" value=\"Submit\"></input>\
    </td>\
    </form>\
    ";   
    */

    //document.getElementById("end " + rowNum).innerHTML =
    //"</form>";

    //document.getElementById("begin " + rowNum).innerHTML =
    //"<form accept-charset=\"utf-8\" method=\"post\" action=\"modify.php\">";


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