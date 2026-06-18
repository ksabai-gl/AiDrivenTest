<?php 
namespace Extensions\Debt\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\InvoiceInModel;
use App\Models\InvoiceOutModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class DebtController extends Controller {
    public function index(Request $request){
        if($request->get('lang')) {
            if(in_array($request->get('lang'),['vi','en','ja'])) {
                App::setLocale($request->get('lang'));
            }
        }
        $customerDebt = InvoiceOutModel::select("invoice_outs.*",
            "customers.name as customer_name")
            ->join("orders","orders.id","=","invoice_outs.order_id")
            ->join("customers","customers.id","=","orders.customer_id")
            ->join("stock_outs","stock_outs.invoice_out_id","=","invoice_outs.id")
            ->whereIn('invoice_outs.payment_status',
            ['partial_payment','pending'])
            ->where('stock_outs.status','completed')
            ->where('invoice_outs.business_id',session('debt_business_id'))->paginate(15);
        $supplierDebt = InvoiceInModel::select("invoice_ins.*",
            "suppliers.unit_name as supplier_name")
            ->join("purchases","purchases.id","=","invoice_ins.purchase_id")
            ->join("suppliers","suppliers.id","=","purchases.supplier_id")
            ->join("stock_ins","stock_ins.invoice_in_id","=","invoice_ins.id")
            ->whereIn('invoice_ins.payment_status',
            ['partial_payment','pending'])
            ->where('stock_ins.status','received')
            ->where('stock_ins.business_id',session('debt_business_id'))->paginate(15);
        $Received = InvoiceOutModel::select(
            DB::raw("SUM(invoice_outs.amount_paid) as total_paid")
        )
            ->join("stock_outs","stock_outs.invoice_out_id","=","invoice_outs.id")
            ->where('stock_outs.status','completed')
            ->where('stock_outs.business_id',session('debt_business_id'))->first();
        $OutstandingReceivables = InvoiceOutModel::select(
            DB::raw("SUM(invoice_outs.total - invoice_outs.amount_paid) as total_partial_payment")
        )
            ->join("stock_outs","stock_outs.invoice_out_id","=","invoice_outs.id")
            ->where('stock_outs.status','completed')
            ->where('stock_outs.business_id',session('debt_business_id'))->first();
        $Disbursed = InvoiceInModel::select(
            DB::raw("SUM(invoice_ins.amount_paid) as total_paid")
        )
            ->join("stock_ins","stock_ins.invoice_in_id","=","invoice_ins.id")
            ->where('stock_ins.status','received')
            ->where('stock_ins.business_id',session('debt_business_id'))->first();
        $OutstandingPayables = InvoiceInModel::select(
            DB::raw("SUM(invoice_ins.total - invoice_ins.amount_paid) as total_partial_payment")
        )
            ->join("stock_ins","stock_ins.invoice_in_id","=","invoice_ins.id")
            ->where('stock_ins.status','received')
            ->where('stock_ins.business_id',session('debt_business_id'))->first();
        return view('Debt::index',[
            'customer_debt' => $customerDebt,
            'received' => $Received,
            'outstandingReceivables' => $OutstandingReceivables,
            'disbursed' => $Disbursed,
            'outstandingPayables' => $OutstandingPayables,
            'supplierDebt' => $supplierDebt
        ]);
    }
}