<?php

namespace Tests\Unit;

use Core\Shipping\Domain\Entities\Shipping;
use Tests\TestCase;

class ShippingEntityTest extends TestCase
{
    public function test_from_array_creates_shipping_entity()
    {
        $data = [
            'id' => 1,
            'name' => 'Test Shipping',
            'code' => 'TS001',
            'logo' => 'logo.png',
            'active' => true,
            'business_id' => 1
        ];

        $shipping = Shipping::fromArray($data);

        $this->assertEquals(1, $shipping->id);
        $this->assertEquals('Test Shipping', $shipping->name);
        $this->assertEquals('TS001', $shipping->code);
        $this->assertEquals('logo.png', $shipping->logo);
        $this->assertTrue($shipping->active);
        $this->assertEquals(1, $shipping->business_id);
    }

    public function test_from_array_with_defaults()
    {
        $data = [
            'name' => 'Test Shipping',
            'code' => 'TS001',
            'business_id' => 1
        ];

        $shipping = Shipping::fromArray($data);

        $this->assertNull($shipping->id);
        $this->assertEquals('Test Shipping', $shipping->name);
        $this->assertEquals('TS001', $shipping->code);
        $this->assertNull($shipping->logo);
        $this->assertTrue($shipping->active); // default is true in fromArray
        $this->assertEquals(1, $shipping->business_id);
    }

    public function test_to_array_converts_entity_to_array()
    {
        $shipping = new Shipping(
            id: 1,
            name: 'Test Shipping',
            code: 'TS001',
            logo: 'logo.png',
            active: true,
            business_id: 1
        );

        $array = $shipping->toArray();

        $expected = [
            'id' => 1,
            'name' => 'Test Shipping',
            'code' => 'TS001',
            'logo' => 'logo.png',
            'active' => true,
            'business_id' => 1
        ];

        $this->assertEquals($expected, $array);
    }

    public function test_set_active_sets_active_to_true()
    {
        $shipping = new Shipping(
            id: 1,
            name: 'Test Shipping',
            code: 'TS001',
            logo: null,
            active: false,
            business_id: 1
        );

        $shipping->setAtive();

        $this->assertTrue($shipping->active);
    }

    public function test_set_deactive_sets_active_to_false()
    {
        $shipping = new Shipping(
            id: 1,
            name: 'Test Shipping',
            code: 'TS001',
            logo: null,
            active: true,
            business_id: 1
        );

        $shipping->setDeactive();

        $this->assertFalse($shipping->active);
    }
}