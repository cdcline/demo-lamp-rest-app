<?php declare(strict_types=1);

namespace HtmlFramework\Packet;

use DB\UserComment;
use HtmlFramework\Packet\PacketTrait;

class SectionPacket {
   use PacketTrait;

   public function __construct(string $templatePath) {
      $this->setData('templatePath', $templatePath);
   }

   public function getAllComments(): array {
      return UserComment::fetchAllComments();
   }
}
