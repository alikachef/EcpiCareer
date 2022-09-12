

var modal = document.getElementById("usermodal");

// Get the button that opens the modal
var ubtn = document.getElementById("mybtn");
if(ubtn){
    console.log("ture")
}
else{
    console.log("false")
}
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
ubtn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}