// Get all elements with the class "updateLink"
var updateLinks = document.querySelectorAll(".updateLink");

// Get the modal element
var modal = document.getElementById("myModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// Function to open the modal
function openModal() {
    event.preventDefault();
    modal.style.display = "block";
}

// Function to close the modal
function closeModal() {
    modal.style.display = "none";
}

// Loop through each link and add event listener
updateLinks.forEach(function(link) {
    link.addEventListener('click', openModal);
});

// When the user clicks on <span> (x), close the modal
span.onclick = closeModal;

// When the user clicks on Yes button, update the table
document.getElementById("confirmYes").onclick = function() {
    alert(" Updated successfully!"); 
    closeModal();
}

// When the user clicks on No button, close the modal
document.getElementById("confirmNo").onclick = closeModal;

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        closeModal();
    }
}

