<?php

class WP_Http {}

/**
 * Returns the initialized WP_Http Object
 *
 * @since 2.7.0
 * @access private
 *
 * @return WP_Http HTTP Transport object.
 */
function &_wp_http_get_object() {
  return new WP_Http();
}

/**
 * Retrieve the raw response from the HTTP request.
 *
 * The array structure is a little complex.
 *
 * <code>
 * $res = array( 'headers' => array(), 'response' => array('code' => int, 'message' => string) );
 * </code>
 *
 * All of the headers in $res['headers'] are with the name as the key and the
 * value as the value. So to get the User-Agent, you would do the following.
 *
 * <code>
 * $user_agent = $res['headers']['user-agent'];
 * </code>
 *
 * The body is the raw response content and can be retrieved from $res['body'].
 *
 * This function is called first to make the request and there are other API
 * functions to abstract out the above convoluted setup.
 *
 * @since 2.7.0
 *
 * @param string $url Site URL to retrieve.
 * @param array $args Optional. Override the defaults.
 * @return WP_Error|array The response or WP_Error on failure.
 */
function wp_remote_request($url, $args = array()) {
  global $wp_test_expectations;

  if( empty( $wp_test_expectations['http_response'] ) )
    return new WP_Error();
  else
    return $wp_test_expectations['http_response'];
}

/**
 * Retrieve the raw response from the HTTP request using the GET method.
 *
 * @see wp_remote_request() For more information on the response array format.
 *
 * @since 2.7.0
 *
 * @param string $url Site URL to retrieve.
 * @param array $args Optional. Override the defaults.
 * @return WP_Error|array The response or WP_Error on failure.
 */
function wp_remote_get($url, $args = array()) {
  return wp_remote_request($url, $args);
}

/**
 * Retrieve the raw response from the HTTP request using the POST method.
 *
 * @see wp_remote_request() For more information on the response array format.
 *
 * @since 2.7.0
 *
 * @param string $url Site URL to retrieve.
 * @param array $args Optional. Override the defaults.
 * @return WP_Error|array The response or WP_Error on failure.
 */
function wp_remote_post($url, $args = array()) {
  return wp_remote_request($url, $args);
}

/**
 * Retrieve the raw response from the HTTP request using the HEAD method.
 *
 * @see wp_remote_request() For more information on the response array format.
 *
 * @since 2.7.0
 *
 * @param string $url Site URL to retrieve.
 * @param array $args Optional. Override the defaults.
 * @return WP_Error|array The response or WP_Error on failure.
 */
function wp_remote_head($url, $args = array()) {
  return wp_remote_request($url, $args);
}

/**
 * Retrieve only the headers from the raw response.
 *
 * @since 2.7.0
 *
 * @param array $response HTTP response.
 * @return array The headers of the response. Empty array if incorrect parameter given.
 */
function wp_remote_retrieve_headers(&$response) {
  global $wp_test_expectations;

  if( empty( $wp_test_expectations['http_response'] ) )
    return new WP_Error();
  else
    return $wp_test_expectations['http_response'];
}

/**
 * Retrieve a single header by name from the raw response.
 *
 * @since 2.7.0
 *
 * @param array $response
 * @param string $header Header name to retrieve value from.
 * @return string The header value. Empty string on if incorrect parameter given, or if the header doesn't exist.
 */
function wp_remote_retrieve_header(&$response, $header) {
  global $wp_test_expectations;

  if( empty( $wp_test_expectations['http_header'] ) )
    return new WP_Error();
  else
    return $wp_test_expectations['http_header'];
}

/**
 * Retrieve only the response code from the raw response.
 *
 * Will return an empty array if incorrect parameter value is given.
 *
 * @since 2.7.0
 *
 * @param array $response HTTP response.
 * @return string the response code. Empty string on incorrect parameter given.
 */
function wp_remote_retrieve_response_code(&$response) {
  global $wp_test_expectations;

  if( empty( $wp_test_expectations['response_code'] ) )
    return new WP_Error();
  else
    return $wp_test_expectations['response_code'];
}

/**
 * Retrieve only the response message from the raw response.
 *
 * Will return an empty array if incorrect parameter value is given.
 *
 * @since 2.7.0
 *
 * @param array $response HTTP response.
 * @return string The response message. Empty string on incorrect parameter given.
 */
function wp_remote_retrieve_response_message(&$response) {
  global $wp_test_expectations;

  if( empty( $wp_test_expectations['response_message'] ) )
    return new WP_Error();
  else
    return $wp_test_expectations['response_message'];
}

/**
 * Retrieve only the body from the raw response.
 *
 * @since 2.7.0
 *
 * @param array $response HTTP response.
 * @return string The body of the response. Empty string if no body or incorrect parameter given.
 */
function wp_remote_retrieve_body(&$response) {
  global $wp_test_expectations;

  if( empty( $wp_test_expectations['response_body'] ) )
    return new WP_Error();
  else
    return $wp_test_expectations['response_body'];
}

/**
 * Determines if there is an HTTP Transport that can process this request.
 *
 * @since 3.2.0
 *
 * @param array  $capabilities Array of capabilities to test or a wp_remote_request() $args array.
 * @param string $url Optional.  If given, will check if the URL requires SSL and adds that requirement to the capabilities array.
 *
 * @return bool
 */
function wp_http_supports( $capabilities = array(), $url = null ) {
  global $wp_test_expectations;
  
  return isset($wp_test_expectations['http_supports']) and $wp_test_expectations['http_supports'];
}