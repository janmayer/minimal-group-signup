<?php
/* CSV filenames for the group list and list of registered users */
$file_groups = "groups.csv";
$file_students = "users.csv";

/* Customize texts */
$content = array(
	"author" => "Jan Mayer",
	"title" => "Minimal Group Signup",
	"subtitle" => "A PHP, CSV &amp; jQuery based registration for groups with size limit.",
	"formtitle" => "Registration for awesome event now open!",
	"grouptitle" => "Choose your group",
	"signup" => "Sign up now!"
);

/* Customize backend success/error messages */
$message = array(
	"group_invalid" => "Invalid group",
	"group_full" => "Group already full, please refresh the page.",
	"field_invalid" => "Invalid field: ",
	"success" => "%s %s successfully signed up for Group %d", // firstname, lastname, group - customize in signup.php
	"mail_subject" => "Minimal Group Signup",
	"mail_message" => "Hello %s %s,\r\nYou sucessfully signed up for Group %s: %s", // firstname, lastname, group name, group description - customize in signup.php
	"mail_from" => "Your Name <yourname@example.com>"
);
/* Send a confirmation mail to the user */
$send_mail = true;


/*
	Define form fields here. Required attributes:
		name: The id/name of the input field
		type: supported field types: text, email, checkbox
		label: Label for the form field
		icon: choose a matching icon from the list at http://getbootstrap.com/2.3.2/base-css.html#icons
		placeholder: placeholder for text fields / description for checkboxes
		min: Backend validation: minimal number of chars (0 if optional field)
		max: Backend validation: maximal number of chars
	Please note that frontend validation is handled differently, see below.
 */
$fields = array(
	array("name" => "firstname", "type" => "text", "label" => "First name", "icon" => "user", "placeholder" => "John", "min" => 2, "max" => 40),
	array("name" => "lastname", "type" => "text", "label" => "Last name", "icon" => "user", "placeholder" => "Doe", "min" => 2, "max" => 40),
	array("name" => "registrationnumber", "type" => "text", "label" => "Registration Number", "icon" => "barcode", "placeholder" => "1234567", "min" => 7, "max" => 7),
	array("name" => "fieldofstudy", "type" => "text", "label" => "Field of Study", "icon" => "book", "placeholder" => "", "min" => 2, "max" => 40),
	array("name" => "semester", "type" => "text", "label" => "Semester", "icon" => "tasks", "placeholder" => "1", "min" => 1, "max" => 2),
	array("name" => "email", "type" => "email", "label" => "Email", "icon" => "envelope", "placeholder" => "john.doe@example.com", "min" => 5, "max" => 40),
	array("name" => "lecheck", "type" => "checkbox", "label" => "Check this box!", "icon" => "envelope", "placeholder" => "Yes, I checked the checkbox", "min" => 0, "max" => 40),
);

/* Suggest field text for users */
$suggestions = array(
	array("name" => "fieldofstudy", "suggest" => array("Biology (Bachelor)", "Chemistry (Bachelor)", "Geophysics and Meteorology (Bachelor)", "Earth sciences (Bachelor)", "Mathematics (Bachelor)", "Physics (Bachelor)") )
);

/*
	Frontend validation with jQuery validate, see http://jqueryvalidation.org/ for documentation
	Validation plugin supports localisation, uncomment and choose in registration_form.php
*/
$validation = '{
	firstname:"required",
	lastname:"required",
	registrationnumber:{
		required:true,
		number: true,
		min: 1000000,
		max: 9999999,
	},
	fieldofstudy:"required",
	semester:{
		required:true,
		number: true,
		min: 1,
		max: 99,
	},
	email:{
		required:true,
		email: true,
	}
}';

?>