<?php declare(strict_types=1);

namespace HtmlFramework;

use HtmlFramework\Element as HtmlElement;
use HtmlFramework\Packet\HeaderPacket;

/**
 * Each page has a large header with text; this is the element
 * that prints it out.
 *
 * The actual text is created in the Page objects.
 */
class Header extends HtmlElement {
   protected $packet;

   private const FRAMEWORK_FILE = 'header.phtml';

   public static function fromValues(): self {
      $packet = new HeaderPacket();
      return new self($packet);
   }

   public function getHeaderContentHtml(): string {
      $headerTemplatePath = $this->packet->getHeaderTemplate();
      if ($headerTemplatePath) {
         ob_start();
         require $headerTemplatePath;
         $templateHtml = ob_get_contents();
         ob_end_clean();
         return $templateHtml;
      }
   }

   protected function getFrameworkFile(): string {
      return self::FRAMEWORK_FILE;
   }

   private function __construct(HeaderPacket $packet) {
      $this->packet = $packet;
   }
}
