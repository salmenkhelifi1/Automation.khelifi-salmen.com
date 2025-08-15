<?php
// Variables
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$business = trim($_POST['business']); // Added business field
$details = trim($_POST['details']);   // Added details field

// Email address validation
function is_email_valid($email)
{
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}


if (isset($name) && isset($email) && isset($business) && isset($details) && is_email_valid($email)) {

	// Avoid Email Injection
	$pattern = "/(content-type|bcc:|cc:|to:)/i";
	if (preg_match($pattern, $name) || preg_match($pattern, $email) || preg_match($pattern, $details)) {
		exit;
	}

	// Recipient Email Address
	$to = "salmenkh1999@gmail.com"; // CHANGE THIS to your email address

	// Email Subject
	$subject = "New Workflow Idea Request from " . $name;

	// Email Body
	$body = <<<EOD
    <h3>New Automation Inquiry</h3>
    <p><strong>Name:</strong> $name</p>
    <p><strong>Email:</strong> <a href="mailto:$email">$email</a></p>
    <p><strong>Business:</strong> $business</p>
    <hr>
    <p><strong>Project Details:</strong></p>
    <p>$details</p>
EOD;

	// Email Headers
	$headers = "From: $name <$email>\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Send the email and check the result
	if (mail($to, $subject, $body, $headers)) {
		echo "Email sent successfully!";
	} else {
		echo "Email sending failed.";
	}
}
