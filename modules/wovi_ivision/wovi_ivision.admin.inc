<?php

/**
 * @file
 * All functions, callbacks and helpers to administer the ivision api module.
 */

/**
 * Returns ivision settings form for the administration page.
 *
 * @param $form
 * @param $form_state
 * @return mixed
 *  An renderable array of form elements.
 */
function wovi_ivision_settings_form($form, &$form_state) {
  $instances = variable_get('wovi_ivision_settings', array());

  $form_state['restricted_elements'] = isset($form_state['restricted_elements']) ?
    $form_state['restricted_elements'] : array();
  $form_state['ajax_element_counter'] = isset($form_state['ajax_element_counter']) ?
    $form_state['ajax_element_counter'] : 0;

  $form['wovi_ivision_settings'] = array(
    '#type' => 'container',
    '#attributes' => array(),
    '#prefix' => '<div id="wovi-ivision-settings-ajax-wrapper">',
    '#suffix' => '</div>',
    '#tree' => TRUE,
  );


  $elements = array();

  // Generate elements form settings.
  foreach ($instances as $machine_name => $settings) {
    $settings['name'] = $machine_name;
    $elements[] = wovi_ivision_settings_instance_element($settings);
  }

  // Generate the new ajax elements.
  for ($i = 0; $i < $form_state['ajax_element_counter']; $i++) {
    $elements[] = wovi_ivision_settings_instance_element();;
  }

  // Append all elements.
  foreach ($elements as $index => $element) {
    // Store index as name.
    $element['remove']['#name'] = $index;
    $form['wovi_ivision_settings'][$index] = $element;
  }

  // Add remove element to disallowed element list.
  if (isset($form_state['triggering_element']) && $form_state['triggering_element']['#value'] == t('Remove')) {
    $index = $form_state['triggering_element']['#name'];
    $form_state['restricted_elements'][$index] = $index;
  }

  // Disallow removed elements.
  foreach ($form_state['restricted_elements'] as $index) {
    $form['wovi_ivision_settings'][$index]['#access'] = FALSE;
    $form['wovi_ivision_settings'][$index]['#disabled'] = TRUE;
  }


  $form['more'] = array(
    '#type' => 'submit',
    '#value' => t('Add instance'),
    '#limit_validation_errors' => array(),
    '#submit' => array('wovi_ivision_settings_form_ajax_add'),
    '#ajax' => array(
      'callback' => 'wovi_ivision_settings_form_ajax_add',
      'wrapper' => 'wovi-ivision-settings-ajax-wrapper',
      'method' => 'replace',
      'effect' => 'fade',
    ),
  );

  $form['actions'] = array('#type' => 'actions');
  $form['actions']['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save'),
  );

  return $form;
}

/**
 * Validates the ivision settings form.
 *
 * @param $form
 * @param $form_state
 */
function wovi_ivision_settings_form_validate($form, &$form_state) {
  if (isset($form_state['values']['wovi_ivision_settings'])) {
    foreach ($form_state['values']['wovi_ivision_settings'] as $index => $settings) {
      if (
        isset($form['wovi_ivision_settings'][$index]['#access']) &&
        !$form['wovi_ivision_settings'][$index]['#access']
      ) {
        // Remove value and continue validating.
        unset($form_state['values']['wovi_ivision_settings'][$index]);
        continue;
      }

      // Validate url.
      if (!filter_var(wovi_ivision_build_uri($settings), FILTER_VALIDATE_URL)) {
        form_error($form['wovi_ivision_settings'][$index]['uri'], t('Please enter a valid uri.'));
      }

    }
  }
}

/**
 * Submits the ivision settings form.
 *
 * @param $form
 * @param $form_state
 */
function wovi_ivision_settings_form_submit($form, &$form_state) {
  $wovi_ivision_settings = array();

  if (isset($form_state['values']['wovi_ivision_settings'])) {
    foreach ($form_state['values']['wovi_ivision_settings'] as $settings) {
      $wovi_ivision_settings[$settings['name']] = $settings;
    }
  }

  variable_set('wovi_ivision_settings', $wovi_ivision_settings);
}

/**
 * Ajax Callback: Adds an element from the ivision setting sform.
 *
 * @param $form
 * @param $form_state
 *  An renderable array of form elements.
 */
function wovi_ivision_settings_form_ajax_add($form, &$form_state) {
  $form_state['ajax_element_counter']++;
  $form_state['rebuild'] = TRUE;
  return $form['wovi_ivision_settings'];
}

/**
 * Ajax Callback: Removes an element from the ivision setting sform.
 *
 * @param $form
 * @param $form_state
 * @return array
 *  An renderable array of form elements.
 */
function wovi_ivision_settings_form_ajax_remove($form, &$form_state) {
  $form_state['rebuild'] = TRUE;
  drupal_set_message(t('Your changes will only take effect after saving.'), 'warning');
  return $form['wovi_ivision_settings'];
}

/**
 * Helper function: Creates an settings element for ivision settings form.
 *
 * @see wovi_ivision_settings_form()
 *
 * @param array $default_values
 * @return array
 *  An renderable array of form elements.
 */
function wovi_ivision_settings_instance_element($default_values = array()) {
  $element = array(
    '#type' => 'fieldset',
    '#title' => isset($default_values['name']) ? t('Settings for %name', array(
      '%name' => $default_values['name'],
    )) : t('New instance'),
    '#tree' => TRUE,
    '#attributes' => array(),
    '#collapsible' => isset($default_values['name']),
    '#collapsed' => isset($default_values['name']),
  );

  $element['name'] = array(
    '#type' => 'machine_name',
    '#title' => t('Name'),
    '#default_value' => isset($default_values['name']) ? $default_values['name'] : NULL,
    '#machine_name' => array(
      'exists' => 'wovi_ivision_instance_exists',
    ),
    '#disabled' => isset($default_values['name']),
  );

  $element['uri'] = array(
    '#type' => 'textfield',
    '#title' => t('Uri'),
    '#required' => TRUE,
    '#default_value' => isset($default_values['uri']) ? $default_values['uri'] : NULL,
    '#field_prefix' => 'https://',
    '#field_suffix' => '/',
    '#description' => t('The ivision webservice uri. Please don\'t include the protocol.'),
  );

  $element['site_id'] = array(
    '#type' => 'textfield',
    '#title' => t('Site ID'),
    '#required' => TRUE,
    '#default_value' => isset($default_values['site_id']) ? $default_values['site_id'] : NULL,
    '#description' => t('The uniqure api site id'),
  );

  $element['language'] = array(
    '#type' => 'textfield',
    '#title' => t('Language'),
    '#required' => TRUE,
    '#maxlength' => 3,
    '#default_value' => isset($default_values['language']) ? $default_values['language'] : NULL,
    '#description' => t('The api language in ISO-639/2 format.'),
  );

  $element['dummy_data'] = array(
    '#type' => 'checkbox',
    '#title' => t('Dummy data'),
    '#default_value' => isset($default_values['dummy_data']) ? $default_values['dummy_data'] : NULL,
    '#description' => t('Use dummy data instead of query the webservice.'),
  );

  $element['remove'] = array(
    '#type' => 'button',
    '#value' => t('Remove'),
    '#submit' => array('wovi_ivision_settings_form_ajax_remove'),
    '#limit_validation_errors' => array(),
    '#ajax' => array(
      'callback' => 'wovi_ivision_settings_form_ajax_remove',
      'wrapper' => 'wovi-ivision-settings-ajax-wrapper',
      'method' => 'replace',
      'effect' => 'fade',
    ),
  );

  return $element;
}