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

}
