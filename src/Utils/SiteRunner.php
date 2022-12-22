<?php declare(strict_types=1);

namespace Utils;

use Pages\BasePage;
use Pages\CommentsPage;
use Pages\UsersPage;

class SiteRunner {
   private static $slug;

   public static function runPage(): void {
      $slug = self::getSlugFromUrl();
      $page = self::getPageFromSlug($slug);
      $page->doStuff();
      $page->printHtml();
   }

   public static function getSlugFromUrl(): string {
      if (!is_null(self::$slug)) {
         return self::$slug;
      }
      // Parse it just b/c we might as well
      $urlParts = parse_url($_SERVER['REQUEST_URI']);
      $path = urldecode($urlParts['path']);
      // Lop off the leading "/" from the path
      return self::$slug = substr($path, 1) ?: '';
   }

   private static function getPageFromSlug(string $slug): BasePage {
      switch(strtolower($slug)) {
         case 'users':
            return new UsersPage();
         default:
            return new CommentsPage();
      }
   }
}
