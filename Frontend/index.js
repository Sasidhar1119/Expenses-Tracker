// Open the popup form
function openform() {
    document.getElementById("myform").style.display = "block";
}

// Close the popup form
function closeForm() {
    document.getElementById("myform").style.display = "none";
}


// Function to show the success message
function showPopup() {
    closeForm();
    var popup = document.getElementById("popupMessage");
    popup.style.display = "block";
    setTimeout(function () { popup.style.display = "none"; }, 3000); // Hide popup after 3 seconds
}

function closePopup() {
    var popup = document.getElementById("popupMessage");
    popup.style.display = "none";
}


// Add event listener to form submission
document.addEventListener("DOMContentLoaded", function () {
    // Your form event listener and other code here
    document.getElementById("expenseForm").addEventListener("submit", submitForm);
});

// Function to submit form data using AJAX
function submitForm(event) {
    console.log("hello world");
    event.preventDefault(); // Prevent default form submission
    var formData = new FormData(document.getElementById("expenseForm"));

    // Send form data using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../project.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Form submitted successfully, show popup message
                showPopup();
            } else {
                // Error handling
                console.error("Form submission failed with status code: " + xhr.status);
            }
        }
    };
    xhr.send(formData);
}


