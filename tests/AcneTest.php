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

    /**
     * @test
     */
    public function callable_value_should_be_called_as_service_provider()
    {
        $this->acne['object_factory'] = array($this, 'object_factory');
        $this->assertInstanceOf('stdClass', $this->acne['object_factory']);
    }

    /**
     * @test
     */
    public function a_value_returned_by_service_provider_is_not_same()
    {
        $this->acne['object_factory'] = array($this, 'object_factory');
        $a = $this->acne['object_factory'];
        $b = $this->acne['object_factory'];
        $this->assertNotSame($a, $b);
    }

    /**
     * @test
     */
    public function function_name_is_not_a_service_provider()
    {
        $this->acne['string'] = 'array_key_exists';
        $this->assertEquals('array_key_exists', $this->acne['string']);
    }

    public function object_factory()
    {
        return new stdClass;
    }
}
