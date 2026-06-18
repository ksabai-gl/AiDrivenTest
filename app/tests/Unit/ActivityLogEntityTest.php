<?php

namespace Tests\Unit;

use Core\ActivityLog\Domain\Entities\ActivityLog;
use Tests\TestCase;

class ActivityLogEntityTest extends TestCase
{
    public function test_from_array_creates_activity_log_entity()
    {
        $data = [
            'id' => 1,
            'user_id' => 1,
            'action' => 'create',
            'description' => 'Created a new customer',
            'entity_type' => 'Customer',
            'entity_id' => 123,
            'business_id' => 1
        ];

        $activityLog = ActivityLog::fromArray($data);

        $this->assertEquals(1, $activityLog->user_id);
        $this->assertEquals('create', $activityLog->action);
        $this->assertEquals('Created a new customer', $activityLog->description);
        $this->assertEquals('Customer', $activityLog->entity_type);
        $this->assertEquals(123, $activityLog->entity_id);
        $this->assertEquals(1, $activityLog->id);
        $this->assertEquals(1, $activityLog->business_id);
    }

    public function test_from_array_with_defaults()
    {
        $data = [
            'user_id' => 1,
            'action' => 'update',
            'description' => 'Updated product information',
            'entity_type' => 'Product',
            'entity_id' => 456,
            'business_id' => 1
        ];

        $activityLog = ActivityLog::fromArray($data);

        $this->assertEquals(1, $activityLog->user_id);
        $this->assertEquals('update', $activityLog->action);
        $this->assertEquals('Updated product information', $activityLog->description);
        $this->assertEquals('Product', $activityLog->entity_type);
        $this->assertEquals(456, $activityLog->entity_id);
        $this->assertNull($activityLog->id);
        $this->assertEquals(1, $activityLog->business_id);
    }

    public function test_to_array_converts_entity_to_array()
    {
        $activityLog = new ActivityLog(
            user_id: 1,
            action: 'delete',
            description: 'Deleted warehouse',
            entity_type: 'Warehouse',
            entity_id: 789,
            id: 2,
            business_id: 1
        );

        $array = $activityLog->toArray();

        $expected = [
            'id' => 2,
            'user_id' => 1,
            'action' => 'delete',
            'description' => 'Deleted warehouse',
            'entity_type' => 'Warehouse',
            'entity_id' => 789,
            'business_id' => 1
        ];

        $this->assertEquals($expected, $array);
    }
}