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
  
    $properties = [
      'year' => DataDefinition::create('string')
                ->setLabel(t('School year'))
                ->setRequired(FALSE)
    ];

    return $properties;

  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('year')->getValue();
    return $value === NULL || $value === '';
  }


  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings() {
    return array(
      'start_year' => self::currentYear(),
    ) + parent::defaultFieldSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function fieldSettingsForm(array $form, FormStateInterface $form_state) {
    $output['start_year'] = array(
      '#type' => 'textfield',
      '#title' => t('Start year'),
      '#default_value' => $this->getSetting('start_year'),
    );
    return $output;
  }

  private static function currentYear() : int {
    return intval(date("Y"));
  }

}
