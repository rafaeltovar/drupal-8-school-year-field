<?php

namespace Drupal\school_year_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Field formatter "school_year_default".
 *
 * @FieldFormatter(
 *   id = "school_year_default",
 *   label = @Translation("School year default"),
 *   field_types = {
 *     "school_year",
 *   }
 * )
 */
class SchoolYearDefaultFormatter extends FormatterBase {

  // /**
  //  * {@inheritdoc}
  //  */
  // public static function defaultSettings() {
  //   return array(
  //     'toppings' => 'csv',
  //   ) + parent::defaultSettings();
  // }

  // /**
  //  * {@inheritdoc}
  //  */
  // public function settingsForm(array $form, FormStateInterface $form_state) {

  //   $output['toppings'] = array(
  //     '#title' => t('Toppings'),
  //     '#type' => 'select',
  //     '#options' => array(
  //       'csv' => t('Comma separated values'),
  //       'list' => t('Unordered list'),
  //     ),
  //     '#default_value' => $this->getSetting('toppings'),
  //   );

  //   return $output;

  // }

  // /**
  //  * {@inheritdoc}
  //  */
  // public function settingsSummary() {

  //   $summary = array();

  //   // Determine ingredients summary.
  //   $toppings_summary = FALSE;
  //   switch ($this->getSetting('toppings')) {

  //     case 'csv':
  //       $toppings_summary = 'Comma separated values';
  //       break;

  //     case 'list':
  //       $toppings_summary = 'Unordered list';
  //       break;

  //   }

  //   // Display ingredients summary.
  //   if ($toppings_summary) {
  //     $summary[] = t('Toppings display: @format', array(
  //       '@format' => t($toppings_summary),
  //     ));
  //   }

  //   return $summary;

  // }

  // /**
  //  * {@inheritdoc}
  //  */
  public function viewElements(FieldItemListInterface $items, $langcode) {

    $output = [];

    // Iterate over every field item and build a renderable array
    // (I call them rarray for short) for each item.
    foreach ($items as $delta => $item) {
      $build = [];
      $build['year'] = array(
        '#type' => 'container',
        '#attributes' => array(
          'class' => array('school_year__year'),
        ),
        'label' => array(
          '#type' => 'container',
          '#attributes' => array(
            'class' => array('field__label'),
          ),
          '#markup' => t('School year'),
        ),
        'value' => array(
          '#type' => 'container',
          '#attributes' => array(
            'class' => array('field__item'),
          ),
          '#plain_text' => $item->year,
        ),
      );

      $output[$delta] = $build;
    }

    return $output;

  }

  // /**
  //  * Builds a renderable array or string of toppings.
  //  *
  //  * @param string $format
  //  *   The format in which the toppings are to be displayed.
  //  *
  //  * @return array
  //  *   A renderable array of toppings.
  //  */
  // public function buildToppings($format, FieldItemInterface $item) {
  //   // Instead of having a switch-case we build a dynamic method name
  //   // as per a pre-determined format. In this way, if we will to add
  //   // a new format in the future, all we will have to do is create a
  //   // new method named "buildToppingsFormatName()".
  //   $callback = 'buildToppings' . ucfirst($format);
  //   return $this->$callback($item);
  // }

  // /**
  //  * Format toppings as CSV.
  //  */
  // public function buildToppingsCsv(FieldItemInterface $item) {
  //   $toppings = $item->getToppings();
  //   return array(
  //     '#markup' => implode(', ', $toppings),
  //   );
  // }

  // /**
  //  * Format toppings as an unordered list.
  //  */
  // public function buildToppingsList(FieldItemInterface $item) {
  //   // "item_list" is a very handy render type.
  //   return array(
  //     '#theme' => 'item_list',
  //     '#items' => $item->getToppings(),
  //   );
  // }

}
