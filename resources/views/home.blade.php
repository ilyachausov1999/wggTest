@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        {{ Auth::user()->name }}{{ __(',добро пожаловать,вы вошли!') }}
                        <a class="nav-link" href="/home/create">{{ __('Добавть форму') }}</a>
                        <a class="nav-link" href="/home/view">{{ __('Посмотреть формы') }}</a>
                        <a class="nav-link" href="/home/viewLeads">{{ __('Посмотреть leads') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
