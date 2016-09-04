<?php

namespace CruzCivieta\PartList;


class PartList
{

    public function execute(array $list)
    {
        if (count($list) < 2) {
            throw new \RuntimeException();
        }

        if (count($list) === 2) {
            return [$list];
        }

        if (count($list) > 2) {
            $result = [];
            for ($i = 0; $i < count($list) - 1; $i++) {
                $firstElement = array_slice($list, 0, $i + 1);
                $secondElement = array_slice($list, $i + 1);

                $result[] = [join(' ', $firstElement), join(' ', $secondElement)];
            }

            return $result;
        }

    }
}