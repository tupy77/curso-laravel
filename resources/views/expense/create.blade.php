@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col">
            <h1>New Expense</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a class="btn btn-secondary" href="/expense_reports/{{ $report->id }}">Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif
            <form action="/expense_reports/{{ $report->id}}/expenses" method="post">
                @csrf
                <div class="form-group">
                    <label for="title">Description:</label>
                    <input type="text" class="form-control" name="description" id="description" placeholder="Type a description" value="{{ old('description') }}">
                </div>
                <div class="form-group">
                    <label for="title">Amount:</label>
                    <input type="text" class="form-control" name="amount" id="amount" placeholder="Type a amount" value="{{ old('amount') }}">
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
    </div>
@endsection
