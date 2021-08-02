<?php

namespace Mydevelopersway\Com\Job4;

/*
  $attributeValues = array(
    'color' => array('Red', 'White', 'Blue'),
    'size' => array(1, 2, 3, 4),
    'fabric' => array('Cloth', 'Silk')
  );

  print_r(Cartesian::build($attributeValues));
 */

class Cartesian
{
    public static function build($set)
    {
        if (!$set) {
            return array(array());
        }

        $subset = array_shift($set);
        $cartesianSubset = self::build($set);

        $result = array();
        foreach ($subset as $value) {
            foreach ($cartesianSubset as $p) {
                array_unshift($p, $value);
                $result[] = $p;
            }
        }

        return $result;
    }
}