<?php declare(strict_types=1);

namespace HtmlFramework;

use HtmlFramework\Element as HtmlElement;
use HtmlFramework\Packet\HeadPacket;
use Utils\HtmlUtils;

/**
 * The "head" element is a bit confusing because it's full of things that
 * the browser uses for all sorts of random stuff.
 *
 * It's not seen by the user and goes above the "body" element.
 */
class Head extends HtmlElement {
   private const FRAMEWORK_FILE = 'head.phtml';

   public static function fromValues(string $pageTitle): self {
      $packet = new HeadPacket($pageTitle);
      return new self($packet);
   }

   private function __construct(HeadPacket $packet) {
      $this->packet = $packet;
   }

   protected function getFrameworkFile(): string {
      return self::FRAMEWORK_FILE;
   }

   protected function getTitle(): string {
      return HtmlUtils::makeTitleElement($this->getPacketData('pageTitle'));
   }

   protected function getMeta(): string {
      $metaElData = [
         ['name' => 'robots', 'content' => 'noindex'],
         ['charset' => 'utf8'],
         ['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']
      ];
      $metaEls = [];
      foreach ($metaElData as $mElData) {
         $metaEls[] = HtmlUtils::makeMetaElement($mElData);
      }
      return implode(' ', $metaEls);
   }

   protected function getScripts(): string {
      return HTMLUtils::makeScriptElement(['src' => $this->packet->getJavaScriptPath()]);
   }

   protected function getLinks(): string {
      return implode(' ', array_merge([$this->fontLink()], [$this->cssLink()]));
   }

   private function cssLink(): string {
      return HtmlUtils::makeLinkElement([
         'rel' => 'stylesheet',
         'href' => $this->packet->getStyleSheetPath()
      ]);
   }

   private function fontLink(): string {
      $googleFonts = [
         'Open+Sans:wght@400;700', // Regular and Bold
         'Roboto+Flex:wght@200;400;900',   //
         'Roboto:wght@400;700',   //
      ];
      $gApiData = array_map(fn($fontString) => "family={$fontString}", $googleFonts);
      $gApiData[] = 'display=swap';
      $gLinkUrl = "https://fonts.googleapis.com/css2?" . implode('&', $gApiData);
      return HtmlUtils::makeLinkElement(['rel' => 'stylesheet', 'href' => $gLinkUrl]);
   }
}
