<?php

namespace Tests\Unit;

use Core\Supplier\Domain\Entities\Supplier;
use Tests\TestCase;

class SupplierEntityTest extends TestCase
{
    public function test_from_array_creates_supplier_entity()
    {
        $data = [
            'id' => 1,
            'business_id' => 123,
            'unit_name' => 'Test Supplier',
            'email' => 'supplier@example.com',
            'phone' => '1234567890',
            'address' => '123 Main St',
            'tax_code' => '123456789',
            'bank_name' => 'Test Bank',
            'bank_account' => '1234567890',
            'website' => 'https://example.com',
            'note' => 'Test note',
            'active' => true,
        ];

        $supplier = Supplier::fromArray($data);

        $this->assertEquals(1, $supplier->id);
        $this->assertEquals(123, $supplier->business_id);
        $this->assertEquals('Test Supplier', $supplier->unit_name);
        $this->assertEquals('supplier@example.com', $supplier->email);
        $this->assertEquals('1234567890', $supplier->phone);
        $this->assertEquals('123 Main St', $supplier->address);
        $this->assertEquals('123456789', $supplier->tax_code);
        $this->assertEquals('Test Bank', $supplier->bank_name);
        $this->assertEquals('1234567890', $supplier->bank_account);
        $this->assertEquals('https://example.com', $supplier->website);
        $this->assertEquals('Test note', $supplier->note);
        $this->assertTrue($supplier->active);
    }

    public function test_from_array_with_defaults()
    {
        $data = [
            'business_id' => 123,
            'unit_name' => 'Test Supplier',
        ];

        $supplier = Supplier::fromArray($data);

        $this->assertNull($supplier->id);
        $this->assertEquals(123, $supplier->business_id);
        $this->assertEquals('Test Supplier', $supplier->unit_name);
        $this->assertNull($supplier->email);
        $this->assertNull($supplier->phone);
        $this->assertNull($supplier->address);
        $this->assertNull($supplier->tax_code);
        $this->assertNull($supplier->bank_name);
        $this->assertNull($supplier->bank_account);
        $this->assertNull($supplier->website);
        $this->assertNull($supplier->note);
        $this->assertFalse($supplier->active);
    }

    public function test_to_array_converts_entity_to_array()
    {
        $supplier = Supplier::fromArray([
            'business_id' => 123,
            'unit_name' => 'Test Supplier',
            'email' => 'supplier@example.com',
            'phone' => '1234567890',
            'address' => '123 Main St',
            'tax_code' => '123456789',
            'bank_name' => 'Test Bank',
            'bank_account' => '1234567890',
            'website' => 'https://example.com',
            'note' => 'Test note',
            'active' => true,
        ]);
        $supplier->id = 1;

        $array = $supplier->toArray();

        $expected = [
            'id' => 1,
            'business_id' => 123,
            'unit_name' => 'Test Supplier',
            'email' => 'supplier@example.com',
            'phone' => '1234567890',
            'address' => '123 Main St',
            'tax_code' => '123456789',
            'bank_name' => 'Test Bank',
            'bank_account' => '1234567890',
            'website' => 'https://example.com',
            'note' => 'Test note',
            'active' => true,
        ];

        $this->assertEquals($expected, $array);
    }

    public function test_set_active_sets_active_to_true()
    {
        $supplier = Supplier::fromArray([
            'business_id' => 123,
            'unit_name' => 'Test Supplier',
            'active' => false,
        ]);

        $supplier->setAtive();

        $this->assertTrue($supplier->active);
    }

    public function test_set_de_active_sets_active_to_false()
    {
        $supplier = Supplier::fromArray([
            'business_id' => 123,
            'unit_name' => 'Test Supplier',
            'active' => true,
        ]);

        $supplier->setDeActive();

        $this->assertFalse($supplier->active);
    }
}