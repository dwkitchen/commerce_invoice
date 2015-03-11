<?php

/**
 * @file
 * Contains \Drupal\commerce_invoice\Entity\CommerceInvoiceType.
 */

namespace Drupal\commerce_invoice\Entity;

use Drupal\commerce_invoice\CommerceInvoiceTypeInterface;
use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Invoice type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "commerce_invoice_type",
 *   label = @Translation("Invoice type"),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\commerce_invoice\Form\CommerceInvoiceTypeForm",
 *       "edit" = "Drupal\commerce_invoice\Form\CommerceInvoiceTypeForm",
 *       "delete" = "Drupal\commerce_invoice\Form\CommerceInvoiceTypeDeleteForm"
 *     },
 *     "list_builder" = "Drupal\commerce_invoice\CommerceInvoiceTypeListBuilder",
 *   },
 *   admin_permission = "administer invoice types",
 *   config_prefix = "commerce_invoice_type",
 *   bundle_of = "commerce_invoice",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "edit-form" = "/admin/commerce/config/invoice-types/{commerce_invoice_type}/edit",
 *     "delete-form" = "/admin/commerce/config/invoice-types/{commerce_invoice_type}/delete",
 *     "collection" = "/admin/commerce/config/invoice-types"
 *   }
 * )
 */
class CommerceInvoiceType extends ConfigEntityBundleBase implements CommerceInvoiceTypeInterface {

  /**
   * The invoice type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The invoice type label.
   *
   * @var string
   */
  protected $label;

  /**
   * A brief description of this invoice type.
   *
   * @var string
   */
  protected $description;

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * {@inheritdoc}
   */
  public function setDescription($description) {
    $this->description = $description;
    return $this;
  }

}
