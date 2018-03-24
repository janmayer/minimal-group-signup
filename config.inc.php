<?php

// CSV filenames for the group list and list of registered users
$file_groups   = "groups.csv";
$file_students = "users.csv";

// Customize texts
$content = array(
	"author"     => "Jan Mayer",
	"title"      => "Minimal Group Signup",
	"subtitle"   => "A PHP, CSV &amp; jQuery based registration for groups with size limit.",
	"formtitle"  => "Registration for awesome event now open!",
	"grouptitle" => "Choose your group",
	"signup"     => "Sign up now!"
);

// Customize backend success/error messages
$message = array(
	"group_invalid" => "Invalid group",
	"group_full"    => "Group already full, please refresh the page.",
	"field_invalid" => "Invalid field: ",
	"success"       => "%s %s successfully signed up for Group %d", // firstname, lastname, group - customize in signup.php
	"mail_subject"  => "Minimal Group Signup",
	"mail_message"  => "Hello %s %s,\r\nYou successfully signed up for Group %s: %s", // firstname, lastname, group name, group description - customize in signup.php
	"mail_from"     => "Your Name <yourname@example.com>"
);

// Send a confirmation mail to the user
$send_mail = true;

// Define form fields here. Required attributes:
//   name: The id/name of the input field
//   type: supported field types: text, email, checkbox
//   label: Label for the form field
//   icon: choose a matching icon from the list at https://fontawesome.com/icons
//   placeholder: placeholder for text fields / description for checkboxes
//   min: minimal number of chars (0 if optional field), or minimal value for number fields
//   max: maximal number of chars, or maximal value for number fields
//   required: "" or "required"
$fields = array(
	array(
		"name" => "firstname",
		"type" => "text",
		"label" => "First name",
		"icon" => "fa-user",
		"placeholder" => "John",
		"min" => 2,
		"max" => 40,
		"required" => "required"
	),
	array(
		"name" => "lastname",
		"type" => "text",
		"label" => "Last name",
		"icon" => "fa-user",
		"placeholder" => "Doe",
		"min" => 2,
		"max" => 40,
		"required" => "required"
	),
	array(
		"name" => "registrationnumber",
		"type" => "number",
		"label" => "Registration Number",
		"icon" => "fa-barcode",
		"placeholder" => "1234567",
		"min" => 1000000,
		"max" => 9999999,
		"required" => "required"
	),
	array(
		"name" => "fieldofstudy",
		"type" => "text",
		"label" => "Field of Study",
		"icon" => "fa-book",
		"placeholder" => "",
		"min" => 0,
		"max" => 40,
		"required" => ""
	),
	array(
		"name" => "semester",
		"type" => "number",
		"label" => "Semester",
		"icon" => "fa-tasks",
		"placeholder" => "1",
		"min" => 1,
		"max" => 20,
		"required" => "required"
	),
	array(
		"name" => "email",
		"type" => "email",
		"label" => "Email",
		"icon" => "fa-envelope",
		"placeholder" => "john.doe@example.com",
		"min" => 5,
		"max" => 40,
		"required" => "required"
	),
	array(
		"name" => "lecheck",
		"type" => "checkbox",
		"label" => "Check this box!",
		"icon" => "",
		"placeholder" => "Yes, I checked the checkbox",
		"min" => 1,
		"max" => 40,
		"required" => "required"
	),
);
