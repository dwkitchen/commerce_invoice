<?php

/**
 * @file
 * Contains \Drupal\commerce_invoice\Form\CommerceInvoiceTypeDeleteForm.
 */

namespace Drupal\commerce_invoice\Form;

use Drupal\Core\Entity\EntityDeleteForm;
use Drupal\Core\Entity\Query\QueryFactory;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Builds the form to delete an invoice type.
 */
class CommerceInvoiceTypeDeleteForm extends EntityDeleteForm {

  /**
   * The query factory to create entity queries.
   *
   * @var \Drupal\Core\Entity\Query\QueryFactory
   */
  protected $queryFactory;

  /**
   * Constructs a new CommerceInvoiceTypeDeleteForm object.
   *
   * @param \Drupal\Core\Entity\Query\QueryFactory $query_factory
   *   The entity query object.
   */
  public function __construct(QueryFactory $query_factory) {
    $this->queryFactory = $query_factory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.query')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $num_invoices = $this->queryFactory->get('commerce_invoice')
      ->condition('type', $this->entity->id())
      ->count()
      ->execute();
    if ($num_invoices) {
      $caption = '<p>' . $this->formatPlural($num_invoices, '%type is used by 1 invoice on your site. You can not remove this invoice type until you have removed all of the %type invoices.', '%type is used by @count invoices on your site. You may not remove %type until you have removed all of the %type invoices.', array('%type' => $this->entity->label())) . '</p>';
      $form['#title'] = $this->getQuestion();
      $form['description'] = array('#markup' => $caption);
      return $form;
    }
    return parent::buildForm($form, $form_state);
  }

}
