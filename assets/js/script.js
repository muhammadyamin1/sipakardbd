//Tampil Password Form Login
function togglePassword() {
  var passwordField = document.getElementById("yourPassword");
  if (passwordField.type === "password") {
    passwordField.type = "text";
  } else {
    passwordField.type = "password";
  }
}

document.addEventListener('DOMContentLoaded', function() {
  // Hide the alert after 3 seconds (3000 milliseconds)
  setTimeout(function() {
    var alert = document.querySelector('.floating-alert');
    if (alert) {
        // Close the alert using Bootstrap's built-in method
        var bootstrapAlert = new bootstrap.Alert(alert);
        bootstrapAlert.close();
    }
}, 10000);
});