<?php

namespace Drupal\certification_practice\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\certification_practice\CertMessage;

/**
 * Certification block.
 *
 * @Block(
 *   id = "cert_message_block",
 *   admin_label = @Translation("Cert message"),
 * )
 */
class CertMessageBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The certification message service.
   *
   * @var \Drupal\certification_practice\CertMessage
   */
  protected $message;

  /**
   * Constructs a CertMessageBlock.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, CertMessage $message) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->message = $message;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('certification_practice.message')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'show' => 1,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();
    $form['show'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Show block'),
      '#description' => $this->t('Check this box to show block.'),
      '#default_value' => $config['show'],
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['show'] = $form_state->getValue('show');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    if ($this->configuration['show']) {
      return [
        '#markup' => $this->message->getMessage(),
      ];
    }
    return [];
  }

}
