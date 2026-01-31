<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Employee;


class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('employee')->get();
        return view('hr.payroll.index', compact('invoices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'amount' => 'required|numeric',
        ]);

        Invoice::create([
            'employee_id' => $request->employee_id,
            'invoice_no'  => 'INV-' . strtoupper(uniqid()),
            'amount'      => $request->amount,
            'status'      => 'Paid',
        ]);

        return back()->with('success', 'Payroll Generated Successfully!');
    }


    public function downloadPDF($id)
{
    $invoice = Invoice::with('employee')->findOrFail($id);
   
    return view('invoices.pdf_template', compact('invoice'));
}
}