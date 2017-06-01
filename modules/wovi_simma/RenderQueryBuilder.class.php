<?php
/**
 * Created by PhpStorm.
 * User: moe
 * Date: 12.06.15
 * Time: 11:38
 */

/**
 * Class RenderQueryBuilderException
 *  Is be used in the IVisionController.
 * @package IVisionController
 */
class RenderQueryBuilderException extends \Exception {

}


/**
 * Class RenderQueryBuilder
 *  Render the Query Builder array and map the correct iVision API Calls.
 */
class RenderQueryBuilder {

  // args 0 = single field
  // args 1 = array
  // args 2 = array and single field
  /**
   * @var array
   */
  private $condition_mapping = array(
    'si_children' => array(
      array(
        'function_name' => 'getChildByID',
        'args' => array(
          'childID' => 2,
        ),
        'custom' => FALSE,
      ),
    ),
	'si_children_images' => array(
      array(
        'function_name' => 'getImage',
        'args' => array(
          'childID' => 2,
        ),
        'custom' => FALSE,
      ),
    ),
	
	'si_children_by_date' => array(
      array(
        'function_name' => 'getChildrenListDate',
        'args' => array(
          'dateType' => 2,
		  'dtpStartDate' => 2,
		  'dtpEndDate' => 2,
        ),
        'custom' => FALSE,
      ),
    ),
	'si_children_project' => array(
      array(
        'function_name' => 'getADPByID',
        'args' => array(
          'projectID' => 2,
        ),
        'custom' => FALSE,
      ),
    ),
	
	
    'si_partner' => array(
      array(
        'function_name' => 'getPartnerByID',
        'args' => array(
          'pID' => 2,
        ),
        'custom' => FALSE,
      ),
    ),
	'si_partner_by_date' => array(
      array(
        'function_name' => 'getPartnerListDate',
        'args' => array(
          'dateType' => 2,
		  'dtpStartDate' => 2,
		  'dtpEndDate' => 2,
        ),
        'custom' => FALSE,
      ),
    ),
	
	'si_payment_list_by_date' => array(
      array(
        'function_name' => 'getPaymentListByDate',
        'args' => array(
         	'dtpStartDate' => 2,
		  	'dtpEndDate' => 2,
        ),
        'custom' => FALSE,
      ),
    ),
	'si_payment_list_by_partnerid' => array(
      array(
        'function_name' => 'getPaymentListPartnerID',
        'args' => array(
         	'partnerID' => 2
		  	
        ),
        'custom' => FALSE,
      ),
    ),
	
	'si_pledges_by_date' => array(
      array(
        'function_name' => 'getPledgesDate',
        'args' => array(
          'dateType' => 2,
		  'dtpStartDate' => 2,
		  'dtpEndDate' => 2,

        ),
        'custom' => FALSE,
      ),
    ),
	
	'si_pledges_by_unfulfilled_date' => array(
      array(
        'function_name' => 'getPartnerUnfulfilled',
        'args' => array(
          'dateType' => 2,
		  'dtpStartDate' => 2,
		  'dtpEndDate' => 2,

        ),
        'custom' => FALSE,
      ),
    )
  );



  /**
   * @var array
   */
  private $join_mapping = array(
    'si_children' => array(
      'image_regular' => array(
        'function_name' => 'getImage',
        'args' => array(
          'childID' => 2
        ),
      ),
    ),
  );

  /**
   * @var \IVisionController
   *  Instance of the IVisionController Class.
   */
  private $SimmaController;
  /**
   * @var bool
   *  Defines which getChild call should be used.
   */
  private $children_table;

  /**
   * @param \IVisionController $SimmaController
   *  Instance of the IVisionController Class.
   */
  public function __construct(SimmaController $SimmaController) {
    $this->SimmaController = $SimmaController;
  }

  /**
   * @param bool $children_table
   *  Defines which getChild call should be used.
   */
  public function setChildrenTable($children_table) {
    $this->children_table = $children_table;
  }

  /**
   * Render the QueryBuilder Array and return the iVision Data.
   * Depending on the select type the matching analyse function will be called.
   *
   * @param Array $query
   *  Array with all QueryBuilder data.
   * @return array
   *  Returns the iVision Data.
   */
  public function getQueryResult($query) {
    $result = array();
    $ds_entity_info = wovi_datasource_entity_get_info();
    //dpm($query, 'query_array');

    // if query fields are empty or query fields is not a normal iVision field.
    if (empty($query['fields']) || array_intersect(array_keys($ds_entity_info[$query['type']]['fields']), $query['fields'])) {

      $result = $this->analyseQueryConditions($query);
//      if (count($temp) > 0) {
////        $result[$temp[0]['projectCode']] = array(
////          'project_id' => $temp[0]['projectCode'],
////          'media' => $temp,
////        );
//      }
//      else {
//        $result = $temp;
//      }

    }
    if (!empty($query['join']) && array_intersect(array_keys($this->join_mapping[$query['type']]), array_keys(($query['join'])))) {
      $this->analyseQueryJoin($query, $result);

    }

   // dpm($result, 'result');
    return $result;
  }


  /**
   * @param $query
   * @return array
   */
  private function checkFlags(&$query) {

    // flag array with all necessary conditions
    $flags = array(
	  'projectID' => -1,
      'iVisionID' => -1,
	  'childID' => -1,
	  'pID' => -1,
	  'partnerID' => -1,
	  'dateType' => -1,
	  'dtpStartDate' => -1,
	  'dtpEndDate' => -1,
      'maxReturn' => -1,
      'startingID' => -1,
      'countryCode' => -1,
      'lowerAge' => -1,
      'upperAge' => -1,
      'projectCode' => -1,
      'contentType' => -1,
      'mediaCode' => -1,
      'derivative' => -1,
      'onlyMediaUrl' => -1,
      'giftCategory' => -1,
      'lowerPrice' => -1,
      'upperPrice' => -1,
      'partnerID' => -1,
      'loadHasPendingOrder' => -1,
      'loadHasPendingContactInfo' => -1,
      'loadHasPendingPaymentUpdate' => -1,
      'loadHasPendingLumpSumPayment' => -1,
      'loadPartnerStatus' => -1,
      'loadAddressAddition' => -1,
      'portalAccountID' => -1,
      'date' => -1,
      'isNew' => -1,
      'typeID' => -1,
      'GiftCardID' => -1,
      'GiftCatalogueID' => -1,
      'type' => -1,
      'width' => -1,
      'height' => -1,
      'childID' => -1,
      'status' => -1,
      'projectID' => -1,
      'cutoff' => -1,
      'reservationID' => -1,
      'age' => -1,
    );

    if (count($query['range']) > 0) {
      if (
        $query['range']['from'] == 0 &&
        isset($query['range']['to'])
      ) {
        $query['conditions'][] = array(
          'field' => 'maxReturn',
          'value' => $query['range']['to'],
          'operator' => '=',
        );
        $query['conditions'][] = array(
          'field' => 'startingID',
          'value' => 0,
          'operator' => '=',
        );
      }
    }


    foreach ($query['conditions'] as $key => $condition) {
      $condition_name = $condition['field'];
      $condition_operator = $condition['operator'];
      $condition_value = $condition['value'];

      if (array_key_exists($condition_name, $flags)) {
        $flags[$condition_name] = $key;

        if($condition_name == 'age'){
          if($condition_operator == '>'){
            $query['conditions'][] = array(
              'field' => 'lowerAge',
              'value' => $condition_value+1,
              'operator' => '=',
            );
            $query['conditions'][] = array(
              'field' => 'upperAge',
              'value' => 0,
              'operator' => '=',
            );
            $flags['lowerAge'] = count($query['conditions'])-2;
            $flags['upperAge'] = count($query['conditions'])-1;
          }elseif ($condition_operator == '<'){
            $query['conditions'][] = array(
              'field' => 'lowerAge',
              'value' => 0,
              'operator' => '=',
            );
            $query['conditions'][] = array(
              'field' => 'upperAge',
              'value' => $condition_value-1,
              'operator' => '=',
            );
            $flags['lowerAge'] = count($query['conditions'])-2;
            $flags['upperAge'] = count($query['conditions'])-1;
          }elseif ($condition_operator == '='){
            $query['conditions'][] = array(
              'field' => 'lowerAge',
              'value' => $condition_value,
              'operator' => '=',
            );
            $query['conditions'][] = array(
              'field' => 'upperAge',
              'value' => $condition_value,
              'operator' => '=',
            );
            $flags['lowerAge'] = count($query['conditions'])-2;
            $flags['upperAge'] = count($query['conditions'])-1;
          }
        }
      }
    }

    return $flags;
  }


  /**
   * @param $function_name
   * @param $args
   * @return array
   */
  private function APICall($function_name, $args, $query, $primary_key) {
    $return = array(
      'results' => array(),
      'log' => array(),
      'error' => FALSE,
    );

    //dpm($function_name,'function_name');
    //dpm($args,'args');
    try {
      $result_temp = $this->SimmaController->$function_name($args);
    	//dpm($result_temp,'raw_data');  
		
	//  $datasource_entity_info = wovi_datasource_entity_get_info();
	//	$primary_key = $datasource_entity_info[$query['type']]['primary_key'];
	
      if(!empty($result_temp)){
        if (isset($result_temp[0]) && is_array($result_temp[0])) {
          foreach ($result_temp as $result_temp_key => $result_temp_value) {
            $return['results'][$result_temp_value[$primary_key]] = $result_temp_value;
          }
        }
        else {
          if(!is_array($result_temp)){
            // for single Child Media URL
            $result_temp = array('URI' => $result_temp);
          }

          if (!isset($result_temp[$primary_key])) {
            foreach ($query['conditions'] as $condition_key => $condition_value) {
              if ($condition_value['field'] == $primary_key) {
                $result_temp = array_merge(array($primary_key => $condition_value['value']), $result_temp);
              }
            }

            if (!isset($result_temp[$primary_key])) {
//              dpm('in2');
              foreach ($args as $args_key => $args_value) {
                if ($args_key == $primary_key) {
                  $result_temp = array_merge(array($primary_key => $args_value), $result_temp);
                }
              }
            }
            // if there i no primary key in the conditions and no primary key is set the primary key by the first value.
            if (!isset($result_temp[$primary_key])) {
              foreach ($result_temp as $result_temp_key => $result_temp_value) {
                if(!is_array($result_temp_value)){
                  $return['results'][$result_temp_value] = array(
                    $primary_key => $result_temp_value,
                  );
                }else{
//                  $return['results'][$result_temp_value[0]] = array(
//                    $primary_key => $result_temp_value,
//                  );
                    // ????
                }

              }
            }
          }
          if(isset($result_temp[$primary_key])){
            $return['results'][$result_temp[$primary_key]] = $result_temp;
          }
        }
      }else{
        $return['results'] = array();
      }


    } catch (SimmaException $e) {
      dpm($e->getMessage(), 'Simma Exception');
      // return array('error' => $e->getMessage());
      $return['error'] = $e->getMessage();
    }
    $return['log'] = $this->SimmaController->lastRequestLog();



    // merge the extra field keys. This field keys are only necessary for the api call.
    $flags = $this->checkFlags($query);
    $additional_fields = array();
    foreach($flags as $flag_key => $flag_value){
      if($flag_value >= 0){
        $additional_fields[$flag_key] = $query['conditions'][$flag_value]['value'];
      }
    }
    foreach($return['results'] as $result_key => $result_value){
      $return['results'][$result_key] = array_merge($additional_fields, $result_value);
    }


   // dpm($return, 'return');
    return $return;
  }


  /**
   * Analyse all QueryBuilder calls with the selection type children and returns the matching iVision Data.
   *
   * @param $query
   *  Array with all QueryBuilder data.
   * @return array
   *  Returns the iVision Data.
   */
  private function analyseQueryConditions($query) {


    $return = array();
    $entity_type = $query['type'];
    $flags = $this->checkFlags($query);
    $condition = $query['conditions'];
   // dpm($flags,'flags');

    // runs threw all api cases in the chosen entity.
    foreach ($this->condition_mapping[$entity_type] as $condition_case_key => $condition_case) {
      $condition_found = -1;
      // check if args mask array is empty and no flag ist set. default case for not conditions set.
      if (empty($condition_case['args'])) {
        $flag_check = TRUE;
        foreach ($flags as $flag_value) {
          if ($flag_value >= 0) {
            $flag_check = FALSE;
          }
        }
        if ($flag_check) {
          $condition_found = $condition_case_key;
        }
      }

      // runs threw all args in the api case and checks if the given conditions match to the args list.
      foreach ($condition_case['args'] as $condition_argument_key => $condition_argument_value) {
        if (
          // flag have to be set
          $flags[$condition_argument_key] >= 0 && (
            (
              // if condition args mapping is 0 value have to be single entry.
              $condition_argument_value === 0 &&
              !is_array($condition[$flags[$condition_argument_key]]['value'])
            ) ||
            (
              // if condition args mapping is 1 value have to be an array.
              $condition_argument_value === 1 &&
              is_array($condition[$flags[$condition_argument_key]]['value'])
            ) ||
            (
              // if condition args mapping is 2 value could be an array or single value.
              $condition_argument_value === 2
            )
          )
        ) {
          // saves the array key of the founded api call.
          $condition_found = $condition_case_key;
        }
        else {
          $condition_found = -1;
          break;
        }
      }

      // calls the the founded api call with error handling.
      if ($condition_found >= 0) {
        $condition_mapped = $this->condition_mapping[$entity_type][$condition_found];

        if ($this->children_table && $condition_mapped['function_name'] == 'getChild') {
          $condition_mapped['function_name'] = 'getChildFromTable';
        }
        $args = array();

        foreach ($condition_mapped['args'] as $condition_mapped_key => $condition_mapped_value) {
          $args[$condition_mapped_key] = $condition[$flags[$condition_mapped_key]]['value'];
        }

        if (isset($condition_mapped['default'])) {
          foreach ($condition_mapped['default'] as $default_key => $default_value) {
            if (!isset($args[$default_key])) {
              $args[$default_key] = $default_value;
            }
          }
        }
        $datasource_entity_info = wovi_datasource_entity_get_info();
        $primary_key = $datasource_entity_info[$query['type']]['primary_key'];
        return $this->APICall($condition_mapped['function_name'], $args, $query, $primary_key);
      }
    }

    throw new SimmaException('No API function matches the given conditions. Please check the documentation');

  }

  /**
   * @param $query
   * @param $result
   * @return mixed
   */
  private function analyseQueryJoin($query, &$result) {

    $entity_type = $query['type'];
    $join_type = key($query['join']);

    $join_mask = $this->join_mapping[$entity_type][$join_type];

    $datasource_entity_info = wovi_datasource_entity_get_info();
    $primary_key = $datasource_entity_info[$query['type']]['primary_key'];

    $args = $join_mask['args'];

  //  dpm($args,'arguments');

    if (empty($result)) {
      foreach ($query['conditions'] as $condition_key => $condition_value) {
        if ($condition_value['field'] == $primary_key) {
          $result = array(
            $condition_value['value'] => array(
              $primary_key => $condition_value['value'],
            ),
          );
        }
      }
    }


    foreach ($result['results'] as $primary_key_value => $result_value) {
      $args[$primary_key] = $primary_key_value;

      dpm($primary_key_value);
      // Exceptions
      if($entity_type == 'si_children'){
        $args['childID'] = $result['results'][$primary_key_value]['projectID'].'-'.$result['results'][$primary_key_value]['childSequence'];
        $primary_key = 'childID';
      }

      $result['results'][$primary_key_value][$join_type] = $this->APICall($join_mask['function_name'], $args, $query, $primary_key);
    }
    dpm($result, 'result');

//      $args[key($condition[$flags[key($args)]])] = $condition[$flags[key($args)]];

//    }

  }


}