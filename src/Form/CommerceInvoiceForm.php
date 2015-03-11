<?php
/**
 * @file
 * Definition of Drupal\commerce_invoice\Form\CommerceInvoiceForm.
 */
namespace Drupal\commerce_invoice\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the commerce_invoice entity edit forms.
 */
class CommerceInvoiceForm extends ContentEntityForm {

  /**
   * Overrides Drupal\Core\Entity\EntityFormController::save().
   */
  public function save(array $form, FormStateInterface $form_state) {
    try {
      $this->entity->save();
      drupal_set_message($this->t('The invoice %invoice_label has been successfully saved.', array('%invoice_label' => $this->entity->label())));
    }
    catch (\Exception $e) {
      drupal_set_message($this->t('The invoice %invoice_label could not be saved.', array('%invoice_label' => $this->entity->label())), 'error');
      $this->logger('commerce_invoice')->error($e);
    }
    $form_state->setRedirect('entity.commerce_invoice.collection');
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    /* @var \Drupal\commerce_invoice\Entity\CommerceInvoice $invoice */
    $invoice = $this->entity;
    $current_user = $this->currentUser();

    $form['advanced'] = array(
      '#type' => 'vertical_tabs',
      '#attributes' => array('class' => array('entity-meta')),
      '#weight' => 99,
    );
    $form = parent::form($form, $form_state);

    $form['invoice_status'] = array(
      '#type' => 'details',
      '#title' => t('Invoice status'),
      '#group' => 'advanced',
      '#attributes' => array(
        'class' => array('invoice-form-invoice-status'),
      ),
      '#attached' => array(
        'library' => array('commerce_invoice/drupal.commerce_invoice'),
      ),
      '#weight' => 90,
      '#optional' => TRUE,
    );

    if (isset($form['status'])) {
      $form['status']['#group'] = 'invoice_status';
    }

    $form['revision'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Create new revision'),
      '#default_value' => $invoice->isNewRevision(),
      '#access' => $current_user->hasPermission('administer products'),
      '#group' => 'invoice_status',
      '#weight' => 10,
    );

    $form['revision_log'] += array(
      '#states' => array(
        'visible' => array(
          ':input[name="revision"]' => array('checked' => TRUE),
        ),
      ),
      '#group' => 'invoice_status',
    );

    // Invoice authoring information for administrators.
    $form['author'] = array(
      '#type' => 'details',
      '#title' => t('Authoring information'),
      '#group' => 'advanced',
      '#attributes' => array(
        'class' => array('invoice-form-author'),
      ),
      '#attached' => array(
        'library' => array('commerce_invoice/drupal.commerce_invoice'),
      ),
      '#weight' => 91,
      '#optional' => TRUE,
    );

    if (isset($form['uid'])) {
      $form['uid']['#group'] = 'author';
    }

    if (isset($form['mail'])) {
      $form['mail']['#group'] = 'author';
    }

    if (isset($form['created'])) {
      $form['created']['#group'] = 'author';
    }

    return $form;
  }

}
