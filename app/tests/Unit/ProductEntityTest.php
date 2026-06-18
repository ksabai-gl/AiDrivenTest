<?php

namespace Tests\Unit;

use Core\Product\Domain\Entities\Product;
use Tests\TestCase;

class ProductEntityTest extends TestCase
{
    public function test_from_array_creates_product_entity()
    {
        $data = [
            'id' => 1,
            'business_id' => 123,
            'category_id' => 456,
            'sku' => 'PROD-001',
            'name' => 'Test Product',
            'unit' => 'pcs',
            'description' => 'Test description',
            'image' => 'test.jpg',
            'created_by' => 1,
        ];

        $product = Product::fromArray($data);

        $this->assertEquals(1, $product->id);
        $this->assertEquals(123, $product->business_id);
        $this->assertEquals(456, $product->category_id);
        $this->assertEquals('PROD-001', $product->sku);
        $this->assertEquals('Test Product', $product->name);
        $this->assertEquals('pcs', $product->unit);
        $this->assertEquals('Test description', $product->description);
        $this->assertEquals('test.jpg', $product->image);
        $this->assertEquals(1, $product->created_by);
    }

    public function test_from_array_with_defaults()
    {
        $data = [
            'business_id' => 123,
            'category_id' => 456,
            'sku' => 'PROD-001',
            'name' => 'Test Product',
            'unit' => 'pcs',
            'created_by' => 1,
        ];

        $product = Product::fromArray($data);

        $this->assertNull($product->id);
        $this->assertEquals(123, $product->business_id);
        $this->assertEquals(456, $product->category_id);
        $this->assertEquals('PROD-001', $product->sku);
        $this->assertEquals('Test Product', $product->name);
        $this->assertEquals('pcs', $product->unit);
        $this->assertNull($product->description);
        $this->assertNull($product->image);
        $this->assertEquals(1, $product->created_by);
    }

    public function test_to_array_converts_entity_to_array()
    {
        $product = Product::fromArray([
            'business_id' => 123,
            'category_id' => 456,
            'sku' => 'PROD-001',
            'name' => 'Test Product',
            'unit' => 'pcs',
            'description' => 'Test description',
            'image' => 'test.jpg',
            'created_by' => 1,
        ]);
        $product->id = 1;

        $array = $product->toArray();

        $expected = [
            'id' => 1,
            'business_id' => 123,
            'category_id' => 456,
            'sku' => 'PROD-001',
            'name' => 'Test Product',
            'unit' => 'pcs',
            'description' => 'Test description',
            'image' => 'test.jpg',
            'created_by' => 1,
        ];

        $this->assertEquals($expected, $array);
    }
}