<?php

class UtilsArray
{

    public static function getDataInMultidimensionalArrayBySpecificKey($array, $key)
    {
        return array_map(function ($array) use ($key) {
            return $array[$key];
        }, $array);
    }

    /**
     * Un Tableau à deux dimensions, une clé de tableau, une valeur,
     * et cette solution magique vous renvoie la clé du tableau si elle existe.
     * 
     * @param $valueYouWannaFind
     * @param array $tableToCheckIn
     * @param string $indexOfTheTable
     * 
     * @return
     */
    public static function searchASpecificValueInAnArrayWithTwoDimensions($valueYouWannaFind, array $tableToCheckIn, string $indexOfTheTable)
    {
        return array_search($valueYouWannaFind, array_column($tableToCheckIn, $indexOfTheTable));
    }

    /**
     * Un Tableau à deux dimensions, une clé de tableau, une valeur,
     * et cette solution magique vous renvoie la clé du tableau si elle existe.
     * 
     * @param $valueYouWannaFind
     * @param array $tableToCheckIn
     * @param string $indexOfTheTable
     * 
     * @return
     */
    public static function searchIfASpecificValueExistInAnArray($valueYouWannaFind, array $tableToCheckIn, string $indexOfTheTable)
    {
        $key = UtilsArray::searchASpecificValueInAnArrayWithTwoDimensions($valueYouWannaFind, $tableToCheckIn, $indexOfTheTable);
        return is_int($key);
    }
    /**
     * 
     * 
     * @param $valueYouWannaFind
     * @param array $arrayToFilter
     * 
     * @return
     */
    public static function removeDuplicateElementsFromArray($arrayToFilter)
    {
        $arrayFiltered = array();
        foreach ($arrayToFilter as $element) {
            $arrayFiltered[serialize($element)] = $element;
        }
        return array_values($arrayFiltered);
    }

    /**
     * Usefull to clean blank rows on SQL return, and prevent front to bug
     * @param array $array
     */
    public static function cleanArray($array)
    {
        return array_values(array_filter($array, function ($item) {
            return (isset($item));
        }));
    }

    /**
     * Let you intval value of a determined field
     * @param array $array
     * @param string $fieldToIntify
     */
    public static function intifyFieldInArray($array, $fieldToIntify)
    {
        foreach ($array as $key => $element) {
            $element[$fieldToIntify] = intval($element[$fieldToIntify]);
            $array[$key] = $element;
        }
        return $array;
    }

    /**
     * Let you add field in array, usefull for some backend requests
     * @param array $array
     * @param string $fieldToIntify
     * @param $value
     */
    public static function addFieldInArray($array, $field, $value)
    {
        foreach ($array as $key => $element) {
            $element[$field] = $value;
            $array[$key] = $element;
        }
        return $array;
    }

    /**
     * Let you set a value of a field as null, usefull for some backend requests
     * @param array $array
     * @param string $field
     */
    public static function nullifyFieldInArray($array, $field)
    {
        foreach ($array as $key => $element) {
            $element[$field] = null;
            $array[$key] = $element;
        }
        return $array;
    }

    /**
     * Let you remove a field from an array
     * @param array $array
     * @param string $field
     */
    public static function unsetFieldInArray($array, $field)
    {
        foreach ($array as $key => $element) {
            unset($element[$field]);
            $array[$key] = $element;
        }
        return $array;
    }
}
