@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Invoice</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('invoices.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('invoices.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Invoice_number:</strong>
                    <input type="number" name="invoice_number" class="form-control" placeholder="Invoice_number">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Invoice_date:</strong>
                    <input type="date" name="invoice_date" value="{{ date('Y-m-d') }}" class="form-control" placeholder="Invoice_date">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Client:</strong><br>
                    <select class="form-select form-select-lg mb-3" name="client">
                        <option value="">--choose a client--</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client-> id }}">{{ $client-> name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Product:</strong><br>
                    <select class="form-select form-select-lg mb-3" size="3" multiple  name="product[]" onclick="console.log($(this).val())" onchange="console.log('change is firing')">
                        <option value="">--choose a product--</option>
                        @foreach ($products as $product)
                            <option value="{{ $product-> id }}">{{ $product-> name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Product Quantity:</strong>
                    <input type="number" id="quantity" name="quantity" class="form-control" placeholder="Quantity" onchange="myFunction()">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Total:</strong>
                    <input type="number" id="total" name="total" class="form-control" placeholder="Total" readonly>
                </div>
            </div>
            {{-- my div --}}
            <div style="display:none;" id="callprice">
                <input id="price" type="text">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script>
    // get price for products
    $(document).ready(function() {
        $('select[name="product[]"]').on('change', function() {
            var productId = $(this).val();
            // console.log(productId)
            if (productId)
            {
                // var selectArr = [];
                // $('select[name="product[]"]').each(function() {
                //     selectArr.push($(this).val());
                // });
                // console.log(selectArr)
                $.ajax({
                    url: "{{ URL::to('products') }}/" + productId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        // $('#callprice').show();
                        $('#price').val(data.price);
                        // console.log(data.price);
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>
<script>
    function myFunction()
    {
        var quantity = parseFloat(document.getElementById("quantity").value);
        var price  = parseFloat(document.getElementById("price").value);

        // console.log(price);

        if (typeof quantity === 'undefined' || !quantity)
        {
            alert('يرجي ادخال مبلغ العمولة ');
        } else {
            var total = quantity * price;
            sum = parseFloat(total).toFixed(2);
            document.getElementById("total").value = sum;
        }
    }
</script>
@endsection
