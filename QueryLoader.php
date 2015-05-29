<?php
/**
 * Created by PhpStorm.
 * User: moe
 * Date: 27.05.15
 * Time: 16:40
 */

namespace QueryLoader;

/**
 * Class QueryLoaderException
 *  Is be used in the QueryLoader.
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
  private $condition = array();
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
   * @param $type
   * @param $value
   * @param null $operator
   *   Conditions for the requested data.
   * @throws QueryLoaderException
   *  Throws exceptions if the parameters are not valid.
   */
  public function condition($type, $value, $operator = NULL) {
    if (isset($type) && $type === '') {
      throw new QueryLoaderException('Condition $type is missing');
    }
    if (isset($value) && $value === '') {
      throw new QueryLoaderException('Condition $value is missing');
    }
    if (is_array($operator) || $operator === NULL) {
      throw new QueryLoaderException('Wrong data type for $operator');
    }
    $this->condition['type'] = $type;
    $this->condition['value'] = $value;
    $this->condition['operator'] = $operator;

    return $this;
  }


  /**
   * Set the range of your data you are requesting.
   *
   * @param $from
   * @param $to
   *  Quantity of requested datasets.
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
   *
   * @throws QueryLoaderException
   */
  public function execute() {
    if ($this->select === '' ||
      count($this->condition) === 0 ||
      count($this->range) === 0
    ) {
      throw new QueryLoaderException('All necessary parameters have to be set.');
    }

    // @todo help me i am stupid.
  }

}

try {

  $test = new QueryLoader();
  $test->select('children')
    ->condition('age', 5, '<')
    ->fields()
    ->range(1, 5)
    ->execute();

} catch (QueryLoaderException $e) {
  echo "\n" . $e->getMessage() . "\n\n";
}
