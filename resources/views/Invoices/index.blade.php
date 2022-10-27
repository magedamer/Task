@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
        <div class="pull-left">
        <h2>All Invoices</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('invoices.create') }}"> Create New Invoice</a>
        </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
        <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Invoice_number</th>
            <th>Invoice_date</th>
            <th>Quantity</th>
            <th>Total</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($invoices as $invoice)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $invoice->invoice_number }}</td>
            <td>{{ $invoice->invoice_date }}</td>
            <td>{{ $invoice->quantity }}</td>
            <td>{{ $invoice->total }}</td>
            <td>
                <form action="{{ route('invoices.destroy',$invoice->id) }}" method="POST">
                    {{-- <a class="btn btn-info" href="{{ route('products.show',$client->id) }}">Show</a> --}}
                    <a class="btn btn-primary" href="{{ route('invoices.edit',$invoice->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $invoices->links() !!}
</div>
@endsection
