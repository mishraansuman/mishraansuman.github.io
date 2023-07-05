// Execute the code when the window finishes loading
window.onload = () => {
  // Show a SweetAlert notification to inform the user
  swal({
    text: "'Project Section' is under development, will be updated fully in few hours.",
    buttons: "I understand",
  });
};
document.querySelector('.contact-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission
    // Redirect to the custom submit.html page
    window.location.href = '/submit.html';
  });