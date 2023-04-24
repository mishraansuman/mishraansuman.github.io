if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];
  $to = "youremail@example.com";
  $subject = "New message from contact form";
  $headers = "From: " . $name . " <" . $email . ">\r\n";
  $headers .= "Reply-To: " . $email . "\r\n";
  $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

  if (mail($to, $subject, $message, $headers)) {
    echo "Thank you for your message!";
  } else {
    echo "Oops! Something went wrong, please try again.";
  }
}
