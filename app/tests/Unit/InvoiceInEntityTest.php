<?php

namespace Tests\Unit;

use Core\InvoiceIn\Domain\Entities\InvoiceIn;
use Tests\TestCase;

class InvoiceInEntityTest extends TestCase
{
    public function test_from_array_creates_invoice_in_entity()
    {
        $data = [
            'id' => 1,
            'business_id' => 1,
            'document_no' => 'INV-1001',
            'purchase_id' => 2,
            'user_id' => 3, // approved_by comes from user_id
            'subtotal' => 100.00,
            'tax' => 10.00,
            'discount' => 5.00,
            'total' => 105.00,
            'invoice_date' => '2024-01-15',
            'due_date' => '2024-02-15',
            'approved' => true,
            'payment_status' => 'paid',
            'image' => 'invoice.jpg',
            'amount_paid' => 105.00
        ];

        $invoiceIn = InvoiceIn::fromArray($data);

        $this->assertEquals(1, $invoiceIn->id);
        $this->assertEquals(1, $invoiceIn->business_id);
        $this->assertEquals('INV-1001', $invoiceIn->document_no);
        $this->assertEquals(2, $invoiceIn->purchase_id);
        $this->assertEquals(3, $invoiceIn->approved_by); // comes from user_id
        $this->assertEquals(100.00, $invoiceIn->subtotal);
        $this->assertEquals(10.00, $invoiceIn->tax);
        $this->assertEquals(5.00, $invoiceIn->discount);
        $this->assertEquals(105.00, $invoiceIn->total);
        $this->assertEquals('2024-01-15', $invoiceIn->invoice_date);
        $this->assertEquals('2024-02-15', $invoiceIn->due_date);
        $this->assertTrue($invoiceIn->approved);
        $this->assertEquals('paid', $invoiceIn->payment_status);
        $this->assertEquals('invoice.jpg', $invoiceIn->image);
        $this->assertEquals(105.00, $invoiceIn->amount_paid);
    }

    public function test_from_array_with_defaults()
    {
        $data = [
            'business_id' => 1,
            'purchase_id' => 2
        ];

        $invoiceIn = InvoiceIn::fromArray($data);

        $this->assertNull($invoiceIn->id);
        $this->assertEquals(1, $invoiceIn->business_id);
        $this->assertNull($invoiceIn->document_no);
        $this->assertEquals(2, $invoiceIn->purchase_id);
        $this->assertNull($invoiceIn->approved_by);
        $this->assertEquals(0, $invoiceIn->subtotal);
        $this->assertEquals(0, $invoiceIn->tax);
        $this->assertEquals(0, $invoiceIn->discount);
        $this->assertEquals(0, $invoiceIn->total);
        $this->assertNull($invoiceIn->invoice_date);
        $this->assertNull($invoiceIn->due_date);
        $this->assertFalse($invoiceIn->approved);
        $this->assertEquals('pending', $invoiceIn->payment_status);
        $this->assertNull($invoiceIn->image);
        $this->assertEquals(0, $invoiceIn->amount_paid);
    }

    public function test_to_array_converts_entity_to_array()
    {
        $invoiceIn = new InvoiceIn(
            id: 1,
            business_id: 1,
            document_no: 'INV-1001',
            purchase_id: 2,
            approved_by: 3,
            subtotal: 100.00,
            tax: 10.00,
            discount: 5.00,
            total: 105.00,
            invoice_date: '2024-01-15',
            due_date: '2024-02-15',
            approved: true,
            payment_status: 'paid',
            image: 'invoice.jpg',
            amount_paid: 105.00
        );

        $array = $invoiceIn->toArray();

        $expected = [
            'id' => 1,
            'business_id' => 1,
            'document_no' => 'INV-1001',
            'purchase_id' => 2,
            'approved_by' => 3,
            'subtotal' => 100.00,
            'tax' => 10.00,
            'discount' => 5.00,
            'total' => 105.00,
            'invoice_date' => '2024-01-15',
            'due_date' => '2024-02-15',
            'approved' => true,
            'payment_status' => 'paid',
            'image' => 'invoice.jpg',
            'amount_paid' => 105.00
        ];

        $this->assertEquals($expected, $array);
    }

    public function test_mark_approved_sets_approved_to_true()
    {
        $invoiceIn = new InvoiceIn(
            id: 1,
            business_id: 1,
            document_no: 'INV-1001',
            purchase_id: 2,
            approved_by: null,
            subtotal: 0,
            tax: 0,
            discount: 0,
            total: 0,
            invoice_date: null,
            due_date: null,
            approved: false,
            payment_status: 'pending',
            image: null,
            amount_paid: 0
        );

        $invoiceIn->markApproved();

        $this->assertTrue($invoiceIn->approved);
    }

    public function test_mark_un_approved_sets_approved_to_false()
    {
        $invoiceIn = new InvoiceIn(
            id: 1,
            business_id: 1,
            document_no: 'INV-1001',
            purchase_id: 2,
            approved_by: null,
            subtotal: 0,
            tax: 0,
            discount: 0,
            total: 0,
            invoice_date: null,
            due_date: null,
            approved: true,
            payment_status: 'pending',
            image: null,
            amount_paid: 0
        );

        $invoiceIn->markUnApproved();

        $this->assertFalse($invoiceIn->approved);
    }

    public function test_mark_paid_sets_payment_status_to_paid()
    {
        $invoiceIn = new InvoiceIn(
            id: 1,
            business_id: 1,
            document_no: 'INV-1001',
            purchase_id: 2,
            approved_by: null,
            subtotal: 0,
            tax: 0,
            discount: 0,
            total: 0,
            invoice_date: null,
            due_date: null,
            approved: false,
            payment_status: 'pending',
            image: null,
            amount_paid: 0
        );

        $invoiceIn->markPaid();

        $this->assertEquals('paid', $invoiceIn->payment_status);
    }

    public function test_mark_partial_payment_sets_payment_status_to_partial_payment()
    {
        $invoiceIn = new InvoiceIn(
            id: 1,
            business_id: 1,
            document_no: 'INV-1001',
            purchase_id: 2,
            approved_by: null,
            subtotal: 0,
            tax: 0,
            discount: 0,
            total: 0,
            invoice_date: null,
            due_date: null,
            approved: false,
            payment_status: 'pending',
            image: null,
            amount_paid: 0
        );

        $invoiceIn->markPartialPayment();

        $this->assertEquals('partial_payment', $invoiceIn->payment_status);
    }

    public function test_mark_pending_sets_payment_status_to_pending()
    {
        $invoiceIn = new InvoiceIn(
            id: 1,
            business_id: 1,
            document_no: 'INV-1001',
            purchase_id: 2,
            approved_by: null,
            subtotal: 0,
            tax: 0,
            discount: 0,
            total: 0,
            invoice_date: null,
            due_date: null,
            approved: false,
            payment_status: 'paid',
            image: null,
            amount_paid: 0
        );

        $invoiceIn->markPending();

        $this->assertEquals('pending', $invoiceIn->payment_status);
    }

    public function test_mark_amount_paid_sets_amount_paid_to_total()
    {
        $invoiceIn = new InvoiceIn(
            id: 1,
            business_id: 1,
            document_no: 'INV-1001',
            purchase_id: 2,
            approved_by: null,
            subtotal: 0,
            tax: 0,
            discount: 0,
            total: 105.00,
            invoice_date: null,
            due_date: null,
            approved: false,
            payment_status: 'pending',
            image: null,
            amount_paid: 50.00
        );

        $invoiceIn->markAmountPaid();

        $this->assertEquals(105.00, $invoiceIn->amount_paid);
    }

    public function test_is_paid_returns_true_when_payment_status_is_paid()
    {
        $invoiceIn = new InvoiceIn(
            id: 1,
            business_id: 1,
            document_no: 'INV-1001',
            purchase_id: 2,
            approved_by: null,
            subtotal: 0,
            tax: 0,
            discount: 0,
            total: 0,
            invoice_date: null,
            due_date: null,
            approved: false,
            payment_status: 'paid',
            image: null,
            amount_paid: 0
        );

        $this->assertTrue($invoiceIn->isPaid());
    }

    public function test_is_paid_returns_false_when_payment_status_is_not_paid()
    {
        $invoiceIn = new InvoiceIn(
            id: 1,
            business_id: 1,
            document_no: 'INV-1001',
            purchase_id: 2,
            approved_by: null,
            subtotal: 0,
            tax: 0,
            discount: 0,
            total: 0,
            invoice_date: null,
            due_date: null,
            approved: false,
            payment_status: 'pending',
            image: null,
            amount_paid: 0
        );

        $this->assertFalse($invoiceIn->isPaid());
    }

    public function test_is_partial_payment_returns_true_when_payment_status_is_partial_payment()
    {
        $invoiceIn = new InvoiceIn(
            id: 1,
            business_id: 1,
            document_no: 'INV-1001',
            purchase_id: 2,
            approved_by: null,
            subtotal: 0,
            tax: 0,
            discount: 0,
            total: 0,
            invoice_date: null,
            due_date: null,
            approved: false,
            payment_status: 'partial_payment',
            image: null,
            amount_paid: 0
        );

        $this->assertTrue($invoiceIn->isPartialPayment());
    }

    public function test_is_partial_payment_returns_false_when_payment_status_is_not_partial_payment()
    {
        $invoiceIn = new InvoiceIn(
            id: 1,
            business_id: 1,
            document_no: 'INV-1001',
            purchase_id: 2,
            approved_by: null,
            subtotal: 0,
            tax: 0,
            discount: 0,
            total: 0,
            invoice_date: null,
            due_date: null,
            approved: false,
            payment_status: 'paid',
            image: null,
            amount_paid: 0
        );

        $this->assertFalse($invoiceIn->isPartialPayment());
    }

    public function test_is_pending_returns_true_when_payment_status_is_pending()
    {
        $invoiceIn = new InvoiceIn(
            id: 1,
            business_id: 1,
            document_no: 'INV-1001',
            purchase_id: 2,
            approved_by: null,
            subtotal: 0,
            tax: 0,
            discount: 0,
            total: 0,
            invoice_date: null,
            due_date: null,
            approved: false,
            payment_status: 'pending',
            image: null,
            amount_paid: 0
        );

        $this->assertTrue($invoiceIn->isPending());
    }

    public function test_is_pending_returns_false_when_payment_status_is_not_pending()
    {
        $invoiceIn = new InvoiceIn(
            id: 1,
            business_id: 1,
            document_no: 'INV-1001',
            purchase_id: 2,
            approved_by: null,
            subtotal: 0,
            tax: 0,
            discount: 0,
            total: 0,
            invoice_date: null,
            due_date: null,
            approved: false,
            payment_status: 'paid',
            image: null,
            amount_paid: 0
        );

        $this->assertFalse($invoiceIn->isPending());
    }

    public function test_is_approved_returns_true_when_approved_is_true()
    {
        $invoiceIn = new InvoiceIn(
            id: 1,
            business_id: 1,
            document_no: 'INV-1001',
            purchase_id: 2,
            approved_by: null,
            subtotal: 0,
            tax: 0,
            discount: 0,
            total: 0,
            invoice_date: null,
            due_date: null,
            approved: true,
            payment_status: 'pending',
            image: null,
            amount_paid: 0
        );

        $this->assertTrue($invoiceIn->isApproved());
    }

    public function test_is_approved_returns_false_when_approved_is_false()
    {
        $invoiceIn = new InvoiceIn(
            id: 1,
            business_id: 1,
            document_no: 'INV-1001',
            purchase_id: 2,
            approved_by: null,
            subtotal: 0,
            tax: 0,
            discount: 0,
            total: 0,
            invoice_date: null,
            due_date: null,
            approved: false,
            payment_status: 'pending',
            image: null,
            amount_paid: 0
        );

        $this->assertFalse($invoiceIn->isApproved());
    }

    public function test_make_document_no_generates_document_number()
    {
        $invoiceIn = new InvoiceIn(
            id: 1,
            business_id: 5,
            document_no: null,
            purchase_id: 2,
            approved_by: null,
            subtotal: 0,
            tax: 0,
            discount: 0,
            total: 0,
            invoice_date: null,
            due_date: null,
            approved: false,
            payment_status: 'pending',
            image: null,
            amount_paid: 0
        );

        $invoiceIn->makeDocumentNo();

        $this->assertStringStartsWith('INV-5', $invoiceIn->document_no);
        $this->assertTrue(strpos($invoiceIn->document_no, date('Ymd')) !== false);
    }

    public function test_check_amount_paid_valid_returns_true_for_paid_status()
    {
        $invoiceIn = new InvoiceIn(
            id: 1,
            business_id: 1,
            document_no: 'INV-1001',
            purchase_id: 2,
            approved_by: null,
            subtotal: 0,
            tax: 0,
            discount: 0,
            total: 100.00,
            invoice_date: null,
            due_date: null,
            approved: false,
            payment_status: 'paid',
            image: null,
            amount_paid: 100.00
        );

        $this->assertTrue($invoiceIn->checkAmountPaidValid());
    }

    public function test_check_amount_paid_valid_returns_true_for_pending_status()
    {
        $invoiceIn = new InvoiceIn(
            id: 1,
            business_id: 1,
            document_no: 'INV-1001',
            purchase_id: 2,
            approved_by: null,
            subtotal: 0,
            tax: 0,
            discount: 0,
            total: 100.00,
            invoice_date: null,
            due_date: null,
            approved: false,
            payment_status: 'pending',
            image: null,
            amount_paid: 0.00
        );

        $this->assertTrue($invoiceIn->checkAmountPaidValid());
    }

    public function test_check_amount_paid_valid_returns_true_for_valid_partial_payment()
    {
        $invoiceIn = new InvoiceIn(
            id: 1,
            business_id: 1,
            document_no: 'INV-1001',
            purchase_id: 2,
            approved_by: null,
            subtotal: 0,
            tax: 0,
            discount: 0,
            total: 100.00,
            invoice_date: null,
            due_date: null,
            approved: false,
            payment_status: 'partial_payment',
            image: null,
            amount_paid: 50.00
        );

        $this->assertTrue($invoiceIn->checkAmountPaidValid());
    }

    public function test_check_amount_paid_valid_returns_false_for_partial_payment_with_zero_amount()
    {
        $invoiceIn = new InvoiceIn(
            id: 1,
            business_id: 1,
            document_no: 'INV-1001',
            purchase_id: 2,
            approved_by: null,
            subtotal: 0,
            tax: 0,
            discount: 0,
            total: 100.00,
            invoice_date: null,
            due_date: null,
            approved: false,
            payment_status: 'partial_payment',
            image: null,
            amount_paid: 0.00
        );

        $this->assertFalse($invoiceIn->checkAmountPaidValid());
    }

    public function test_check_amount_paid_valid_returns_false_for_partial_payment_equal_to_total()
    {
        $invoiceIn = new InvoiceIn(
            id: 1,
            business_id: 1,
            document_no: 'INV-1001',
            purchase_id: 2,
            approved_by: null,
            subtotal: 0,
            tax: 0,
            discount: 0,
            total: 100.00,
            invoice_date: null,
            due_date: null,
            approved: false,
            payment_status: 'partial_payment',
            image: null,
            amount_paid: 100.00
        );

        $this->assertFalse($invoiceIn->checkAmountPaidValid());
    }

    public function test_check_amount_paid_valid_returns_false_for_partial_payment_greater_than_total()
    {
        $invoiceIn = new InvoiceIn(
            id: 1,
            business_id: 1,
            document_no: 'INV-1001',
            purchase_id: 2,
            approved_by: null,
            subtotal: 0,
            tax: 0,
            discount: 0,
            total: 100.00,
            invoice_date: null,
            due_date: null,
            approved: false,
            payment_status: 'partial_payment',
            image: null,
            amount_paid: 150.00
        );

        $this->assertFalse($invoiceIn->checkAmountPaidValid());
    }
}