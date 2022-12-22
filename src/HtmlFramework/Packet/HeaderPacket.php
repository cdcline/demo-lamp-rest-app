<?php declare(strict_types=1);

namespace HtmlFramework\Packet;

use HtmlFramework\Packet\PacketTrait;

class HeaderPacket {
   use PacketTrait;

   public function getHeaderTemplate(): string {
      return 'src/templates/dev_header.phtml';
   }
}
