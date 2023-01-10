var counter = 1;
var dynamicInput = [];

function addInput(value){
    var newdiv = document.createElement('div');
    newdiv.id = counter;
    if (value){
        var exercise = value
    } else {
        var exercise = "";
    }
    newdiv.innerHTML = "Exersice" + "<div class='form-group'><input value='"+exercise+"' type='text' class='form-control' name='Exersice"+counter+"' id='"+counter+"' placeholder='Squat'><input value='"+exercise+"' type='text' class='form-control' name='Set"+counter+"' id='"+counter+"' placeholder='6-8reps 3sets'><button type='button' class='btn btn-outline-secondary smallBtn' onClick='removeInput("+counter+");'>Remove</button></div>";
    document.getElementById('exersices').appendChild(newdiv);
    counter++;
}
function removeInput(id){
    var elem = document.getElementById(id);
    return elem.parentNode.removeChild(elem);
}