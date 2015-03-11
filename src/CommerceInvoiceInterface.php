<?php

/**
 * @file
 * Contains \Drupal\commerce_invoice\CommerceInvoiceInterface.
 */

namespace Drupal\commerce_invoice;

use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a Commerce Invoice entity.
 */
interface CommerceInvoiceInterface extends EntityChangedInterface, EntityInterface, EntityOwnerInterface {

  /**
   * Returns the invoice number.
   *
   * @return string
   *   The invoice number.
   */
  public function getInvoiceNumber();

  /**
   * Sets the invoice number.
   *
   * @param string $invoice_number
   *   The invoice number.
   *
   * @return \Drupal\commerce_invoice\CommerceInvoiceInterface
   *   The called invoice entity.
   */
  public function setInvoiceNumber($invoice_number);

  /**
   * Returns the invoice type.
   *
   * @return string
   *   The invoice type.
   */
  public function getType();

  /**
   * Returns the invoice status.
   *
   * @return string
   *   The invoice status.
   */
  public function getStatus();

  /**
   * Sets the invoice status.
   *
   * @param string $status
   *   The invoice status.
   *
   * @return \Drupal\commerce_invoice\CommerceInvoiceInterface
   *   The called invoice entity.
   */
  public function setStatus($status);

  /**
   * Returns the invoice creation timestamp.
   *
   * @return int
   *   Creation timestamp of the invoice.
   */
  public function getCreatedTime();

  /**
   * Sets the invoice creation timestamp.
   *
   * @param int $timestamp
   *   The invoice creation timestamp.
   *
   * @return \Drupal\commerce_invoice\CommerceInvoiceInterface
   *   The called invoice entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the invoice revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the invoice revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\commerce_invoice\CommerceInvoiceInterface
   *   The called invoice entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Returns the invoice revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionAuthor();

  /**
   * Sets the invoice revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\commerce_invoice\CommerceInvoiceInterface
   *   The called invoice entity.
   */
  public function setRevisionAuthorId($uid);

  /**
   * Returns the line items associated with this invoice.
   *
   * @return array
   *   The line items of this invoice.
   */
  public function getLineItems();

  /**
   * Sets the line items associated with this invoice.
   *
   * @param array $line_items
   *   The line items associated with this invoice.
   *
   * @return \Drupal\commerce_invoice\CommerceInvoiceInterface
   *   The called invoice entity.
   */
  public function setLineItems($line_items);

  /**
   * Returns the additional data stored in this invoice.
   *
   * @return array
   *   An array of additional data.
   */
  public function getData();

  /**
   * Sets random information related to this invoice.
   *
   * @param array $data
   *   An array of additional data.
   *
   * @return \Drupal\commerce_invoice\CommerceInvoiceInterface
   *   The called invoice entity.
   */
  public function setData($data);

  /**
   * Returns the IP address that created this invoice.
   *
   * @return string
   *   The ip address.
   */
  public function getHostname();

  /**
   * Sets the IP address associated with this invoice.
   *
   * @param string $hostname
   *   The IP address to associate to this invoice.
   *
   * @return \Drupal\commerce_invoice\CommerceInvoiceInterface
   *   The called invoice entity.
   */
  public function setHostname($hostname);

  /**
   * Returns the e-mail address associated with the invoice.
   *
   * @return string
   *   The invoice mail.
   */
  public function getEmail();

  /**
   * Sets the invoice mail.
   *
   * @param string $mail
   *   The e-mail address associated with the invoice.
   *
   * @return \Drupal\commerce_invoice\CommerceInvoiceInterface
   *   The called invoice entity.
   */
  public function setEmail($mail);

}
