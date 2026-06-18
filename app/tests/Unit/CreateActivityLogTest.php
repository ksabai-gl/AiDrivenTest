<?php

namespace Tests\Unit;

use Core\ActivityLog\Application\DTOs\CreateActivityLogRequest;
use Core\ActivityLog\Application\UseCases\CreateActivityLog;
use Core\ActivityLog\Domain\Entities\ActivityLog;
use Core\ActivityLog\Domain\Services\ActivityLogService;
use Tests\TestCase;
use Mockery;

class CreateActivityLogTest extends TestCase
{
    protected $serviceMock;
    protected $useCase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->serviceMock = Mockery::mock(ActivityLogService::class);
        $this->useCase = new CreateActivityLog($this->serviceMock);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_handle_creates_activity_log_successfully()
    {
        $dto = new CreateActivityLogRequest(
            user_id: 1,
            action: 'create',
            description: 'Created a new customer',
            entity_type: 'Customer',
            entity_id: 123,
            business_id: 1
        );

        $activityLog = new ActivityLog(
            user_id: 1,
            action: 'create',
            description: 'Created a new customer',
            entity_type: 'Customer',
            entity_id: 123,
            id: 1,
            business_id: 1
        );

        $this->serviceMock->shouldReceive('create')
            ->with(Mockery::on(function ($arg) {
                return is_array($arg) &&
                       $arg['user_id'] === 1 &&
                       $arg['action'] === 'create' &&
                       $arg['entity_type'] === 'Customer' &&
                       $arg['entity_id'] === 123;
            }))
            ->andReturn($activityLog);

        $result = $this->useCase->handle($dto);

        $this->assertInstanceOf(ActivityLog::class, $result);
        $this->assertEquals(1, $result->id);
        $this->assertEquals('create', $result->action);
        $this->assertEquals('Customer', $result->entity_type);
        $this->assertEquals(123, $result->entity_id);
    }
}