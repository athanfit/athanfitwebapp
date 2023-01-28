let add = document.getElementById('increase');
let remove = document.getElementById('decrease');
let reset = document.getElementById('reset');

let int = document.getElementById('count');
// let integer = 0;
integer = localStorage.getItem("counter");
int.innerHTML = integer;

add.addEventListener('click', function(){
    integer ++;
    if (integer > 9){
        integer = 9;
    }
    localStorage.setItem("counter", integer);
    int.innerHTML = integer;
})
remove.addEventListener('click', function(){
    integer --;
    if (integer < 0){
        integer = 0;
    }
    localStorage.setItem("counter", integer);
    int.innerHTML = integer;
})
reset.addEventListener('click', function(){
    integer = 0;
    localStorage.setItem("counter", integer);
    int.innerHTML = integer;
})