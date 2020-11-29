<?php

namespace Drupal\certification_practice\EventSubscriber;

use Drupal\Core\Routing\LocalRedirectResponse;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Url;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\RequestEvent;

/**
 * Redirect user role on_hold users to the home page.
 */
class CertificationRedirectSubscriber implements EventSubscriberInterface {

  /**
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * The current route match.
   *
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected $routeMatch;

  /**
   * CertificationRedirectSubscriber constructor.
   *
   * @param \Drupal\Core\Session\AccountProxyInterface $currentUser
   *   The current user.
   * @param \Drupal\Core\Routing\RouteMatchInterface $routeMatch
   *   The current route match.
   */
  public function __construct(AccountProxyInterface $currentUser, RouteMatchInterface $routeMatch) {
    $this->currentUser = $currentUser;
    $this->routeMatch = $routeMatch;
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = ['onRequest', 0];
    return $events;
  }

  /**
   * Handler for the kernel request event.
   *
   * @param \Symfony\Component\HttpKernel\Event\RequestEvent $event
   */
  public function onRequest(RequestEvent $event) {
    $route_name = $this->routeMatch->getRouteName();
    if ($route_name !== 'certification_practice.hello') {
      return;
    }
    $userId = $this->routeMatch->getParameters()->get('user');
    $roles = $this->currentUser->getRoles();
    // Redirect role on_hold when accessing other users
    if (in_array('on_hold', $roles) && $userId !== $this->currentUser->id()) {
      $url = Url::fromUri('internal:/');
      $event->setResponse(new LocalRedirectResponse($url->toString()));
    }
  }

}
