<?php

namespace Drupal\school_year_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Field\WidgetInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Field widget "school_year_default".
 *
 * @FieldWidget(
 *   id = "school_year_default",
 *   label = @Translation("School year default"),
 *   field_types = {
 *     "school_year",
 *   }
 * )
 */
class SchoolYearDefaultWidget extends WidgetBase implements WidgetInterface {

  const SEPARATOR = "/";
  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

    // $item is where the current saved values are stored.
    $item =& $items[$delta];

    $element['value'] = $element + [
      '#type' => 'select',
      '#default_value' => $items[$delta]->value ?? NULL,
      '#placeholder' => $this->getSetting('placeholder'),
      '#options' => $this->getOptions(),
    ];

    return $element;
  }

  private function getOptions() : array
  {
    $start = $this->getFieldSetting('start_year');
    $final = $this->currentSchoolYear();
    
    $school = "";
    $values = [];
    while($school != $final) {
      $next = $start + 1;
      $school = sprintf("%s%s%s", $start, self::SEPARATOR, $next);
      $key = sprintf("Y%s%s", $start, $next);
      $values[$key] = $school;
      $start = $next; 
    }
    $values[0] = "";

    return array_reverse($values, true);
  }

  private function currentSchoolYear() : string
  {
    $year = intval(date('Y'));
    $nextYear = $year + 1;

    return sprintf("%s%s%s", $year, self::SEPARATOR, $nextYear);
  }

}
