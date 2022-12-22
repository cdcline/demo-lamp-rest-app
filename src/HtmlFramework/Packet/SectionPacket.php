<?php declare(strict_types=1);

namespace HtmlFramework\Packet;

use HtmlFramework\Packet\PacketTrait;
use Utils\DBUtils;

class SectionPacket {
   use PacketTrait;

   public function __construct(string $templatePath) {
      $this->setData('templatePath', $templatePath);
   }

   public function getAllComments(): array {
      return DBUtils::fetchUserComments();
   }
}
