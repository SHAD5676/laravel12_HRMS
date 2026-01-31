<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice - {{ $invoice->invoice_no }}</title>
    <style>
        body { font-family: 'Arial', sans-serif; color: #333; margin: 0; padding: 30px; }
        .invoice-box { max-width: 800px; margin: auto; border: 1px solid #eee; padding: 30px; border-radius: 10px; }
        .header { text-align: center; margin-bottom: 40px; }
        .row { display: flex; justify-content: space-between; margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        .table th { bg-color: #f8f9fa; }
        .print-btn { background: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; margin-bottom: 20px; }
        
       
        @media print {
            .print-btn { display: none; }
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <button onclick="window.print()" class="print-btn">Print / Save as PDF</button>
        
        <div class="header">
            <h1>PAYROLL INVOICE</h1>
            <p>Date: {{ $invoice->created_at->format('d-m-Y') }}</p>
        </div>

        <div class="row">
            <div>
                <strong>Employee Details:</strong><br>
                Name: {{ $invoice->employee->name ?? 'N/A' }}<br>
                Employee ID: {{ $invoice->employee_id }}
            </div>
            <div>
                <strong>Invoice Info:</strong><br>
                No: #{{ $invoice->invoice_no }}<br>
                Status: <span style="color: green;">{{ $invoice->status }}</span>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Basic Salary / Payroll Payment</td>
                    <td>{{ number_format($invoice->amount, 2) }} TK</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>