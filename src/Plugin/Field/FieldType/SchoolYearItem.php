<?php

namespace Drupal\school_year_field\Plugin\Field\FieldType;

use Drupal\Core\TypedData\DataDefinition;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;

/**
 * Field type "school_year".
 *
 * @FieldType(
 *   id = "school_year",
 *   label = @Translation("School Year"),
 *   description = @Translation("Custom school year field."),
 *   category = @Translation("Year"),
 *   default_widget = "school_year_default",
 *   default_formatter = "school_year_default",
 * )
 */
class SchoolYearItem extends FieldItemBase implements FieldItemInterface {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {

    // module_load_include('inc', 'burrito_maker');

    // $output = array();

    // // Create basic column for burrito name.
    // $output['columns']['name'] = array(
    //   'type' => 'varchar',
    //   'length' => 255,
    // );

    // // Make a column for every topping.
    // $topping_coll = burrito_maker_get_toppings();
    // foreach ($topping_coll as $topping_key => $topping_name) {
    //   $output['columns'][$topping_key] = array(
    //     'type' => 'int',
    //     'length' => 1,
    //   );
    // }

    // return $output;

    return [
      'columns' => [
        'year' => [
          'type' => 'varchar',
          'length' => 9,
          'not null' => FALSE,
        ]
      ]
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {

    // module_load_include('inc', 'burrito_maker');

    // $properties['value'] = DataDefinition::create('string');

  
    $properties = [
      'year' => DataDefinition::create('string')
                ->setLabel(t('Name'))
                ->setRequired(FALSE)
    ];

    // return $properties;
    // $topping_coll = burrito_maker_get_toppings();
    // foreach ($topping_coll as $topping_key => $topping_name) {
    //   $properties[$topping_key] = DataDefinition::create('boolean')
    //     ->setLabel($topping_name);
    // }

    // return $properties;

  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('source_code')->getValue();
    return $value === NULL || $value === '';
  }


  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings() {
    return array(
      'start_year' => 1,
    ) + parent::defaultFieldSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function fieldSettingsForm(array $form, FormStateInterface $form_state) {
    $output['start_year'] = array(
      '#type' => 'int',
      '#title' => t('Start year'),
      '#default_value' => $this->currentYear(),
    );
    return $output;
  }

  private function currentYear() : int {
    return intval(date("Y"));
  }

  /**
   * Returns an array of toppings assigned to the burrito.
   *
   * @return array
   *   An associative array of all toppings assigned to the burrito.
   */
  public function getToppings() {

    module_load_include('inc', 'burrito_maker');

    $output = array();

    foreach (burrito_maker_get_toppings() as $topping_key => $topping_name) {
      if ($this->$topping_key) {
        $output[$topping_key] = $topping_name;
      }
    }

    return $output;

  }

}
