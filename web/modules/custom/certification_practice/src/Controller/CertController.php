<?php

namespace Drupal\certification_practice\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\certification_practice\CertMessage;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller certification modules.
 */
class CertController extends ControllerBase {

  /**
   * @var \Drupal\certification_practice\CertMessage
   */
  protected $msg;

  /**
   * CertController constructor.
   *
   * @param \Drupal\certification_practice\Controller\CertMessage
   *   $message
   */
  public function __construct(CertMessage $message) {
    $this->msg = $message;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static($container->get('certification_practice.message'));
  }

  /**
   * Certification message.
   *
   * @return array
   *   The message.
   */
  public function certPracticeMessage($user) {
    $msg = $this->t('Certification Message. User id: @user_id', ['@user_id' => $user]);
    return [
      '#markup' => $msg . " " . $this->msg->getMessage(),
    ];
  }

}
