<?php

namespace Tests\Unit;

use Core\CustomerGroup\Domain\Entities\CustomerGroup;
use Tests\TestCase;

class CustomerGroupEntityTest extends TestCase
{
    public function test_from_array_creates_customer_group_entity()
    {
        $data = [
            'id' => 1,
            'business_id' => 1,
            'name' => 'VIP Customers'
        ];

        $customerGroup = CustomerGroup::fromArray($data);

        $this->assertEquals(1, $customerGroup->id);
        $this->assertEquals(1, $customerGroup->business_id);
        $this->assertEquals('VIP Customers', $customerGroup->name);
    }

    public function test_from_array_with_defaults()
    {
        $data = [
            'business_id' => 1,
            'name' => 'Regular Customers'
        ];

        $customerGroup = CustomerGroup::fromArray($data);

        $this->assertNull($customerGroup->id);
        $this->assertEquals(1, $customerGroup->business_id);
        $this->assertEquals('Regular Customers', $customerGroup->name);
    }

    public function test_to_array_converts_entity_to_array()
    {
        $customerGroup = new CustomerGroup(
            business_id: 1,
            name: 'Premium Customers',
            id: 2
        );

        $array = $customerGroup->toArray();

        $expected = [
            'id' => 2,
            'business_id' => 1,
            'name' => 'Premium Customers'
        ];

        $this->assertEquals($expected, $array);
    }
}