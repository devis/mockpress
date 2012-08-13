<?php

/** Method used by mockpress to set a true or false value for is_user_logged_in()
  * to return when called.
  */
function _set_is_user_logged_in($value) {
  global $wp_test_expectations;
  
  $wp_test_expectations['pluggable']['is_user_logged_in'] = $value;
}

function is_user_logged_in() {
  global $wp_test_expectations;
  
  return $wp_test_expectations['pluggable']['is_user_logged_in'];
}

/** Method used by mockpress to set a true or false value for wp_mail()
  * to return when called. Note: if you see the codex, this method returns 
  * only true or false:
  * 
  * http://codex.wordpress.org/Function_Reference/wp_mail
  */
function _set_wp_mail($value) {
  global $wp_test_expectations;
  
  $wp_test_expectations['pluggable']['wp_mail'] = $value;
}

/** Used to reset the sent messages queue for wp_mail */
function _reset_wp_mail_messages() {
  global $wp_test_expectations;
  
  $wp_test_expectations['pluggable']['wp_mail_messages'] = array();
}

/** Get the queue of messages sent by wp_mail */
function _get_wp_mail_messages($convert_to_array=false) {
  global $wp_test_expectations;
  
  if( $convert_to_array ) {
    $messages = array();
    foreach( $wp_test_expectations['pluggable']['wp_mail_messages'] as $message ) {
      $messages[] = (array)$message;
    }
  }
  else
    $messages = $wp_test_expectations['pluggable']['wp_mail_messages'];

  return $messages;
}

function wp_mail( $to, $subject, $message, $headers, $attachments=false ) {
  global $wp_test_expectations;
  
  $wp_test_expectations['pluggable']['wp_mail_messages'][] = (object)compact( 'to', 'subject', 'message', 'headers', 'attachments' );
  
  return $wp_test_expectations['pluggable']['wp_mail'];
}
