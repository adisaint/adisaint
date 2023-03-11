function getPassword() {
    let xmlHttp;
    if (window.XMLHttpRequest) {
        xmlHttp = new XMLHttpRequest();
    } else {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState === 4 && xmlHttp.status === 200) {
            document.getElementById("myDiv").innerHTML = xmlHttp.responseText;
        }
    }
    xmlHttp.open("POST", "../../../php/query/account/password.php", true);
    xmlHttp.send();
}