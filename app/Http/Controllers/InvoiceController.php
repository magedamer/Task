<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::latest()->paginate(5);
        return view('Invoices.index',compact('invoices'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        $products = Product::all();
        return view('Invoices.create', compact(['clients', 'products']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'invoice_number' => 'required|numeric',
            'invoice_date' => 'required|date',
            'client' => 'required',
            'product' => 'required',
            'quantity' => 'required',
            'total' => 'required',
        ]);
        $incoice = new Invoice();
        $incoice->invoice_number = $request-> invoice_number;
        $incoice->invoice_date = $request-> invoice_date;
        $incoice->quantity = $request-> quantity;
        $incoice->total = $request-> total;
        $incoice->client_id  = $request-> client;

        $products_name = json_encode($data['product']);
        $incoice->products_name  = $products_name;
        $incoice->save();

        return redirect()->route('invoices.index')
            ->with('success','Invoice created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')
                ->with('success','Invoice deleted successfully');
    }
}
