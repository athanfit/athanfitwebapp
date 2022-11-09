var counter = 1;
var dynamicInput = [];

function addInput(){
    var newdiv = document.createElement('div');
    newdiv.id = dynamicInput[counter];
    newdiv.innerHTML = "Exersice" + "<div class='form-group'><input type='text' class='form-control' name='Exersice"+counter+"' id='Exersice'><button type='button' class='btn btn-outline-secondary smallBtn' onClick='removeInput("+dynamicInput[counter]+");'> - </button></div>";
    document.getElementById('exersices').appendChild(newdiv);
    counter++;
}
function removeInput(id){
    var elem = document.getElementById(id);
    return elem.parentNode.removeChild(elem);
}
// (counter + 1) + 