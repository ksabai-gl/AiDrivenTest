<?php 
namespace Extensions\InvoiceInPDF\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PurchaseItemModel;
use App\Models\PurchaseModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class InvoiceInPDFController extends Controller {
    public function show(Request $request,string $id) {
        if($request->get('lang')) {
            if(in_array($request->get('lang'),['vi','en','ja'])) {
                App::setLocale($request->get('lang'));
            }
        } 
        $purchase = PurchaseModel::select("purchases.*",
                "invoice_ins.document_no",
                "invoice_ins.invoice_date",
                "invoice_ins.due_date",
                "invoice_ins.payment_status",
                "invoice_ins.amount_paid",
                "invoice_ins.tax",
                "invoice_ins.subtotal",
                "invoice_ins.total",
                "invoice_ins.discount",
                "suppliers.unit_name",
                "suppliers.address",
                "suppliers.email",
                "suppliers.phone",
                "suppliers.tax_code",
                "suppliers.bank_name",
                "suppliers.bank_account")
            ->join("invoice_ins","invoice_ins.purchase_id","=","purchases.id")
            ->join("suppliers","suppliers.id","=","purchases.supplier_id")
            ->where('purchases.id',$id)->first();
        
        if(!$purchase) {
            return abort(404);
        }
        $items = PurchaseItemModel::select("purchase_items.*","products.name")
        ->join("products","products.id","=","purchase_items.product_id")
        ->where('purchase_items.purchase_id',$id)->get();
        return view('InvoiceInPDF::index',[
            'purchase' => $purchase,
            'items'=> $items,
            'lang' => $request->get('lang') ?? 'en'
        ]);
    }
}