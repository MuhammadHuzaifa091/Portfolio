

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    // Email configuration
    $receiving_email_address = 'muhammadhuzaifax50@gmail.com';

    // Include the PHP Email Form library
    require '../assets/vendor/php-email-form/php-email-form.php';

    // Instantiate PHP_Email_Form object
    $contact = new PHP_Email_Form;
    $contact->ajax = true;
    $contact->to = $receiving_email_address;
    $contact->from_name = $name;
    $contact->from_email = $email;
    $contact->subject = $subject;

    // SMTP configuration
    $contact->smtp = array(
        'host' => 'example.com',
        'username' => 'example',
        'password' => 'pass',
        'port' => 587,
       
    );

    // Add message parts
    $contact->add_message($name, 'From');
    $contact->add_message($email, 'Email');
    $contact->add_message($message, 'Message', 10);

    // Send email and output result
    echo $contact->send();
} else {
    // If not a POST request, handle accordingly (redirect or display error)
    echo "Error: Invalid request method";
}
?>
