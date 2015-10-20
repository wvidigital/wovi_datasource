<?php

/**
 * @file
 * The DSLogger Class is used to store all datasource queries and it's results
 * for the current request.
 */

/**
 * Helper Class: Class DSLogger
 *
 * This class holds and handles the query logs.
 */
Class DSLogger {
  /**
   * @var array
   *  The array that holds all log entries.
   */
  static protected $log = array();

  /**
   * Appends an new entry to the log.
   *
   * @param $entry
   *  The log entry. Basically an array.
   */
  static public function writeEntry($entry) {
    array_push(self::$log, $entry);
  }

  /**
   * Returns the log array.
   *
   * @return array
   */
  static public function getLog() {
    return self::$log;
  }

  /**
   * Resets the log.
   */
  static public function resetLog() {
    self::$log = array();
  }

  /**
   * Returns the latest log entry.
   *
   * @return mixed
   */
  static public function getLatestEntry() {
    return end(self::$log);
  }

  /**
   * Removes the latest log entry.
   */
  static public function resetLatestEntry() {
    array_pop(self::$log);
  }
}