<?php

/**
 * @file
 * Contains Controller for \Drupal\axelerant_test\Controller\AxelerantController.
 */

namespace Drupal\axelerant_test\Controller;

use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Implements Controller Class AxelerantController.
 */
class AxelerantController {

  /**
   * 
   * @param String $site_api_key
   * @param NodeInterface $node
   *
   * @return JsonResponse
   */
  public function jsonContent($site_api_key, NodeInterface $node) {
    // Site API Key configuration value
    $siteApiKeyValue = \Drupal::config('axelerant_test.configuration')->get('siteapikey');

    // Return JSON only for page content type with valid site api key.
    if ($node->getType() == 'page' && $siteApiKeyValue != 'No API Key yet' && $siteApiKeyValue == $site_api_key) {
      return new JsonResponse($node->toArray(), 200, ['Content-Type' => 'application/json']);
    }

    // Return access denied if site api key is wrong.
    return new JsonResponse(array("error" => "access denied"), 401, ['Content-Type' => 'application/json']);
  }

}
