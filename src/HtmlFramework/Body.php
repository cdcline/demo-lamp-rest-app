<?php declare(strict_types=1);

namespace HtmlFramework;

use HtmlFramework\Element as HtmlElement;
use HtmlFramework\Header as PageHeader;
use HtmlFramework\Packet\BodyPacket;
use HtmlFramework\Section as PageSection;

/**
 * The "Body" is the section of html that holds most of the stuff the user will
 * see.
 *
 * It's basically everything but the "head" element used by browsers for browser
 * things.
 */

class Body extends HtmlElement {
   private const FRAMEWORK_FILE = 'body.phtml';

   public static function fromValues(PageHeader $header, PageSection $section): self {
      $packet = new BodyPacket($header, $section);
      return new self($packet);
   }

   private function __construct(BodyPacket $packet) {
      $this->packet = $packet;
   }

   protected function printHeader(): void {
      $this->packet->printHeaderHtml();
   }

   protected function printSection(): void {
      $this->packet->printSectionHtml();
   }

   protected function printPageFooter(): void {
      $this->packet->printPageFooter();
   }

   protected function getFrameworkFile(): string {
      return self::FRAMEWORK_FILE;
   }
}
