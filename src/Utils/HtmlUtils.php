<?php declare(strict_types=1);

namespace Utils;

class HtmlUtils {
   /**
    * NOTE: These element functions are silly, they're mostly just examples of
   * what you can do. There are better libraries that handle much more complicated
   * cases.
   */
   public static function makeImageElement($imgAttributes): string {
      $elPartStr = self::generateElementPartStr($imgAttributes);
      return "<img {$elPartStr} />";
   }

   public static function makeDivElement(string $text, array $elPartParams = []): string {
      $elPartStr = self::generateElementPartStr($elPartParams);
      return "<div {$elPartStr}>{$text}</div>";
   }

   public static function makeLinkElement(array $elPartParams): string {
      $elPartStr = self::generateElementPartStr($elPartParams);
      return "<link {$elPartStr}>";
   }

   public static function makeWebLinkElement(string $url, string $innerHtml, array $elPartParams = []): string {
      $elPartStr = self::generateElementPartStr($elPartParams);
      return "<a href=\"{$url}\" {$elPartStr}>{$innerHtml}</a>";
   }

   public static function makeScriptElement(array $elPartParams): string {
      $elPartStr = self::generateElementPartStr($elPartParams);
      return "<script {$elPartStr}></script>";
   }

   public static function makeMetaElement(array $elPartParams): string {
      $elPartStr = self::generateElementPartStr($elPartParams);
      return "<meta {$elPartStr}>";
   }

   public static function makeTitleElement(string $title): string {
      return "<title>{$title}</title>";
   }

   public static function makePElement(string $text, array $elPartParams = []): string {
      $elPartStr = self::generateElementPartStr($elPartParams);
      return "<p {$elPartStr}>{$text}</p>";
   }

   public static function makeSpanElement(string $text, array $elPartParams): string {
      $elPartStr = self::generateElementPartStr($elPartParams);
      return "<span {$elPartStr}>{$text}</span>";
   }

   public static function makeH1Element(string $text, string $class): string {
      $elParts = ['class' => $class];
      return self::makeHXElement(1, $text, $elParts);
   }

   public static function makeH3Element(string $text, string $class = null): string {
      $elParts = $class ? ['class' => $class] : [];
      return self::makeHXElement(3, $text, $elParts);
   }

   public static function makeHXElement(int $hx, string $text, array $elPartParams = []): string {
      $elPartStr = self::generateElementPartStr($elPartParams);
      $startTag = "<h{$hx} {$elPartStr}>";
      $endTag = "</h{$hx}>";
      return "{$startTag}{$text}{$endTag}";
   }

   public static function makeTableElement(array $tableData): string {
      $caption = isset($tableData['caption']) ? $tableData['caption'] : '';
      $tableRows = $tableData['rows'];
      $headerRows = $tableData['header'];

      $generateRow = function(array $rowData, bool $isHead = false): string {
         $tCols = [];
         foreach ($rowData as $data) {
            $tCols[] = $isHead ? "<th>{$data}</th>" : "<td>{$data}</td>";
         }
         $tRowData = implode(' ', $tCols);
         return "<tr>{$tRowData}</tr>";
      };

      $headerRow = $generateRow($headerRows, /*isHead*/true);
      $tRows = [$headerRow];
      foreach($tableRows as $tableRow) {
         $tRows[] = $generateRow($tableRow);
      }
      $tRowsStr = implode(' ', $tRows);
      $captionStr = $caption ? "<caption>{$caption}</caption>" : '';
      return "<table>{$captionStr}{$tRowsStr}</table>";
   }

   private static function generateElementPartStr(array $elParams): string {
      $elParts = [];
      foreach($elParams as $name => $value) {
         if ($value) {
            $elParts[] = "{$name}=\"{$value}\"";
         }
      }
      return implode(' ', $elParts);
   }
}
