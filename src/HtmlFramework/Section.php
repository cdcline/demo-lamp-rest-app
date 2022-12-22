<?php declare(strict_types=1);

namespace HtmlFramework;

use HtmlFramework\Element as HtmlElement;
use HtmlFramework\Packet\SectionPacket;

/**
 * The "section" houses the nav and acticle and allows the layout
 * to look good on smaller screen using css.
 */
class Section extends HtmlElement {
   private const FRAMEWORK_FILE = 'section.phtml';

   public static function fromValues(string $templatePath): self {
      $packet = new SectionPacket($templatePath);
      return new self($packet);
   }

   private function __construct(SectionPacket $packet) {
      $this->packet = $packet;
   }

   protected function getFrameworkFile(): string {
      return self::FRAMEWORK_FILE;
   }

   protected function printArticle() {
      ob_start();
      require $this->packet->getData('templatePath');
      return ob_get_clean();
   }
}
