@extends('layouts.app')

@section('breadcrumbs', '')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Hello World</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Your site best!
                </div>
            </div>
        </div>
    </div>

@endsection
