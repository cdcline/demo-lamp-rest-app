<?php declare(strict_types=1);

namespace HtmlFramework\Packet;

use HtmlFramework\Packet\PacketTrait;

class HeaderPacket {
   use PacketTrait;

   /**
    * @param $pageTitle - Text put in the meta "title" filed in the Head
    */
   public function __construct(string $pageTitle, string $templatePath) {
      $this->setData('pageTitle', $pageTitle);
      $this->setData('templatePath', $templatePath);
   }

   public function getHeaderTemplate(): string {
      return $this->getData('templatePath');
   }

   public function getPageTitle(): string {
      return $this->getData('pageTitle');
   }
}
