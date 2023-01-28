var counter = 1;
var dynamicInput = [];

function addInput(value1, value2){
    var newdiv = document.createElement('div');
    newdiv.id = counter;
    if (value1, value2){
        var exercise = value1;
        var set = value2;
    } else {
        var exercise = "";
        var set = "";
    }
    newdiv.innerHTML = "Exersice" + "<div class='form-group'><input value='"+exercise+"' type='text' class='form-control' name='Exersice"+counter+"' id='"+counter+"' placeholder='Squat'><input value='"+set+"' type='text' class='form-control' name='Set"+set+"' id='"+set+"' placeholder='6-8reps 3sets'><button type='button' class='btn btn-outline-secondary smallBtn' onClick='removeInput("+counter+");'>Remove</button></div>";
    document.getElementById('exersices').appendChild(newdiv);
    counter++;
}
function removeInput(id){
    var elem = document.getElementById(id);
    return elem.parentNode.removeChild(elem);
}