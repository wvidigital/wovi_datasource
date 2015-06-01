<?php
/**
 * Created by PhpStorm.
 * User: moe
 * Date: 27.05.15
 * Time: 16:40
 */

/**
 * Class QueryLoaderException
 * Is be used in the QueryLoader.
 * @package QueryLoader
 */
class QueryLoaderException extends \Exception {
}

/**
 * Class QueryLoader
 * @todo Class, methods, parameters.... have to be documented
 *
 * @package QueryLoader
 */
class QueryLoader {

  /**
   * @var
   *  The type of selection. e.g. children, project.
   */
  private $select;
  /**
   * @var array
   *  List of names that are requested (optional).
   */
  private $fields = array();
  /**
   * @var array
   *  List of conditions for the requested data.
   */
  private $conditions = array();
  /**
   * @var array
   *  Quantity of requested datasets.
   */
  private $range = array();


  /**
   * Set the type of your data you are requesting.
   *
   * @param $type
   *  The type of selection. e.g. children, project.
   * @return QueryLoader/QueryLoader
   *  Returns the QueryLoader Object itself.
   * @throws QueryLoaderException
   *  Throws exceptions if the parameters are not valid.
   */
  public function select($type) {
    if (isset($type) && $type != '') {
      $this->select = $type;
    }
    else {
      throw new QueryLoaderException('Select $type is missing');
    }

    return $this;
  }

  /**
   * Set the fields of your data you are requesting (optional).
   *
   * @param null $fields
   *  List of names that are requested (optional).
   * @return QueryLoader/QueryLoader
   *  Returns the QueryLoader Object itself.
   * @throws QueryLoaderException
   *  Throws exceptions if the parameters are not valid.
   */
  public function fields($fields = NULL) {
    if (is_array($fields) || $fields === NULL) {
      $this->fields = $fields;
    }
    else {
      throw new QueryLoaderException('Wrong data type for $fields');
    }

    return $this;
  }

  /**
   * Set the condition of your data you are requesting.
   *
   * @param $field
   * @param $value
   * @param null $operator
   *   Conditions for the requested data.
   * @return QueryLoader/QueryLoader
   *  Returns the QueryLoader Object itself.
   * @throws QueryLoaderException
   *  Throws exceptions if the parameters are not valid.
   */
  public function condition($field, $value, $operator = NULL) {
    if (isset($field) && $field === '') {
      throw new QueryLoaderException('Condition $type is missing');
    }
    if (isset($value) && $value === '') {
      throw new QueryLoaderException('Condition $value is missing');
    }
    if (is_array($operator) || $operator === NULL) {
      throw new QueryLoaderException('Wrong data type for $operator');
    }

    $this->conditions[] = array(
      'field' => $field,
      'value' => $value,
      'operator' => $operator
    );

    return $this;
  }


  /**
   * Set the range of your data you are requesting.
   *
   * @param $from
   * @param $to
   *  Quantity of requested datasets.
   * @return QueryLoader/QueryLoader
   *  Returns the QueryLoader Object itself.
   * @throws QueryLoaderException
   *  Throws exceptions if the parameters are not valid.
   */
  public function range($from, $to) {
    if (isset($from) && $from === '') {
      throw new QueryLoaderException('Condition $from is missing');
    }
    if (isset($to) && $to === '') {
      throw new QueryLoaderException('Condition $to is missing');
    }
    $this->range['from'] = $from;
    $this->range['to'] = $to;

    return $this;
  }

  /**
   * Returns all query relevant information as array.
   *
   * @return array
   *  An associative array with query information.
   */
  private function _getQueryInformation() {
    return array(
      'select' => $this->select,
      'fields' => $this->fields,
      'conditions' => $this->conditions,
      'range' => $this->range,
    );
  }

  /**
   * Executes all or one datasource and returns the data.
   *
   * @param $datasource_name
   *  A datasource name that should be executed directly. (Default NULL)
   * @return array
   *  An associative array with datasource names as key and datasource
   *  information as value.
   * @throws QueryLoaderException
   */
  public function execute($datasource_name = NULL) {
    if ($this->select === '') {
      throw new QueryLoaderException('All necessary parameters have to be set.');
    }

    return wovi_datasource_execute($this->_getQueryInformation(), $datasource_name);
  }
}