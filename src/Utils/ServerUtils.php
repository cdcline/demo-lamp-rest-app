<?php declare(strict_types=1);

namespace Utils;

class ServerUtils {
   public static function reloadPage() {
      header('refresh: 0');
      exit;
   }
}
