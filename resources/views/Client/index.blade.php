@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
        <div class="pull-left">
        <h2>All Clients</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('clients.create') }}"> Create New Client</a>
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
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($clients as $client)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $client->name }}</td>
            <td>{{ $client->email }}</td>
            <td>{{ $client->address }}</td>
            <td>
                <form action="{{ route('clients.destroy',$client->id) }}" method="POST">
                    {{-- <a class="btn btn-info" href="{{ route('products.show',$client->id) }}">Show</a> --}}
                    <a class="btn btn-primary" href="{{ route('clients.edit',$client->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $clients->links() !!}
</div>
@endsection
