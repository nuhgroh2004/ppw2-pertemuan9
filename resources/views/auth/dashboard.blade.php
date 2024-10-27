@extends('auth.layouts')

@section('content')
<div class="row justify-content-center text-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @else
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{$message}}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>




@endsection
