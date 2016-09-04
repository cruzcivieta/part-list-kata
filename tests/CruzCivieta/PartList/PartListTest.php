<?php


namespace CruzCivieta\PartList;



class PartListTest extends \PHPUnit_Framework_TestCase
{
    public function exceptionDataProvider()
    {
        return [
            [[]],
            [['asdsa']]
        ];
    }
    
    /**
    * @test
    * @expectedException \RuntimeException
    * @dataProvider exceptionDataProvider
    */
    public function given_a_list_with_2_or_lower_elements_throw_an_exception($list)
    {
        $partList = new PartList();

        $partList->execute($list);
    }
    
    /**
    * @test
    */
    public function given_a_valid_list_with_two_elements_then_return_the_equal_list()
    {
        $partList = new PartList();
        $expected = [['prueba', 'valida']];

        $result = $partList->execute(['prueba', 'valida']);

        $this->assertEquals($expected, $result);
    }

    public function dataValidProvider()
    {
        return [
            [['prueba', 'valida', 'elements'], [['prueba', 'valida elements'], ['prueba valida', 'elements']]],
            [['prueba', 'valida', 'elements', 'foo'], [['prueba', 'valida elements foo'], ['prueba valida', 'elements foo'], ['prueba valida elements', 'foo']]],
            [['az', 'toto', 'picaro', 'zone', 'kiwi'], [['az', 'toto picaro zone kiwi'], ['az toto', 'picaro zone kiwi'], ['az toto picaro', 'zone kiwi'], ['az toto picaro zone', 'kiwi']]],
        ];
    }

    /**
     * @test
     * @dataProvider dataValidProvider
     */
    public function given_a_valid_list_of_three_or_more_elements_then_part_list_in_pairs($element, $expected)
    {
        $partList = new PartList();

        $result = $partList->execute($element);

        $this->assertEquals($expected, $result);
    }
}