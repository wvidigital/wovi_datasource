<?php
/**
 * Created by PhpStorm.
 * User: moe
 * Date: 27.05.15
 * Time: 16:40
 */

/**
 * Class QueryBuilderException
 * Is be used in the QueryBuilder.
 * @package QueryBuilder
 */
class QueryBuilderException extends \Exception {
}


/**
 * Class QueryBuilder
 * @todo Class, methods, parameters.... have to be documented
 *
 * @package QueryBuilder
 */
class QueryBuilder {
  /**
   * @var
   *  The type of operation.
   */
  private $operator;
  /**
   * @var
   *  The type of selection. e.g. children, project.
   */
  private $type;
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
   * @var array
   *  Default order of this query.
   */
  private $order = array();
  /**
   * @var array
   *  Joined Media data. Very basic join function.
   */
  private $join = array();

  /**
   * Set the type of your data you are requesting.
   *
   * @param $type
   *  The type of selection. e.g. children, project.
   * @return QueryBuilder
   *  Returns the QueryBuilder Object itself.
   * @throws QueryBuilderException
   *  Throws exceptions if the parameters are not valid.
   */
  public function select($type) {
    if (isset($type) && $type != '') {
      $this->type = $type;
      $this->operator = 'select';
    }
    else {
      throw new QueryBuilderException('Select $type is missing');
    }
    return $this;
  }

  /**
   * Joined Media data. Very basic join function.
   *
   * @param $type ,
   *  The type of data to join.
   * @param $args
   *  Additional Parameters like width and height can be set optional.
   * @return QueryBuilder
   *  Returns the QueryBuilder Object itself.
   */
  public function join($type, $args = array()) {
    $this->join[$type] = $args;

    return $this;
  }

  /**
   * Set the fields of your data you are requesting (optional).
   *
   * @param null $fields
   *  List of names that are requested (optional).
   * @return QueryBuilder
   *  Returns the QueryBuilder Object itself.
   * @throws QueryBuilderException
   *  Throws exceptions if the parameters are not valid.
   */
  public function fields($fields = NULL) {
    if (is_array($fields) || $fields === NULL) {
      $this->fields = $fields;
    }
    else {
      throw new QueryBuilderException('Wrong data type for $fields');
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
   * @return QueryBuilder
   *  Returns the QueryBuilder Object itself.
   * @throws QueryBuilderException
   *  Throws exceptions if the parameters are not valid.
   */
  public function condition($field, $value, $operator = NULL) {
    if (isset($field) && $field === '') {
      throw new QueryBuilderException('Condition $type is missing');
    }
    if (isset($value) && $value === '') {
      throw new QueryBuilderException('Condition $value is missing');
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
   * @return QueryBuilder
   *  Returns the QueryBuilder Object itself.
   * @throws QueryBuilderException
   *  Throws exceptions if the parameters are not valid.
   */
  public function range($from, $to) {
    if (isset($from) && $from === '') {
      throw new QueryBuilderException('Condition $from is missing');
    }
    if (isset($to) && $to === '') {
      throw new QueryBuilderException('Condition $to is missing');
    }
    $this->range['from'] = $from;
    $this->range['to'] = $to;
    return $this;
  }

  /**
   * Set the order of the results.
   *
   * @param $field
   *  The field to order the results.
   * @param $direction
   *  'ASC' for ascending 'DESC' for descending ordering. (Default 'ASC')
   * @return $this
   *  Returns the QueryBuilder Object itself.
   * @throws QueryBuilderException
   *  Throws exceptions if the parameters are not valid.
   */
  public function orderBy($field, $direction = 'ASC') {
    if (isset($field) && $field === '') {
      throw new QueryBuilderException('Argument $field is missing');
    }
    if (isset($direction) && $direction === '') {
      throw new QueryBuilderException('Argument $direction is missing');
    }
    $this->order['field'] = $field;
    $this->order['direction'] = $direction;
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
      'operator' => $this->operator,
      'type' => $this->type,
      'join' => $this->join,
      'fields' => $this->fields,
      'conditions' => $this->conditions,
      'order' => $this->order,
      'range' => $this->range,
    );
  }

  /**
   * Executes all or one datasource and returns the data.
   *
   * @param $configuration
   *  An array with additional configuration for the execution handler:
   *    - $datasource: If only a specific datasource should be executed. (Default NULL)
   *    - $cache: If FALSE no cache will be used. (Default TRUE)
   * @return array
   *  An associative array with datasource names as key and datasource
   *  information as value.
   * @throws QueryBuilderException
   */
  public function execute($configuration) {

    $configuration = drupal_array_merge_deep($configuration, array(
      'datasource' => NULL,
      'cache' => TRUE,
    ));

    if ($this->operator === '') {
      throw new QueryBuilderException('All necessary parameters have to be set.');
    }
    return wovi_datasource_execute($this->_getQueryInformation(), $configuration);
  }
}
