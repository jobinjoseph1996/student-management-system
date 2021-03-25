$(document).ready(function () {
   
});

function loadAddForm(controller) 
{

    window.location = base_url + "/" + controller + "/create";
}
//cancel
function cancel() {
    window.location  = base_url + "/" +  "student";
}