function myFunction(elem, file) {
    var ubtn = elem.id;
    open(ubtn, file);
}

function open(id, file) {


    var modal = document.getElementById("usermodal");
    
    modal.style.display = "block";

    document.getElementById("content").innerHTML = `</iframe><iframe  class="resume"  src="data:application/pdf;base64,` + file + `"></iframe>` + 
                                                    `<div class="mt-2 modal-footer">
                                                    <button type="button" class="btn btn-danger close-modal">Close</button>
                                                    </div>`;

    var span = document.getElementsByClassName("close-modal")[0];

    span.onclick = function () {
        modal.style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}