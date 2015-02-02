<?php
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html 
*/

/**
* Hybrid_Providers_Usosweb provider adapter based on OAuth1 protocol
* Adapter to Usosweb API by Henryk Michalewski
*/

class Hybrid_Providers_Usosweb extends Hybrid_Provider_Model_OAuth1
{
	/**
	* IDp wrappers initializer 
	*/
	/* Required scopes. The only functionality of this application is to say hello,
    * so it does not really require any. But, if you want, you may access user's
    * email, just do the following:
    * - put array('email') here,
    * - append 'email' to the 'fields' argument of 'services/users/user' method,
    *   you will find it below in this script.
    */
	
    
      
	function initialize()
	{
		parent::initialize();
		
		$scopes = array('studies', 'grades');
      
		// Provider api end-points 
		$this->api->api_base_url      = "https://usosapps.uw.edu.pl/";
		$this->api->request_token_url = "https://usosapps.uw.edu.pl/services/oauth/request_token?scopes=".implode("|", $scopes);
		$this->api->access_token_url  = "https://usosapps.uw.edu.pl/services/oauth/access_token";
		$this->api->authorize_url = "https://usosapps.uw.edu.pl/services/oauth/authorize";

	}
	
	
    /**
	* begin login step 
	*/
	function loginBegin()
	{
		$tokens = $this->api->requestToken( $this->endpoint ); 

		// request tokens as received from provider
		$this->request_tokens_raw = $tokens;
		
		// check the last HTTP status code returned
		if ( $this->api->http_code != 200 ){
			throw new Exception( "Authentication failed! {$this->providerId} returned an error. " . $this->errorMessageByStatus( $this->api->http_code ), 5 );
		}

		if ( ! isset( $tokens["oauth_token"] ) ){
			throw new Exception( "Authentication failed! {$this->providerId} returned an invalid oauth_token.", 5 );
		}

		$this->token( "request_token"       , $tokens["oauth_token"] ); 
		$this->token( "request_token_secret", $tokens["oauth_token_secret"] ); 

		# redirect the user to the provider authentication url
		Hybrid_Auth::redirect( $this->api->authorizeUrl( $tokens ) );
	}
		

	/**
	* load the user profile from the IDp api client
	*/
	function getUserProfile()
	{
		$response = $this->api->get( 'https://usosapps.uw.edu.pl/services/users/user?fields=id|first_name|last_name|sex|homepage_url|profile_url' );

		// check the last HTTP status code returned
		if ( $this->api->http_code != 200 ){
			throw new Exception( "User profile request failed! {$this->providerId} returned an error. " . $this->errorMessageByStatus( $this->api->http_code ), 6 );
		}

		if ( ! is_object( $response ) || ! isset( $response->id ) ){
			throw new Exception( "User profile request failed! {$this->providerId} api returned an invalid response.", 6 );
		}
		
		$current_user_id = $response->id;
		
		/* SCHEDULE */
		$response = $this->api->get( 'https://usosapps.uw.edu.pl/services/tt/student?fields=start_time|end_time|course_id|course_name|classtype_name' );
		global $wpdb;
		$wpdb->query( 'delete from schedule where user_id='.$current_user_id.';' );
		foreach ($response as $value) {
			$wpdb->insert( 
				'schedule', 
				array( 'user_id' => $current_user_id, 'class_id' => $value->course_id, 'name' => $value->course_name->en,
					'start' => $value->start_time, 'end' => $value->end_time, 'type' => $value->classtype_name->en),
				array( '%s', '%s', '%s', '%s', '%s', '%s' )
			);
		}
		
		/* CURRENT_EDUCATION */
		$response = $this->api->get( 'https://usosapps.uw.edu.pl/services/courses/user' );
		$wpdb->query( 'delete from current_education where user_id='.$current_user_id.';' );
		foreach ($response as $value) {
			foreach($value as $iter) {
				foreach($iter as $var) {
					$wpdb->insert( 
						'current_education', 
						array( 'user_id' => $current_user_id, 'name' => $var->course_name->en,
							'course_id' => $var->course_id),
						array( '%s', '%s', '%s')
					);
				}
			}
		}
		
		/* SUBJECTS */
		$response = $this->api->get( 'https://usosapps.uw.edu.pl/services/courses/user?active_terms_only=false&fields=course_editions[course_name|grades]' );
		$wpdb->query( 'delete from subjects where user_id='.$current_user_id.';' );
		foreach ($response->course_editions as $value) {
			foreach($value as $var) {
				foreach($var->grades->course_grades as $grade) {
					$wpdb->insert( 
						'subjects', 
						array( 'user_id' => $current_user_id, 'name' => $var->course_name->en,
							'grade' => $grade->value_description->en),
						array( '%s', '%s', '%s')
					);
				}
			}
		}
		
		
		# store the user profile. 
		# written without a deeper study what is really going on in Usosweb API
		 
		# przeniesione z gory funkcji
		$response = $this->api->get( 'https://usosapps.uw.edu.pl/services/users/user?fields=id|first_name|last_name|sex|homepage_url|profile_url' );
		
		$this->user->profile->identifier  = (property_exists($response,'id'))?$response->id:"";
		$this->user->profile->displayName = (property_exists($response,'first_name') && property_exists($response,'last_name'))?$response->first_name." ".$response->last_name:"";
		$this->user->profile->lastName   = (property_exists($response,'last_name'))?$response->last_name:""; 
		$this->user->profile->firstName   = (property_exists($response,'first_name'))?$response->first_name:""; 
        $this->user->profile->gender = (property_exists($response,'sex'))?$response->sex:""; 
		$this->user->profile->profileURL  = (property_exists($response,'profile_url'))?$response->profile_url:"";
		$this->user->profile->webSiteURL  = (property_exists($response,'homepage_url'))?$response->homepage_url:""; 

		return $this->user->profile;
 	}

}
