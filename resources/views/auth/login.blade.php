@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="row h-100 justify-content-center text-center p-3">
        <div class="col-lg-4 col-md-6">
            <img src="{{ asset('images/logo.png') }}" class="img-fluid" alt="Logo Polhas">

            <h3 class="my-3">SISTEM INFORMASI KEPEGAWAIAN</h3>

            <form action="{{ route('post.login') }}" method="POST">

                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                </div>
    
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
    
                <button type="submit" class="btn btn-primary my-2">
                    Log in
                </button>

            </form>

            <p>
                Lupa Password ?
                <br>
                Hubungi Bagian Kepegawaian
            </p>
        </div>
          
    </div>
@endsection