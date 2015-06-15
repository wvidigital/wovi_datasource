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

function wovi_datasource_settings_form($form, &$form_state) {
  $form['cache'] = array(
    '#type' => 'fieldset',
    '#title' => t('Query cache'),
    '#attributs' => array(),
  );

  $form['cache']['wovi_datasource_cache_default'] = array(
    '#type' => 'checkbox',
    '#title' => t('Cache queries if by default.'),
    '#default_value' => variable_get('wovi_datasource_cache_default', TRUE),
  );


  $form['cache']['reset'] = array(
    '#type' => 'submit',
    '#value' => t('Clear query cache'),
    '#submit' => array('wovi_datasource_settings_form_clear_cache_submit'),
  );

  return system_settings_form($form);
}

/**
 * Submit Handler: Handles the clear cache request.
 *
 * @param $form
 * @param $form_state
 */
function wovi_datasource_settings_form_clear_cache_submit($form, &$form_state) {
  _wovi_datasource_cache_clear();
  drupal_set_message(t('Datasource Queries cache cleared.'));
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
