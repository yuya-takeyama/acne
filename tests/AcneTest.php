<?php
require_once 'Acne.php';

class AcneTest extends PHPUnit_Framework_TestCase
{
    private $acne;

    public function setUp()
    {
        $this->acne = new Acne;
    }

    /**
     * @test
     */
    public function a_value_should_be_set_with_array_access_operator()
    {
        $this->acne['key'] = 'value';
        $this->assertEquals('value', $this->acne['key']);
    }

    /**
     * @test
     */
    public function an_object_set_into_container_is_shared()
    {
        $object = new stdClass;
        $this->acne['key'] = $object;
        $this->assertSame($object, $this->acne['key']);
    }
}
