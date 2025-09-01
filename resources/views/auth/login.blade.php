@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0">
                <div class="row g-0">
                    <!-- Partie gauche : image et description centrées -->
                    <div class="col-md-6 d-none d-md-flex flex-column justify-content-center align-items-center bg-light p-4">
                        {{-- <img src="{{ asset('images/company.jpg') }}" class="img-fluid mb-3" style="max-width: 200px; border-radius: 10px;" alt="Company Image"> --}}
                        <i class="bi bi-building" style="font-size: 4rem; color: var(--primary-color);"></i>
                        <h3 class="text-center mb-2">MEES</h3>
                        <p class="text-center">Nous sommes engagés à offrir le meilleur service à nos clients. Connectez-vous pour accéder à votre espace et découvrir nos solutions innovantes.</p>
                    </div>

                    <!-- Partie droite : formulaire -->
                    <div class="col-md-6">
                        <div class="card-body p-5">
                            <h3 class="card-title mb-4 text-center">{{ __('Connexion') }}</h3>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email Floating -->
                                <div class="form-floating mb-3">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>
                                    <label for="email">{{ __('Email Address') }}</label>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Password Floating -->
                                <div class="form-floating mb-3">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                                    <label for="password">{{ __('Password') }}</label>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Remember Me -->
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                                </div>

                                <!-- Bouton login -->
                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                                </div>

                                <!-- Mot de passe oublié -->
                                @if (Route::has('password.request'))
                                    <div class="text-center">
                                        <a href="{{ route('password.request') }}" class="text-decoration-none">{{ __('Forgot Your Password?') }}</a>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div> <!-- fin colonne formulaire -->
                </div> <!-- fin row interne -->
            </div> <!-- fin card -->
        </div>
    </div>
</div>
@endsection
