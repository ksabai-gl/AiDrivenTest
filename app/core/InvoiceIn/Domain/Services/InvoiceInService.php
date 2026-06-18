<?php

namespace Core\InvoiceIn\Domain\Services;

use App\Exceptions\BadException;
use Core\InvoiceIn\Domain\Entities\InvoiceIn;

interface InvoiceInService
{
    public function create(array $data): InvoiceIn;
    public function index(array $data) : array;
    public function update(array $data) :InvoiceIn | BadException;
    public function show(array $data) : array | BadException;
    public function getById(array $data) : ?InvoiceIn;
    public function getByPurchaseId(array $data) : ?InvoiceIn;
    public function findById(array $data) : InvoiceIn | BadException;
    public function changeToUnApproved(array $data) :InvoiceIn | BadException; 
}