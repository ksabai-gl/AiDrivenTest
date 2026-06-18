<?php

namespace Tests\Unit;

use Core\Warehouse\Domain\Entities\Warehouse;
use Tests\TestCase;

class WarehouseEntityTest extends TestCase
{
    public function test_from_array_creates_warehouse_entity()
    {
        $data = [
            'id' => 1,
            'name' => 'Main Warehouse',
            'address' => '123 Main St',
            'business_id' => 123,
            'active' => true,
            'created_by' => 1,
        ];

        $warehouse = Warehouse::fromArray($data);

        $this->assertEquals(1, $warehouse->id);
        $this->assertEquals('Main Warehouse', $warehouse->name);
        $this->assertEquals('123 Main St', $warehouse->address);
        $this->assertEquals(123, $warehouse->business_id);
        $this->assertTrue($warehouse->active);
        $this->assertEquals(1, $warehouse->created_by);
    }

    public function test_from_array_with_defaults()
    {
        $data = [
            'name' => 'Main Warehouse',
            'address' => '123 Main St',
            'business_id' => 123,
            'created_by' => 1,
        ];

        $warehouse = Warehouse::fromArray($data);

        $this->assertNull($warehouse->id);
        $this->assertEquals('Main Warehouse', $warehouse->name);
        $this->assertEquals('123 Main St', $warehouse->address);
        $this->assertEquals(123, $warehouse->business_id);
        $this->assertTrue($warehouse->active);
        $this->assertEquals(1, $warehouse->created_by);
    }

    public function test_to_array_converts_entity_to_array()
    {
        $warehouse = new Warehouse(
            id: 1,
            name: 'Main Warehouse',
            address: '123 Main St',
            business_id: 123,
            active: true,
            created_by: 1
        );

        $array = $warehouse->toArray();

        $expected = [
            'id' => 1,
            'name' => 'Main Warehouse',
            'address' => '123 Main St',
            'business_id' => 123,
            'active' => true,
            'created_by' => 1,
        ];

        $this->assertEquals($expected, $array);
    }

    public function test_set_active_sets_active_to_true()
    {
        $warehouse = Warehouse::fromArray([
            'name' => 'Main Warehouse',
            'address' => '123 Main St',
            'business_id' => 123,
            'active' => false,
            'created_by' => 1
        ]);

        $warehouse->setActive();

        $this->assertTrue($warehouse->active);
    }

    public function test_set_de_active_sets_active_to_false()
    {
        $warehouse = Warehouse::fromArray([
            'name' => 'Main Warehouse',
            'address' => '123 Main St',
            'business_id' => 123,
            'active' => true,
            'created_by' => 1
        ]);

        $warehouse->setDeActive();

        $this->assertFalse($warehouse->active);
    }
}