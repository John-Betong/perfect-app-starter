<?php declare(strict_types=1);

namespace PerfectApp\Debug;

/**
 * Class HTMLVarDumper
 * @package PerfectApp\Debug
 */
class HTMLVarDumper
{
    /**
     * @param array $data
     */
    final public function dump(array $data): void
    {
        $style = 'width:88%; margin:1em auto;
                  color: RED; font-weight: bold;;
                 ';
        # echo '<span style="color:red;font-weight:bold">';
        echo "<div style='$style'>";
          foreach ($data as $k => $v)
          {
            foreach ($v as $k2 => $v2)
            {
              if ($k2)
              {
                echo $k . '<pre>', print_r($v2, true), '</pre>';
              }
            }
          }
        echo '</div>';
        # echo '</span>';
    }
}
