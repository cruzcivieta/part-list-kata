<?php

namespace CruzCivieta\PartList;


class PartList
{

    const INDEX_CORRECTION = 1;

    public function execute(array $list)
    {
        $this->isValidList($list);

        return $this->doExtract($list);

    }

    /**
     * @param array $list
     * @return array
     */
    public function doExtract(array $list)
    {
        $result = [];
        for ($i = 0; $i < count($list) - self::INDEX_CORRECTION; $i++) {
            $firstElement = $this->extractFirstElementFrom($list, $i);
            $secondElement = $this->extractSecondElementFrom($list, $i);

            $result[] = $this->join($firstElement, $secondElement);
        }

        return $result;
    }

    /**
     * @param array $list
     */
    public function isValidList(array $list)
    {
        if (count($list) < 2) {
            throw new \RuntimeException();
        }
    }

    /**
     * @param array $list
     * @param $i
     * @return array
     */
    public function extractFirstElementFrom(array $list, $i)
    {
        return array_slice($list, 0, $i + self::INDEX_CORRECTION);
    }

    /**
     * @param array $list
     * @param $i
     * @return array
     */
    public function extractSecondElementFrom(array $list, $i)
    {
        return array_slice($list, $i + self::INDEX_CORRECTION);
    }

    /**
     * @param $firstElement
     * @param $secondElement
     * @return array
     */
    public function join($firstElement, $secondElement)
    {
        return [join(' ', $firstElement), join(' ', $secondElement)];
    }
}