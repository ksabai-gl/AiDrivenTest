<?php

namespace Tests\Unit;

use Core\Business\Domain\Entities\Business;
use Tests\TestCase;

class BusinessEntityTest extends TestCase
{
    public function test_from_array_creates_business_entity()
    {
        $data = [
            'id' => 1,
            'name' => 'Test Business',
            'address' => '123 Main St',
            'tax_code' => '123456789',
            'phone' => '1234567890',
            'email' => 'business@example.com',
            'logo_url' => 'logo.jpg',
            'bank_name' => 'Test Bank',
            'bank_account_number' => '1234567890',
            'bank_account_name' => 'Test Account',
        ];

        $business = Business::fromArray($data);

        $this->assertEquals(1, $business->id);
        $this->assertEquals('Test Business', $business->name);
        $this->assertEquals('123 Main St', $business->address);
        $this->assertEquals('123456789', $business->tax_code);
        $this->assertEquals('1234567890', $business->phone);
        $this->assertEquals('business@example.com', $business->email);
        $this->assertEquals('logo.jpg', $business->logo_url);
        $this->assertEquals('Test Bank', $business->bank_name);
        $this->assertEquals('1234567890', $business->bank_account_number);
        $this->assertEquals('Test Account', $business->bank_account_name);
    }

    public function test_from_array_with_defaults()
    {
        $data = [
            'name' => 'Test Business',
            'address' => '123 Main St',
            'tax_code' => '123456789',
            'phone' => '1234567890',
            'email' => 'business@example.com',
            'bank_name' => 'Test Bank',
            'bank_account_number' => '1234567890',
            'bank_account_name' => 'Test Account',
        ];

        $business = Business::fromArray($data);

        $this->assertNull($business->id);
        $this->assertEquals('Test Business', $business->name);
        $this->assertEquals('123 Main St', $business->address);
        $this->assertEquals('123456789', $business->tax_code);
        $this->assertEquals('1234567890', $business->phone);
        $this->assertEquals('business@example.com', $business->email);
        $this->assertNull($business->logo_url);
        $this->assertEquals('Test Bank', $business->bank_name);
        $this->assertEquals('1234567890', $business->bank_account_number);
        $this->assertEquals('Test Account', $business->bank_account_name);
    }

    public function test_to_array_converts_entity_to_array()
    {
        $business = Business::fromArray([
            'name' => 'Test Business',
            'address' => '123 Main St',
            'tax_code' => '123456789',
            'phone' => '1234567890',
            'email' => 'business@example.com',
            'logo_url' => 'logo.jpg',
            'bank_name' => 'Test Bank',
            'bank_account_number' => '1234567890',
            'bank_account_name' => 'Test Account',
        ]);
        $business->id = 1;

        $array = $business->toArray();

        $expected = [
            'id' => 1,
            'name' => 'Test Business',
            'address' => '123 Main St',
            'tax_code' => '123456789',
            'phone' => '1234567890',
            'email' => 'business@example.com',
            'logo_url' => 'logo.jpg',
            'bank_name' => 'Test Bank',
            'bank_account_number' => '1234567890',
            'bank_account_name' => 'Test Account',
        ];

        $this->assertEquals($expected, $array);
    }
}