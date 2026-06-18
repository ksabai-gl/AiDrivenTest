<?php

namespace Tests\Unit;

use Core\Purchase\Domain\Entities\Purchase;
use Tests\TestCase;

class PurchaseEntityTest extends TestCase
{
    public function test_from_array_creates_purchase_entity()
    {
        $data = [
            'id' => 1,
            'business_id' => 1,
            'supplier_id' => 2,
            'created_by' => 3,
            'approved_by' => 4,
            'purchase_date' => '2024-01-15',
            'expected_date' => '2024-01-20',
            'note' => 'Test purchase note',
            'status' => 'approved',
            'shipping_fee' => 50.00,
            'payment_method' => 'cash'
        ];

        $purchase = Purchase::fromArray($data);

        $this->assertEquals(1, $purchase->id);
        $this->assertEquals(1, $purchase->business_id);
        $this->assertEquals(2, $purchase->supplier_id);
        $this->assertEquals(3, $purchase->created_by);
        $this->assertEquals(4, $purchase->approved_by);
        $this->assertEquals('2024-01-15', $purchase->purchase_date);
        $this->assertEquals('2024-01-20', $purchase->expected_date);
        $this->assertEquals('Test purchase note', $purchase->note);
        $this->assertEquals('approved', $purchase->status);
        $this->assertEquals(50.00, $purchase->shipping_fee);
        $this->assertEquals('cash', $purchase->payment_method);
    }

    public function test_from_array_with_defaults()
    {
        $data = [
            'business_id' => 1,
            'purchase_date' => '',
            'expected_date' => ''
        ];

        $purchase = Purchase::fromArray($data);

        $this->assertNull($purchase->id);
        $this->assertEquals(1, $purchase->business_id);
        $this->assertNull($purchase->supplier_id);
        $this->assertNull($purchase->created_by);
        $this->assertNull($purchase->approved_by);
        $this->assertEquals(date('Y-m-d'), $purchase->purchase_date); // Empty string parses to today
        $this->assertEquals(date('Y-m-d'), $purchase->expected_date); // Empty string parses to today
        $this->assertNull($purchase->note);
        $this->assertEquals('draft', $purchase->status);
        $this->assertEquals(0, $purchase->shipping_fee);
        $this->assertNull($purchase->payment_method);
    }

    public function test_to_array_converts_entity_to_array()
    {
        $purchase = new Purchase(
            business_id: 1,
            supplier_id: 2,
            created_by: 3,
            approved_by: 4,
            purchase_date: '2024-01-15',
            expected_date: '2024-01-20',
            note: 'Test note',
            shipping_fee: 25.50,
            payment_method: 'credit_card'
        );
        $purchase->id = 5;
        $purchase->status = 'requested';

        $array = $purchase->toArray();

        $expected = [
            'id' => 5,
            'business_id' => 1,
            'supplier_id' => 2,
            'created_by' => 3,
            'approved_by' => 4,
            'purchase_date' => '2024-01-15',
            'expected_date' => '2024-01-20',
            'note' => 'Test note',
            'status' => 'requested',
            'shipping_fee' => 25.50,
            'payment_method' => 'credit_card'
        ];

        $this->assertEquals($expected, $array);
    }

    public function test_set_draft_sets_status_to_draft()
    {
        $purchase = new Purchase(business_id: 1);
        $purchase->status = 'approved';

        $purchase->setDraft();

        $this->assertEquals('draft', $purchase->status);
    }

    public function test_set_requested_sets_status_to_requested()
    {
        $purchase = new Purchase(business_id: 1);

        $purchase->setRequested();

        $this->assertEquals('requested', $purchase->status);
    }

    public function test_set_approved_sets_status_to_approved()
    {
        $purchase = new Purchase(business_id: 1);

        $purchase->setApproved();

        $this->assertEquals('approved', $purchase->status);
    }

    public function test_set_cancelled_sets_status_to_cancelled()
    {
        $purchase = new Purchase(business_id: 1);

        $purchase->setCancelled();

        $this->assertEquals('cancelled', $purchase->status);
    }

    public function test_is_draft_returns_true_when_status_is_draft()
    {
        $purchase = new Purchase(business_id: 1);
        $purchase->status = 'draft';

        $this->assertTrue($purchase->isDraft());
    }

    public function test_is_draft_returns_false_when_status_is_not_draft()
    {
        $purchase = new Purchase(business_id: 1);
        $purchase->status = 'approved';

        $this->assertFalse($purchase->isDraft());
    }

    public function test_is_requested_returns_true_when_status_is_requested()
    {
        $purchase = new Purchase(business_id: 1);
        $purchase->status = 'requested';

        $this->assertTrue($purchase->isRequested());
    }

    public function test_is_requested_returns_false_when_status_is_not_requested()
    {
        $purchase = new Purchase(business_id: 1);
        $purchase->status = 'approved';

        $this->assertFalse($purchase->isRequested());
    }

    public function test_is_approved_returns_true_when_status_is_approved()
    {
        $purchase = new Purchase(business_id: 1);
        $purchase->status = 'approved';

        $this->assertTrue($purchase->isApproved());
    }

    public function test_is_approved_returns_false_when_status_is_not_approved()
    {
        $purchase = new Purchase(business_id: 1);
        $purchase->status = 'draft';

        $this->assertFalse($purchase->isApproved());
    }

    public function test_is_cancelled_returns_true_when_status_is_cancelled()
    {
        $purchase = new Purchase(business_id: 1);
        $purchase->status = 'cancelled';

        $this->assertTrue($purchase->isCancelled());
    }

    public function test_is_cancelled_returns_false_when_status_is_not_cancelled()
    {
        $purchase = new Purchase(business_id: 1);
        $purchase->status = 'draft';

        $this->assertFalse($purchase->isCancelled());
    }

    public function test_get_status_returns_current_status()
    {
        $purchase = new Purchase(business_id: 1);
        $purchase->status = 'approved';

        $this->assertEquals('approved', $purchase->getStatus());
    }

    public function test_make_purchase_returns_self()
    {
        $purchase = new Purchase(business_id: 1);

        $result = $purchase->makePurchase();

        $this->assertSame($purchase, $result);
    }
}