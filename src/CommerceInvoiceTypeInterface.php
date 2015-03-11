<?php

/**
 * @file
 * Contains \Drupal\commerce_invoice\CommerceInvoiceTypeInterface.
 */

namespace Drupal\commerce_invoice;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface defining a commerce invoice type entity.
 */
interface CommerceInvoiceTypeInterface extends ConfigEntityInterface {

  /**
   * Returns the invoice type description.
   *
   * @return string
   *   The invoice type description.
   */
  public function getDescription();

  /**
   * Sets the description of the invoice type.
   *
   * @param string $description
   *   The new description.
   *
   * @return $this
   */
  public function setDescription($description);

}
