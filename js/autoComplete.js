function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function (e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false; }
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                /*make the matching letters bold:*/
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function (e) {
                    /*insert the value for the autocomplete text field:*/
                    inp.value = this.getElementsByTagName("input")[0].value;
                    /*close the list of autocompleted values,
                    (or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function (e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
            }
        }
    });
    function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}

/*An array containing all the country names in the world:*/
var exersices = ["Hip Thrust", 
"Hip Thrust Machine", 
"Hip Thrust With Band Around Knees", 
"Lateral Walk With Band", 
"One-Legged Glute Bridge", 
"One-Legged Hip Thrust", 
"Cable Crunch", "Crunch", 
"Hanging Leg Raise", 
"Hanging Knee Raise", 
"Hanging Sit-Up", 
"Kneeling Ab Wheel Roll-Out", 
"Kneeling Plank", 
"Kneeling Side Plank", 
"Lying Leg Raise", 
"Machine Crunch", 
"Oblique Crunch", 
"Oblique Sit-Up" ,
"Plank", 
"Side Plank", 
"Sit-Up", 
"Eccentric Heel Drop", 
"Heel Raise", 
"Seated Calf Raise", 
"Standing Calf Raise", 
"Barbell Wrist Curl", 
"Barbell Wrist Curl Behind the Back", 
"Bar Hang", "Dumbbell Wrist Curl", 
"Farmers Walk", "Gripper", 
"One-Handed Bar Hang",
"Barbell Wrist Extension",
"Dumbbell Wrist Extension",
"Band Pull-Apart",
"Barbell Front Raise",
"Barbell Rear Delt Row",
"Barbell Upright Row",
"Behind the Neck Press",
"Cable Lateral Raise",
"Cable Rear Delt Row",
"Dumbbell Front Raise",
"Dumbbell Lateral Raise",
"Dumbbell Rear Delt Row",
"Dumbbell Shoulder Press",
"Face Pull",
"Machine Lateral Raise",
"Machine Shoulder Press",
"Overhead Press",
"Power Jerk",
"Push Press",
"Reverse Dumbbell Flyes",
"Reverse Machine Fly",
"Seated Dumbbell Shoulder Press",
"Seated Barbell Overhead Press",
"Seated Smith Machine Shoulder Press",
"Bar Dip",
"Bench Press",
"Cable Chest Press",
"Close-Grip Bench Press",
"Decline Bench Press",
"Dumbbell Chest Fly",
"Dumbbell Chest Press",
"Incline Bench Press",
"Incline Dumbbell Press",
"Incline Push-Up",
"Kneeling Push-Up",
"Machine Chest Fly",
"Machine Chest Press",
"Push-Up",
"Push-Up Against Wall",
"Barbell Curl",
"Barbell Preacher Curl",
"Cable Curl With Bar",
"Cable Curl With Rope",
"Dumbbell Curl",
"Dumbbell Preacher Curl",
"Hammer Curl",
"Spider Curl",
"Barbell Standing Triceps Extension",
"Barbell Lying Triceps Extension",
"Bench Dip",
"Close-Grip Push-Up",
"Dumbbell Lying Triceps Extension",
"Dumbbell Standing Triceps Extension",
"Overhead Cable Triceps Extension",
"Tricep Pushdown With Bar",
"Tricep Pushdown With Rope",
"Air Squat",
"Barbell Hack Squat",
"Barbell Lunge",
"Body Weight Lunge",
"Box Squat",
"Bulgarian Split Squat",
"Chair Squat",
"Dumbbell Lunge",
"Dumbbell Squat",
"Front Squat",
"Hack Squats",
"Hip Adduction Machine",
"Landmine Hack Squat",
"Landmine Squat",
"Leg Extension",
"Leg Press",
"Lying Leg Curl",
"Pause Squat",
"Seated Leg Curl",
"Side Lunges (Bodyweight)",
"Smith Machine Back Squat",
"Back Squat",
"Step Up",
"Cable Close Grip Seated Row",
"Cable Wide Grip Seated Row",
"Barbell Shrug",
"Back Extension",
"Barbell Row",
"Deficit Deadlift",
"Dumbbell Deadlift",
"Deadlift",
"Chin-Up",
"Hang Clean",
"Hang Power Clean",
"Hang Power Snatch",
"Hang Snatch",
"Dumbbell Row",
"Dumbbell Shrug",
"Floor Back Extension",
"Good Morning",
"Dumbbell Romanian Deadlift",
"Inverted Row",
"Inverted Row with Underhand Grip",
"Kettlebell Swing",
"Lat Pulldown",
"Lat Pulldown With Supinated Grip",
"Pull-Up",
"One-Handed Cable Row",
"One-Handed Lat Pulldown",
"Pause Deadlift",
"Pendlay Row",
"Power Clean",
"Power Snatch",
"Romanian Deadlift",
"Sumo Deadlift",
"Trap Bar Deadlift",
"Straight Arm Lat Pulldown",
"Stiff-Leg Deadlift",
"Seal Row",
"Seated Machine Row",
"Snatch",
"Banded Side Kick",
"Cable Pull-Through",
"Clamshells",
"Fire Hydrants",
"Glute Bridge",
"Hip Abduction Against Band",
"Hip Abduction Machine",

"Running",
"Walking",
"Cycling",
"Cycling on road bike"
];