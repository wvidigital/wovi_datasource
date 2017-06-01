<?php

/**
 * Created by PhpStorm.
 * User: Moritz Vögler /// ARTUS
 * Date: 15.05.15
 * Time: 12:20
 */

/**
 * Class SimmaException
 *  Is be used in the IVisionController.
 * @package IVisionController
 */
class SimmaException extends \Exception {

}

/**
 * Class IVisionController
 *  Handles all IVision Webservice Calls
 *
 * @method mixed getImage() getImage($args = array())
 *  Get One Image.
 * @method mixed getImagesSince() getImagesSince($args = array())
 *  Get Images Updated Since ( date = yyyymmdd ).
 * @method mixed getChildren() getChildren($args = array())
 *  Retrieve Children.
 * @method mixed getChildrenByCountryCode() getChildrenByCountryCode($args = array())
 *  Retrieve Children by Country Code.
 * @method mixed getChildrenByReservationID() getChildrenByReservationID($args = array())
 *  Retrieve Children by reservationID.
 * @method mixed getChild() getChild($args = array())
 *  Retrieve One Child.
 * @method mixed getChildFromTable() getChildFromTable($args = array())
 *  Retrieve One Child from Children Table.
 * @method mixed setNewComfortIncident() setNewComfortIncident($args = array())
 *  Submitting a Donation - Comfort Solution iVision - Submitting an Incident.
 * @method mixed setMultipleDonation() setMultipleDonation($args = array())
 *  Non-Comfort Solution iVision - Submitting Multiple Donations.
 * @method mixed setNewIncident() setNewIncident($args = array())
 *  Submitting Incident.
 * @method mixed getChildMediaURL() getChildMediaURL($args = array())
 *  Media Services - Child Media URL.
 * @method mixed getProjectMediaURL() getProjectMediaURL($args = array())
 *  Project Media URL.
 * @method mixed getChildMultiMedia() getChildMultiMedia($args = array())
 *  Child Multi Media URL.
 * @method mixed getProjectMediaCaption() getProjectMediaCaption($args = array())
 *  Project Media URL With Caption.
 * @method mixed getProjectMedia() getProjectMedia($args = array())
 *  Project Media List.
 * @method mixed getAllProjectMedia() getAllProjectMedia($args = array())
 *  All Project Media List without contentType.
 * @method mixed setEnquiry() setEnquiry($args = array()) Get One Image.
 *  Submitting an Enquiry.
 * @method mixed getChildLanguages() getChildLanguages($args = array())
 * Child Languages
 * @method mixed getChildGenders() getChildGenders($args = array())
 * Child Genders
 * @method mixed getChildCountries() getChildCountries($args = array())
 * Child Countries
 * @method mixed getProjectSponsorChildrenStatistics() getProjectSponsorChildrenStatistics($args = array())
 * Retrieve Sponsor Children Statistics
 * @method mixed getGiftCategories() getGiftCategories($args = array())
 * Retrieve Gift Categories
 * @method mixed getGift() getGift($args = array())
 * Retrieve Gift
 * @method mixed getGiftsforCategory() getGiftsforCategory($args = array())
 * Retrieve Gifts for a Category
 * @method mixed getGiftsforPriceRange() getGiftsforPriceRange($args = array())
 * Retrieve Gifts for a Price Range
 * @method mixed getRelatedGiftsforCategory() getRelatedGiftsforCategory($args = array())
 * Related Gifts for Category
 * @method mixed getDonationPrograms() getDonationPrograms($args = array())
 * Retrieve Donation Programs
 * @method mixed getPartnerById() getPartnerById($args = array())
 * Retrieve Partner by Partner ID : All sections of the partner information will be loaded
 * @method mixed getPartnerSpecial() getPartnerSpecial($args = array())
 * Retrieve Partner by Partner ID : To load only part of the partner use this
 * @method mixed getPartnerByPortalAccountID() getPartnerByPortalAccountID($args = array())
 * Retrieve Partner by Portal Account ID
 * @method mixed getPaymentHistory() getPaymentHistory($args = array())
 * Retrieve Payment History
 * @method mixed getOngoingGivings() getOngoingGivings($args = array())
 * Retrieve Ongoing Givings
 * @method mixed getPartnerTitles() getPartnerTitles($args = array())
 * Retrieve Partner Titles
 * @method mixed getPartnerCountries() getPartnerCountries($args = array())
 * Retrieve Partner Countries
 * @method mixed getPartnerSalutations() getPartnerSalutations($args = array())
 * Retrieve Partner Salutations
 * @method mixed getPartnerMySponsoredChildren() getPartnerMySponsoredChildren($args = array())
 * Retrieve Partner My Sponsored Children
 * @method mixed getPartnerBaseInfoList() getPartnerBaseInfoList($args = array())
 * Retrieve Partner Base Info List
 * @method mixed getPaymentMethods() getPaymentMethods($args = array())
 * Retrieve Payment Methods
 * @method mixed getPaymentAccounts() getPaymentAccounts($args = array())
 * Retrieve Payment Accounts
 * @method mixed getStepWiseChild() getStepWiseChild($args = array())
 * Retrieve Step Wise Child
 * @method mixed getStepWiseChildSpecial() getStepWiseChildSpecial($args = array())
 * Retrieve Step Wise Child with filter
 * @method mixed getGiftCardsByGiftCatalogueID() getGiftCardsByGiftCatalogueID($args = array())
 * Retrieve Gift Cards By GiftCatalogueID
 * @method mixed getGiftCardsByGiftCardID() getGiftCardsByGiftCardID($args = array())
 * Retrieve Gift Cards By GiftCardID
 * @method mixed getGiftCardsImagesByGiftCardID() getGiftCardsImagesByGiftCardID($args = array())
 * Retrieve Gift Card Images By GiftCardID
 * @method mixed getInteractionInformation() getInteractionInformation($args = array())
 * Retrieving Interaction Information
 * @method mixed getPartnerInformationList() getPartnerInformationList($args = array())
 * Retrieve Partner Info by Email, Phone Number, Name, First Name, Surname, VAT_Registration No or Birth Date
 * @method mixed getPartnerInformationListSpecial() getPartnerInformationListSpecial($args = array())
 * Retrieve Partner Info by Email, Phone Number, Name, First Name, Surname, VAT_Registration No or Birth Date with filter
 * @method mixed getPartnerProfileInformation() getPartnerProfileInformation($args = array())
 * Retrieve Partner Profile Info by PartnerID
 * @method mixed setDonorInfo() setDonorInfo($args = array())
 * Update Donor Info : post method
 *
 * @package IVisionController
 */
 
 
class SimmaController {

  /**
   * @var array
   *  Saves the last HEAD Connection Info from the IVision Webservice.
   */
  private $log = array();

  /**
   * @var
   *  Saves the generated API URI.
   */
  private $api_call_uri;

  /**
   * @var bool
   *  Saves if the requested data should be dummy data.
   */
  private $dummy_data;

  /**
   * @var array
   *  Saves the generated post data for the POST Requests
   */
  private $api_call_post = array();

  /**
   * @var array
   *  Includes all necessary Connection Data to Set up a Connection to the World Vision Webservice.
   */
  private $api_data = array();

  /**
   * @var array
   *  Includes a Array Mask with all parameters to set up the API Calls.
   *  All Requests will be check against this Array.
   *  First Dimension
   *      The name of the Api Call.
   *  Second Dimension
   *      path : array of all static API path parameters.
   *      args : array of all dynamic API parameters. The following values are possible.
   *              TRUE    = have to be set
   *              FALSE   = optional
   *              array   = list of static path parameters. Have to be set on of them.
   *              post    = list of post parameters. The parameter have the same rules like normal args elements.
   *      method: GET or POST Request.
   */
  private $api_calls = array(
    // Get One Image.
    'getImage' => array(
      'path' => array('getImage'),
      'args' => array(
        'childID' => TRUE,
      ),
      'method' => 'GET'
    ),
	// Retrieve One Child.
    'getChildByID' => array(
      'path' => array('getChildByID'),
      'languageCode' => TRUE,
      'args' => array(
        'childID' => FALSE
      ),
      'method' => 'GET'
    ),
	// Retrieve All Child Specific Add/Edit Date.
	'getChildrenListDate' => array(
      'path' => array('getChildrenListDate'),
      'args' => array(
        'dateType' => 2,
		 'dtpStartDate' => 2,
		 'dtpEndDate' => 2,
      ),
      'method' => 'GET'
    ),
	// Retrieve One Child.
    'getPartnerByID' => array(
      'path' => array('getPartnerByID'),
      'args' => array(
        'pID' => TRUE,
      ),
      'method' => 'GET'
    ),
	
	'getADPByID' => array(
      'path' => array('getADPByID'),
      'args' => array(
        'projectID' => TRUE,
      ),
      'method' => 'GET'
    ),
	// Retrieve All Partner Specific Add/Edit Date.
	'getPartnerListDate' => array(
      'path' => array('getPartnerListDate'),
      'args' => array(
        'dateType' => 2,
		 'dtpStartDate' => 2,
		 'dtpEndDate' => 2,
      ),
      'method' => 'GET'
    ),
	// Retrieve All Partner Specific Add/Edit Date.
	'getPledgesDate' => array(
      'path' => array('getPledgesDate'),
      'args' => array(
        'dateType' => 2,
		 'dtpStartDate' => 2,
		 'dtpEndDate' => 2,
      ),
      'method' => 'GET'
    ),
	
	'getPartnerUnfulfilled' => array(
      'path' => array('getPartnerUnfulfilled'),
      'args' => array(
        'dateType' => 2,
		 'dtpStartDate' => 2,
		 'dtpEndDate' => 2,
      ),
      'method' => 'GET'
    ),
	// Retrieve All Partner Specific Add/Edit Date.
	'getPaymentListByDate' => array(
      'path' => array('getPaymentListByDate'),
      'args' => array(
         'dtpStartDate' => 2,
		 'dtpEndDate' => 2,
      ),
      'method' => 'GET'
    ),
	'getPaymentListPartnerID' => array(
      'path' => array('getPaymentListPartnerID'),
      'args' => array(
         'partnerID' => 2
      ),
      'method' => 'GET'
    ),
  );

  /**
   * Initialize all IVision connection Data
   *
   * @param array $api_data
   *  All IVision Webservice Connection Data (URI, language, siteID).
   * @param bool $dummy_data
   *  On default FALSE. If set TRUE all requested data will be dummy data an saved local.
   * @throws SimmaException
   *  Throws exception if parameter is missing
   *  'API URI is missing'
   *  'API language is missing'
   *  'siteID ist missing'
   */
  public function __construct($api_data = array(), $dummy_data = FALSE) {
    if ($dummy_data === TRUE) {
      $api_data['uri'] = '';
      $api_data['language'] = '';
      $api_data['siteID'] = '';
    }
    else {
      if (!isset($api_data['uri'])) {
        throw new SimmaException('API URI is missing');
      }
	 	/*
      if (!isset($api_data['language'])) {
        throw new SimmaException('API language is missing');
      }
      if (!isset($api_data['siteID'])) {
        throw new SimmaException('siteID ist missing');
      }
	  */
    }

    $this->dummy_data = $dummy_data;
    $this->api_data = $api_data;
  }

  /**
   * First Build the API call URI and calls the processArgsList() to process the $args array
   * Calls the apiRequest() Method to get or set the IVision Data.
   *
   * @param $api_call
   *  API function name.
   * @param $args
   *  List of arguments so set up the API Call.
   * @return array
   *  List of requested IVision Data.
   * @throws SimmaException
   *  "unknown API call: XYZ":                    Magic function name could not be found in the $api_calls array.
   *  "missing argument array":                   $args parameter is not be set.
   */
  public function __call($api_call, $args = array()) {
	
	
    $args = $args[0];

    // save the name of the used function to the log array.
    unset($this->log);
    $this->log['api_function'] = $api_call;
    $this->log['api_function_args'] = $args;
    // Checks if the function name is a valid api call and isset args array
    if (isset($this->api_calls[$api_call]) && isset($api_call)) {
      $api_call_mask = $this->api_calls[$api_call];
    }
    else {
      throw new SimmaException('unknown API call: ' . $api_call);
    }
    if (!isset($args) || !is_array($args)) {
      throw new SimmaException('missing argument array');
    }
	// Building dynamical the requestURI for the API Call based on the array mask
    // If siteID isset we switch the path with the siteID. Do not know why this is changing.. :)
	
    if(isset($api_call_mask['siteID']) && $api_call_mask['siteID'] === TRUE){
      $this->api_call_uri = $this->api_data['uri'] . 'api/' . $this->api_data['siteID']  . '/' . $api_call_mask['path'][0];
    }else{
      //$this->api_call_uri = $this->api_data['uri'] . '/' . $api_call_mask['path'][0];
	  $this->api_call_uri = $this->api_data['uri'] . '/' . $api_call_mask['path'][0];
    }
	
	

    // Sets the API language if necessary.
	/*
	
	
    if (isset($api_call_mask['languageCode']) && $api_call_mask['languageCode'] === TRUE) {
      $this->api_call_uri .= '/' . $this->api_data['language'];
    }

    if (isset($api_call_mask['path'][1])) {
      $this->api_call_uri .= '/' . $api_call_mask['path'][1];
    }
	*/
	if(count($args)>0)
		$this->api_call_uri .=  "?".drupal_http_build_query($args);
    //$this->processArgsList($api_call_mask['args'], $args);
	
	
	if ($this->dummy_data) {
      return $this->dummyDataRequest($api_call, $args);
    }
    else {
      return $this->apiRequest($api_call_mask['method']);
    }
  }

  /**
   * First Build the API call URI with all given arguments and check the parameters against the mask array.
   * Function walks recursive trough the mask array.
   *
   * @param array $mask
   *  API call mask for the requested function.
   * @param $args
   *  List of requested IVision Data.
   * @param bool $jsonBody
   *  Default FALSE. If set TRUE the args list will be rendered to request a POST call.
   * @throws SimmaException
   *  "necessary argument missing or empty: XYZ": Check against the $api_calls array mask failed parameter have to be set.
   *  "empty argument: XYZ":                      Optional $args value is empty.
   *  "wrong or empty argument: XYZ":             $args array list is empty or wrong value.
   */
  private function processArgsList($mask = array(), $args = array(), $jsonBody = FALSE) {

    // Check if one parameter cant be find in the $mask array. Prevent Typo Errors.
//    foreach ($args as $key => $value) {
//      if (!array_key_exists($key, $mask)) {
//        throw new SimmaException('argument cant be find in the mask array: ' . $key);
//      }
//    }

    foreach ($mask as $key => $value) {

      if($key == 'languageCode') $args[$key] = $this->api_data['language'];

      // Parameters that have to be set
      if ($value === TRUE) {
        if (isset($args[$key]) && $args[$key] !== '') {
          if (!$jsonBody) {
            $this->api_call_uri .= '/' . $args[$key];
          }
        }
        else {
          throw new SimmaException('necessary argument missing or empty: ' . $key);
        }
      }
      // Parameters which are optional.
      elseif ($value === FALSE && isset($args[$key])) {
        if ($args[$key] !== '') {
          if (!$jsonBody) {
            $this->api_call_uri .= '/' . $args[$key];
          }
        }
        else {
          throw new SimmaException('empty argument: ' . $key);
        }
      }
      // Static path list that have to be set.
      elseif (is_array($value) && !$this->isAssoc($value)) {
        if (in_array($args[$key], $value) && $args[$key] !== '') {
          if (!$jsonBody) {
            $this->api_call_uri .= '/' . $args[$key];
          }
        }
        else {
          throw new SimmaException('wrong or empty argument: ' . $key . ' ' . $args[$key]);
        }
      }
      // Render the json body string for a POST Requests.
      elseif (is_array($value) && $this->isAssoc($value)) {

        if ($jsonBody === FALSE && !isset($args['post']) && $args['post'] !== '') {
          throw new SimmaException('necessary argument missing or empty: ' . $key . ' ' . $args[$key]);
        }
        else {
          // Expand the $args array to validate, that no other parameters have to be set in other dimensions in the array.
          if (!isset($args[$key]) || !is_array($args[$key])) {
            $args[$key] = array();
          }
          // Recursive function call to check all dimensions of the $args array.
          $this->processArgsList($value, $args[$key], TRUE);
          // If Recursive function call finished the checked POST values will be saved.
          if ($key === 'post') {
            $this->api_call_post = $args;
          }
        }
      }
    }
  }

  /**
   * Checks if an array is associative
   *
   * @param $arr
   *  array have to be checked
   * @return bool
   *  return true if array is associative
   */
  private function isAssoc($arr) {
    return array_keys($arr) !== range(0, count($arr) - 1);
  }

  /**
   * Returns dummy data from local json files. POST requests will write custom json files.
   * Custom json files will be used if they exist (for example: apiCallName.custom.json).
   *
   * @param $api_call
   *  API function name.
   * @param $args
   *  List of arguments so set up the API Call.
   * @return array List of requested IVision dummy data.
   * List of requested IVision dummy data.
   * @throws \SimmaException
   *  Checks if the files could be opened or created.
   */
  private function dummyDataRequest($api_call, $args) {

    // builds $path and $filename variables.
    $data = '';
    $path = drupal_get_path('module', 'wovi_ivision') . '/dummydata/';
    $filename = $api_call;
    if (isset($args['type'])) {
      $filename .= '.' . $args['type'];
    }

    $filename_custom = $filename . '.custom.json';
    $filename .= '.json';

    // If custom json files exist, they will be taken as default data.
    if (file_exists($path . $filename_custom)) {
      $filename = $filename_custom;
    }

    // read the json data.
    $file_src = fopen($path . $filename, 'r');
    if ($file_src === FALSE) {
      throw new SimmaException('Error: Could not open file: ' . $filename);
    }


    if ($this->api_calls[$api_call]['method'] == 'GET') {
      // If it is a GET request the data will be returned.
      $data = fread($file_src, filesize($path . $filename));
    }
    elseif ($this->api_calls[$api_call]['method'] == 'POST') {
      // If it is a POST request the old json file and the new data will be merged.
      $data = fread($file_src, filesize($path . $filename));
      $data = json_decode($data, TRUE);
      $data = array_replace_recursive($data, $args['post']);
      fclose($file_src);

      // The merged data will be written in the custom json file.
      $file_src = fopen($path . $filename_custom, 'w');
      if ($file_src === FALSE) {
        throw new SimmaException('Error: Could not open or create file: ' . $filename);
      }
      if (!defined('JSON_PRETTY_PRINT')) {
        define('JSON_PRETTY_PRINT', 0);
      }
      fwrite($file_src, json_encode($data, JSON_PRETTY_PRINT));
      fclose($file_src);

      $data = TRUE;
    }
    $this->log = array('dummyData' => TRUE);

    // Fix to Return the Data always in the same structure.
    if (substr($data, 0, 1) == '[') {
      return json_decode($data, TRUE);
    }
    else {
      $results = json_decode($data, TRUE);
      return array($results);
    }
  }

  /**
   * Send the Request via curl to the World Vision IVision Webservice and returns the Result.
   * Checks if the the call is a POST or GET request and saves the HEAD information to the private $log.
   *
   * @param $method
   *  Request Type of the API call
   * @return array
   *  List of requested IVision Data.
   * @throws SimmaException
   *  "Curl Error: XYZ":                                  Any possible thrown curl error.
   *  "API call (URI) failed. Response Code: 400 - 500":  Returns the HTTP Code if it is not 200 or 201.
   */
  private function apiRequest($method) {
	$uri = (isset($this->api_data["pantheon_activate"]))?"https://".$this->api_call_uri:$this->api_call_uri;    
	
	if(isset($_SERVER['DEVDESKTOP_DRUPAL_SETTINGS_DIR'])){
		dsm($uri);
		return "";	
	}else{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $uri);
		$define_constant = (!empty($this->api_data["pantheon_token_name"]))?constant($this->api_data["pantheon_token_name"]):"";
		/*
		watchdog('WV Mailer', t('Web Service Call !uri'),
            array(
            	'!uri' => $uri
        	)
		, WATCHDOG_DEBUG);
		*/
		if(isset($this->api_data["pantheon_activate"])){
			$resolve = array(sprintf(
				"%s:%d:%s", 
				$this->api_data["pantheon_site_domain"],
				$define_constant,
				'127.0.0.1'
			));
			curl_setopt($ch, CURLOPT_RESOLVE, $resolve);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_PORT, $define_constant);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		}else{
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_SSLVERSION, 3);
			curl_setopt($ch, CURLOPT_TIMEOUT, 500); // @todo have to be changed
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		}
		if ($method == 'POST') {
		  curl_setopt($ch, CURLOPT_POST, TRUE);
		  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->api_call_post, JSON_NUMERIC_CHECK));
		  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		}
		$curl_result = curl_exec($ch);
		$curl_header = curl_getinfo($ch);
		//dsm($curl_header,"972");
		//dsm($curl_result,"973");
	
		if (curl_errno($ch)) {
		  throw new SimmaException('Curl Error: ' . curl_error($ch));
		}
	
		curl_close($ch);
	
		// Saves the HEAD Request info to the $log
		$this->log = array_merge($this->log, $curl_header);
	
		if ($curl_header['http_code'] != 200 && $curl_header['http_code'] != 201) {
	
		  throw new SimmaException('API call (' . $uri . ') failed. Response Code: ' . $curl_header['http_code'] . ' - ' . $curl_result);
		}
	
	
		// Fix to Return the Data always in the same structure.
		//    if (substr($curl_result, 0, 1) == '[') {
		//      return json_decode($curl_result, TRUE);
		//    }
		//    else {
		//      $results = json_decode($curl_result, TRUE);
		//      return array($results);
		//    }
		if(isset($this->api_data["pantheon_activate"])){
			$data_array = json_decode($curl_result, TRUE);
			return (isset($data_array["totalCount"]) and $data_array["totalCount"]>0)?$data_array["result"]:"";
		}else{
			return json_decode($curl_result, TRUE);	
		}
	}
	/**/
  }

  /**
   * Returns the HEAD Request info from the last API call.
   *
   * @return array
   *  List of all HEAD information from the last API call.
   */
  public function lastRequestLog() {
    return $this->log;
  }

  /**
   * Returns the API calls mask. It could be requested the whole array or just one function name.
   *
   * @param null $api_call
   *  Specific function name.
   * @return array
   *  Returns a single mask of the API calls or the mask of all API calls
   * @throws SimmaException
   *  'unknown function' : If no function with this name exists, this Exception is thrown.
   */
  public function getApiCallMask($api_call = NULL) {
    if ($api_call === NULL) {
      return $this->api_calls;
    }
    elseif (isset($this->api_calls[$api_call])) {
      return $this->api_calls[$api_call]['args'];
    }
    else {
      throw new SimmaException('unknown function');
    }
  }

}
