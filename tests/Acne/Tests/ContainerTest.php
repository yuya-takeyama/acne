<?php
require_once 'Acne.php';

class Acne_Tests_ContainerTest extends PHPUnit_Framework_TestCase
{
    private $acne;

    public function setUp()
    {
        $this->container = new Acne_Container;
    }

    /**
     * @test
     */
    public function a_value_should_be_set_with_array_access_operator()
    {
        $this->container['key'] = 'value';
        $this->assertEquals('value', $this->container['key']);
    }

    /**
     * @test
     */
    public function isset_should_be_true_if_a_value_is_set()
    {
        $this->container['key'] = 'value';
        $this->assertTrue(isset($this->container['key']));
    }

    /**
     * @test
     */
    public function isset_should_be_true_if_NULL_is_set()
    {
        $this->container['key'] = NULL;
        $this->assertTrue(isset($this->container['key']));
    }

    /**
     * @test
     */
    public function isset_should_be_false_if_no_value_is_set()
    {
        $this->assertFalse(isset($this->container['key']));
    }

    /**
     * @test
     */
    public function unset_should_remove_a_value()
    {
        $this->container['key'] = 'value';
        unset($this->container['key']);
        $this->assertFalse(isset($this->container['key']));
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function InvalidArgumentException_should_be_thrown_if_a_key_is_not_set_is_specified()
    {
        $foo = $this->container['key_is_not_set'];
    }

    /**
     * @test
     */
    public function an_object_set_into_container_is_shared()
    {
        $object = new stdClass;
        $this->container['key'] = $object;
        $this->assertSame($object, $this->container['key']);
    }

    /**
     * @test
     */
    public function callable_value_should_be_called_as_service_provider()
    {
        $this->container['object_factory'] = array($this, 'object_factory');
        $this->assertInstanceOf('stdClass', $this->container['object_factory']);
    }

    /**
     * @test
     */
    public function a_value_returned_by_service_provider_is_not_same()
    {
        $this->container['object_factory'] = array($this, 'object_factory');
        $a = $this->container['object_factory'];
        $b = $this->container['object_factory'];
        $this->assertNotSame($a, $b);
    }

    /**
     * @test
     */
    public function function_name_is_not_a_service_provider()
    {
        $this->container['string'] = 'array_key_exists';
        $this->assertEquals('array_key_exists', $this->container['string']);
    }

    /**
     * @test
     */
    public function a_value_returned_by_shared_service_provider_is_same()
    {
        $this->container['object_factory'] = $this->container->share(array($this, 'object_factory'));
        $a = $this->container['object_factory'];
        $b = $this->container['object_factory'];
        $this->assertInstanceOf('stdClass', $b);
        $this->assertSame($a, $b);
    }

    /**
     * @test
     */
    public function shared_service_provider_is_set_if_share_is_called_with_key()
    {
        $this->container->share('object_factory', array($this, 'object_factory'));
        $a = $this->container['object_factory'];
        $b = $this->container['object_factory'];
        $this->assertInstanceOf('stdClass', $b);
        $this->assertSame($a, $b);
    }

    /**
     * @test
     */
    public function service_provider_is_passed_container_as_its_argument()
    {
        $this->container['foo'] = 'Foo Value';
        $this->container['object_factory'] = array($this, 'object_factory');
        $this->assertEquals('Foo Value', $this->container['object_factory']->foo);
    }

    public function object_factory($c)
    {
        $object = new stdClass;
        if (isset($c['foo'])) {
            $object->foo = $c['foo'];
        }
        return $object;
    }
}
