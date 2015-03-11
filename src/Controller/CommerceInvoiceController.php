<?php

/**
 * @file
 * Contains \Drupal\commerce_invoice\Controller\CommerceInvoiceController.
 */

namespace Drupal\commerce_invoice\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\commerce_invoice\CommerceInvoiceTypeInterface;

/**
 * Returns responses for Commerce Invoice admin routes.
 */
class CommerceInvoiceController extends ControllerBase {

  /**
   * Displays add content links for available invoice types.
   *
   * Redirects to admin/commerce/config/invoices/add/{invoice-type} if only one
   * type is available.
   *
   * @return array
   *   A render array for a list of the invoice types that can be added.
   */
  public function addPage() {
    $invoice_types = $this->entityManager()->getStorage('commerce_invoice_type')->loadMultiple();
    // Filter out the invoice types the user doesn't have access to.
    foreach ($invoice_types as $invoice_type_id => $invoice_type) {
      if (!$this->entityManager()->getAccessControlHandler('commerce_invoice')->createAccess($invoice_type_id)) {
        unset($invoice_types[$invoice_type_id]);
      }
    }

    if (count($invoice_types) == 1) {
      $invoice_type = reset($invoice_types);
      return $this->redirect('entity.commerce_invoice.add_form', array('commerce_invoice_type' => $invoice_type->id()));
    }

    return array(
      '#theme' => 'commerce_invoice_add_list',
      '#types' => $invoice_types,
    );
  }

  /**
   * Provides the invoice add form.
   *
   * @param \Drupal\commerce_invoice\CommerceInvoiceTypeInterface $commerce_invoice_type
   *   The invoice type entity for the invoice.
   *
   * @return array
   *   An invoice add form.
   */
  public function add(CommerceInvoiceTypeInterface $commerce_invoice_type) {
    $invoice = $this->entityManager()->getStorage('commerce_invoice')->create(array(
      'type' => $commerce_invoice_type->id(),
    ));
    $form = $this->entityFormBuilder()->getForm($invoice, 'add');

    return $form;
  }

  /**
   * The title_callback for the entity.commerce_invoice.add_form route.
   *
   * @param \Drupal\commerce_invoice\CommerceInvoiceTypeInterface $commerce_invoice_type
   *   The current invoice type.
   *
   * @return string
   *   The page title.
   */
  public function addPageTitle(CommerceInvoiceTypeInterface $commerce_invoice_type) {
    return $this->t('Create @label', array('@label' => $commerce_invoice_type->label()));
  }

}
