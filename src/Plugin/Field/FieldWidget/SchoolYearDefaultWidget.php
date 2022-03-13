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

    // Load burrito_maker.toppincs.inc file for reading topping data.
    // module_load_include('inc', 'burrito_maker');

    // $item is where the current saved values are stored.
    $item =& $items[$delta];

    // $element is already populated with #title, #description, #delta,
    // #required, #field_parents, etc.
    //
    // In this example, $element is a fieldset, but it could be any element
    // type (textfield, checkbox, etc.)
    // $element += array(
    //   '#type' => 'select',
    // );

    // Array keys in $element correspond roughly
    // to array keys in $item, which correspond
    // roughly to columns in the database table.
    $element['year'] = [
      '#title' => t('School year'),
      '#type' => 'select',
      '#options' => $this->getOptions(),
      '#default_value' => '',
    ];

    // // Show meat options only if allowed by field settings.
    // if ($this->getFieldSetting('allow_meat')) {

    //   // Have a separate fieldset for meat.
    //   $element['meat'] = array(
    //     '#title' => t('Meat'),
    //     '#type' => 'fieldset',
    //     '#process' => array(__CLASS__ . '::processToppingsFieldset'),
    //   );

    //   // Create a checkbox item for each meat on the menu.
    //   foreach (burrito_maker_get_toppings('meat') as $topping_key => $topping_name) {
    //     $element['meat'][$topping_key] = array(
    //       '#title' => t($topping_name),
    //       '#type' => 'checkbox',
    //       '#default_value' => isset($item->$topping_key) ? $item->$topping_key : '',
    //     );
    //   }

    // }

    // // Have a separate fieldset for non-meat toppings.
    // $element['toppings'] = array(
    //   '#title' => t('Toppings'),
    //   '#type' => 'fieldset',
    //   '#process' => array(__CLASS__ . '::processToppingsFieldset'),
    // );

    // // Create a checkbox item for each topping on the menu.
    // foreach (burrito_maker_get_toppings('vege') as $topping_key => $topping_name) {
    //   $element['toppings'][$topping_key] = array(
    //     '#title' => t($topping_name),
    //     '#type' => 'checkbox',
    //     '#default_value' => isset($item->$topping_key) ? $item->$topping_key : '',
    //   );
    // }

    return $element;

  }

  private function getOptions() : array
  {
    $start = $this->getFieldSetting('start_year');
    $final = $this->currentSchoolYear();

    $values = [0 => ""];
    $school = "";
    while($school != $final) {
      $next = $start + 1;
      $school = sprintf("%s%s%s", $start, self::SEPARATOR, $next);
      $values[$school] = $school;
      $start = $next; 
    }

    return $values;
  }

  private function currentSchoolYear() : string
  {
    $year = intval(date('Y'));
    $nextYear = $year + 1;

    return sprintf("%s%s%s", $year, self::SEPARATOR, $nextYear);
  }

  // /**
  //  * Form widget process callback.
  //  */
  // public static function processToppingsFieldset($element, FormStateInterface $form_state, array $form) {

  //   // The last fragment of the name, i.e. meat|toppings is not required
  //   // for structuring of values.
  //   $elem_key = array_pop($element['#parents']);

  //   return $element;

  // }

}
