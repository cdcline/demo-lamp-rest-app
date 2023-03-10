<?php declare(strict_types=1);

namespace HtmlFramework\Packet;

use HtmlFramework\Header as PageHeader;
use HtmlFramework\Section as PageSection;
use HtmlFramework\Packet\PacketTrait;

class BodyPacket {
   use PacketTrait;

   private $pHeader;
   private $pSection;
   private $pFooter;

   public function __construct(PageHeader $header, PageSection $section) {
      $this->pHeader = $header;
      $this->pSection = $section;
   }

   public function printHeaderHtml(): void {
      $this->pHeader->printHtml();
   }

   public function printSectionHtml(): void {
      $this->pSection->printHtml();
   }

   public function printPageFooter(): void {
      $this->pFooter->printPageFooter();
   }

   public function printMobileFooter(): void {
      $this->pFooter->printMobileFooter();
   }
}
