<!--begin::Authentication - Sign-in -->
@php
    $style = 'style=background-image:url(' . asset('assets/img/progress-hd.png') . ')';
    $settingValue = getSuperAdminSettingValue();
    App::setLocale(checkLanguageSession());

@endphp
@extends('layouts.auth_app')

@section('title')
    {{ __('auth.login.login') }}
@endsection
@section('content')


    {{--    <ul class="nav nav-pills" style="justify-content: flex-end; cursor: pointer"> --}}
    {{--        <li class="nav-item dropdown"> --}}
    {{--            <a class="btn btn-primary w-150px mb-5 indicator m-3" --}}
    {{--               data-bs-toggle="dropdown" href="javascript:void(0)" role="button" --}}
    {{--               aria-expanded="false">{{ getCurrentLanguageName() }}</a> --}}
    {{--            <ul class="dropdown-menu w-150px"> --}}
    {{--                @foreach (getLanguages() as $key => $value) --}}
    {{--                    <li class="{{(checkLanguageSession() == $key) ? 'active' : '' }}"><a --}}
    {{--                                class="dropdown-item  px-5 language-select {{(checkLanguageSession() == $key) ? 'bg-primary text-white' : 'text-dark' }}" --}}
    {{--                                data-id="{{$key}}">{{$value}}</a> --}}
    {{--                    </li> --}}
    {{--                @endforeach --}}
    {{--            </ul> --}}
    {{--        </li> --}}
    {{--    </ul> --}}

    <ul class="nav nav-pills language-option" style="justify-content: flex-end; cursor: pointer">
        <li class="nav-item dropdown m-5">
            <a class="btn btn-primary w-150px mb-5 indicator m-3 dropdown-toggle" data-bs-toggle="dropdown"
                href="javascript:void(0)" role="button" aria-expanded="false">{{ getCurrentLanguageName() }}</a>
            <ul class="dropdown-menu w-150px">
                @foreach (getLanguages() as $key => $value)
                    <li class="{{ checkLanguageSession() == $key ? 'active' : '' }}"><a
                            class="dropdown-item  px-5 language-select {{ checkLanguageSession() == $key ? 'bg-primary text-white' : 'text-dark' }}"
                            data-id="{{ $key }}">{{ $value }}</a>
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>

    <div class="d-flex flex-column flex-column-fluid align-items-center justify-content-center p-4">
        <div class="col-12 text-center">
            <a href="{{ route('landing-home') }}" class="image mb-7 mb-sm-10">
                <img alt="Logo" src="{{ asset($settingValue['app_logo']['value']) }}" class="img-fluid" style="width: 300px!important;">
            </a>
        </div>
        <div class="bg-theme-white rounded-15 shadow-md width-540 px-5 px-sm-7 py-10 mx-auto">
            @include('flash::message')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h1 class="text-center mb-7">{{ __('auth.sign_in') }}</h1>
            <form method="post" action="{{ url('/login') }}">
                @csrf
                <input type="hidden" name="route_name"
                    value="{{ app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName() }}">
                <div class="mb-sm-7 mb-4">
                    <label for="formInputEmail" class="form-label">
                        {{ __('auth.email') }} <span class="required"></span>
                    </label>
                    <input type="email" class="form-control" name="email"
                        value="{{ Cookie::get('email') !== null ? Cookie::get('email') : old('email') }}" required
                        placeholder="{{ __('auth.login.enter_email') }}" id="formInputEmail">
                </div>
                <div class="mb-sm-7 mb-4">
                    <div class="d-flex justify-content-between">
                        <label for="formInputPassword" class="form-label">{{ __('auth.password') }}:
                            <span class="required"></span>
                        </label>
                        <a href="{{ url('/password/reset') }}" class="link-info fs-6 text-decoration-none">
                            {{ __('auth.login.forgot_password') }} ?
                        </a>
                        <input type="hidden"
                            value="{{ session('languageName') == null ? session('languageName') : checkLanguageSession() }}"
                            name="se_lang">
                    </div>
                    <input type="password" class="form-control" name="password" id="formInputPassword"
                        placeholder="{{ __('auth.login.enter_password') }}"
                        value="{{ Cookie::get('password') !== null ? Cookie::get('password') : null }}" required>
                </div>
                <div class="mb-sm-7 mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="formCheck">
                    <label class="form-check-label" for="formCheck">{{ __('auth.remember_me') }}</label>
                </div>
                <div class="d-grid" data-turbo="false">
                    <button type="submit" class="btn btn-primary">{{ __('auth.login.login') }}</button>
                </div>
                <div class="d-flex align-items-center mt-4">
                    <span class="text-gray-700 me-2"> {{ __('messages.new_change.not_have_account') }}?</span>
                    <a href="{{ route('register') }}" class="link-info fs-6 text-decoration-none">
                        {{ __('messages.web_home.sign_up') }}
                    </a>
                </div>
            </form>
        </div>

    </div>
    <!--end::Authentication - Sign-in -->

    <div class="container mt-10">
    <div class="row">
        <div class="col-12">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-9 col-12 all-btns my-5">
                    <div class="row text-uppercase">
                        <div class="col-md-4 col-lg-3 mb-4 col-6 ">
                            <a 
                            data-user="admin@vidyagxp.com"
                            data-password="123456789"
                            class="btn btn-danger superadmin-login accountLoginBtn">super admin</a>
                        </div>
                        <div class="col-md-4 col-lg-3 mb-4 col-6">
                            <a 
                            data-user="hospital@vidyagxp.com"
                            data-password="123456789"
                            class="btn btn-success admin-login accountLoginBtn">hospital admin</a>
                        </div>
                        <div class="col-md-4 col-lg-3 mb-4 col-6">
                            <a 
                            data-user="amit@vidyagxp.com"
                            data-password="password"
                            class="btn btn-warning doctor-login accountLoginBtn">doctor</a>
                        </div>
                        <div class="col-md-4 col-lg-3 mb-4 col-6">
                            <a class="btn btn-primary accountant-login accountLoginBtn">accountant</a>
                        </div>
                        <div class="col-md-4 col-lg-3 mb-4 col-6">
                            <a class="btn btn-info cas-handler-login accountLoginBtn">case handler</a>
                        </div>
                        <div class="col-md-4 col-lg-3 mb-4 col-6">
                            <a class="btn btn-warning receptionist-login accountLoginBtn">receptionist</a>
                        </div>
                        <div class="col-md-4 col-lg-3 mb-4 col-6">
                            <a class="btn btn-info pharmacist-login accountLoginBtn">pharmacist</a>
                        </div>
                        <div class="col-md-4 col-lg-3 mb-4 col-6">
                            <a class="btn btn-danger lab-technician-login accountLoginBtn">lab technician</a>
                        </div>
                        <div class="col-md-4 col-lg-3 mb-4 col-6">
                            <a class="btn btn-success nurse-login accountLoginBtn">nurse</a>
                        </div>
                        <div class="col-md-4 col-lg-3 mb-4 col-6">
                            <a class="btn btn-danger patient-login accountLoginBtn">patient</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('.accountLoginBtn').click(function() {
            const user = $(this).data('user');
            const pass = $(this).data('password')

            $('#formInputEmail').val(user)
            $('#formInputPassword').val(pass)

        })
    })
</script>
@endsection
