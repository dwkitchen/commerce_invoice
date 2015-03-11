<?php

/**
 * @file
 * Contains Drupal\commerce_invoice\Form\CommerceInvoiceTypeForm.
 */

namespace Drupal\commerce_invoice\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CommerceInvoiceTypeForm extends EntityForm {

  /**
   * The invoice type storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $invoiceTypeStorage;

  /**
   * Create an IndexForm object.
   *
   * @param \Drupal\Core\Entity\EntityStorageInterface $invoice_type_storage
   *   The invoice type storage.
   */
  public function __construct(EntityStorageInterface $invoice_type_storage) {
    // Setup object members.
    $this->invoiceTypeStorage = $invoice_type_storage;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    /** @var \Drupal\Core\Entity\EntityManagerInterface $entity_manager */
   $entity_manager = $container->get('entity.manager');
   return new static($entity_manager->getStorage('commerce_invoice_type'));
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);
    $invoice_type = $this->entity;

    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $invoice_type->label(),
      '#description' => $this->t('Label for the invoice type.'),
      '#required' => TRUE,
    );

    $form['id'] = array(
      '#type' => 'machine_name',
      '#default_value' => $invoice_type->id(),
      '#machine_name' => array(
        'exists' => array($this->invoiceTypeStorage, 'load'),
        'source' => array('label'),
      ),
      '#disabled' => !$invoice_type->isNew(),
    );

    $form['description'] = array(
      '#title' => t('Description'),
      '#type' => 'textarea',
      '#default_value' => $invoice_type->getDescription(),
      '#description' => $this->t('Description of this invoice type'),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $invoice_type = $this->entity;

    try {
      $invoice_type->save();
      drupal_set_message($this->t('Saved the %label invoice type.', array(
        '%label' => $invoice_type->label(),
      )));
      $form_state->setRedirect('entity.commerce_invoice_type.collection');
    }
    catch (\Exception $e) {
      $this->logger('commerce_invoice')->error($e);
      drupal_set_message($this->t('The %label invoice type was not saved.', array(
        '%label' => $invoice_type->label(),
      )), 'error');
      $form_state->setRebuild();
    }
  }

}
