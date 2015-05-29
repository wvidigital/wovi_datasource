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

  return array(
    '#theme' => 'wovi_datasource_configuration_list',
    '#content' => $content,
  );
}

/**
 * Theme function: Returns HTML for a list of available node configuration links.
 *
 * @param $variables
 *   An associative array containing:
 *   - content: An array of menu items.
 *
 * @return string
 *  html markup
 */
function theme_wovi_datasource_configuration_list($variables) {
  $content = $variables ['content'];
  $output = '';

  if ($content) {
    $output = '<dl class="datasource-list">';
    foreach ($content as $item) {
      $output .= '<dt>' . l($item ['title'], $item['href'], $item ['localized_options']) . '</dt>';
      $output .= '<dd>' . filter_xss_admin($item ['description']) . '</dd>';
    }
    $output .= '</dl>';
  }
  else {
    $output = '<p>' . t('No configurable datasource available.') . '</p>';
  }
  return $output;
}
