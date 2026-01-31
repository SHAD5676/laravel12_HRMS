@extends('layouts.master')

@section('content')
{{-- Main Wrapper: Sidebar er pashe gap rakhar jonno --}}
<div class="relative min-h-screen bg-gray-50/50">
    <div class="p-4 mt-10 md:p-8 lg:ml-4"> {{-- Sidebar theke dure soraiche --}}
        
        <div class="max-w-6xl mx-auto"> {{-- Table ta center e rakhar jonno --}}
            
            <div class="flex items-center justify-between mb-6">
                <h4 class="text-2xl font-bold text-slate-700">Payroll Records</h4>
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1">
                        <li class="text-slate-500">HR</li>
                        <li class="text-slate-500">/</li>
                        <li class="font-medium text-slate-800">Payroll</li>
                    </ol>
                </nav>
            </div>

            {{-- Stylish Card --}}
            <div class="overflow-hidden bg-white border border-slate-200 shadow-sm rounded-xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-4 text-sm font-semibold text-slate-700">Invoice No</th>
                                <th class="px-6 py-4 text-sm font-semibold text-slate-700">Employee</th>
                                <th class="px-6 py-4 text-sm font-semibold text-slate-700 text-center">Amount</th>
                                <th class="px-6 py-4 text-sm font-semibold text-slate-700 text-center">Status</th>
                                <th class="px-6 py-4 text-sm font-semibold text-slate-700 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @forelse($invoices as $invoice)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-slate-900">
                                    <span class="px-2 py-1 bg-blue-50 text-blue-700 rounded-md">#{{ $invoice->invoice_no }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $invoice->employee->name ?? 'User #'.$invoice->employee_id }}
                                </td>
                                <td class="px-6 py-4 text-sm text-center font-bold text-slate-800">
                                    {{ number_format($invoice->amount, 2) }} TK
                                </td>
                                <td class="px-6 py-4 text-sm text-center">
                                    <span class="px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                                        {{ $invoice->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-right">
                                    <a href="{{ route('invoices.download', $invoice->id) }}" class="btn btn-primary shadow-sm" style="background-color: #4e73df; color: white; border: none; padding: 8px 16px; border-radius: 5px; text-decoration: none; font-weight: bold;">
    Download PDF
</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-500 italic">
                                    No records found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection