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
