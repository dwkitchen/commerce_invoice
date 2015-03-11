<?php
/**
 * @file
 * Callbacks for invoice add pages.
 */

use Drupal\Component\Utility\Xss;
use Drupal\Core\Url;

/**
 * Prepares variables for list of available invoice type templates.
 *
 * Default template: commerce-invoice-add-list.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - content: An array of invoice types.
 */
function template_preprocess_commerce_invoice_add_list(&$variables) {
  if (!empty($variables['types'])) {
    foreach ($variables['types'] as $invoice_type) {
      $url = Url::fromRoute('entity.commerce_invoice.add_form', array('commerce_invoice_type' => $invoice_type->id()));

      $variables['types'][$invoice_type->id()] = array(
        'type' => $invoice_type->id(),
        'add_link' => \Drupal::l($invoice_type->label(), $url),
        'description' => Xss::filterAdmin($invoice_type->getDescription()),
      );
    }
  }
}

