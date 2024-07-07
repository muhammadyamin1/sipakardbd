//Tampil Password Form Login
function togglePassword() {
  var passwordField = document.getElementById("yourPassword");
  if (passwordField.type === "password") {
    passwordField.type = "text";
  } else {
    passwordField.type = "password";
  }
}

document.addEventListener('DOMContentLoaded', function () {
  // Hide the alert after 3 seconds (3000 milliseconds)
  setTimeout(function () {
    var alert = document.querySelector('.floating-alert');
    if (alert) {
      // Close the alert using Bootstrap's built-in method
      var bootstrapAlert = new bootstrap.Alert(alert);
      bootstrapAlert.close();
    }
  }, 10000);

  // Tampil Password Form
  const togglePassword = document.getElementById('togglePassword');
  const password = document.getElementById('password');
  const eyeIcon = document.getElementById('eyeIcon');

  togglePassword.addEventListener('click', function () {
    // Toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    // Toggle the eye / eye-slash icon
    eyeIcon.classList.toggle('bi-eye');
    eyeIcon.classList.toggle('bi-eye-slash');
  });

  /**
   * Initiate tooltips
   */
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  });

  // Menambahkan event listener untuk tombol disabled agar tidak dapat di klik
  document.querySelectorAll('.disabled-button').forEach(button => {
    button.addEventListener('click', function (event) {
      event.preventDefault();
    });
  });
});