<?php
/**
 * @files
 * All functions, callbacks and helpers to administer the wovi datasource module.
 */

/**
 * Page callback: Displays configuration links for available datasources.
 *
 * Redirects to admin/config/development/wovi-datasource/[type] if only one
 * datasource is available.
 */
function wovi_datasource_configuration_page() {
  $item = menu_get_item();
  $content = system_admin_menu_block($item);

  if (count($content) == 1) {
    $item = array_shift($content);
    drupal_goto($item['href']);
  }
  return theme('node_add_list', array('content' => $content));
}