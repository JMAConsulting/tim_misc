<?php

namespace Drupal\tim_misc\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a block with a simple text.
 *
 * @Block(
 *   id = "tim_misc_login",
 *   admin_label = @Translation("Login Block"),
 * )
 */
class LoginBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $className = "top-menu";
    if (\Drupal::service('path.matcher')->isFrontPage()) {
      $buttonColour = "white";
    }
    else {
      $className .= " else";
      $buttonColour = "dark";
    }
    if (\Drupal::currentUser()->isAuthenticated()) {
      $html = '
      <div class="clearfix hidden-xs">
        <div class="' . $className . '">
          <ul>
	        <li><a href="/user">Profile</a></li>
	        <li><a href="/user/logout">Log out</a></li>
	        <li><a href="/contact">Contact Us</a></li>
	        <li><a class="use-ajax btn btn-rounded ' . $buttonColour. ' small" data-dialog-options="{&quot;width&quot;:700}" data-dialog-type="modal" href="/donation-page">Donate</a></li>
          </ul>
        </div>
      </div>';
    }
    else {
      $link = \Drupal::service('path.current')->getPath();
      $userLink = "/user/login?destination=" . $link;

      $html = '
      <div class="clearfix hidden-xs">
        <div class="' . $className . '">
          <ul>
	        <li><a href="'. $userLink. '">Login</a></li>
	        <li><a href="/contact">Contact Us</a></li>
	        <li><a class="use-ajax btn btn-rounded ' . $buttonColour. ' small" data-dialog-options="{&quot;width&quot;:800}" data-dialog-type="modal" href="/donation-page">Donate</a></li>
          </ul>
        </div>
      </div>';
    }
    return [
      '#markup' => $html,
      '#cache' => ['contexts' => ['url.path']],
    ];
  }
}