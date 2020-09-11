<style>
    .login-box {
        margin-top: -10rem;
        padding: 5px;
    }

    .login-card-body {
        padding: 1.5rem 1.8rem 1.6rem;
    }

    .card, .card-body {
        border-radius: .25rem
    }

    .login-btn {
        padding-left: 2rem !important;;
        padding-right: 1.5rem !important;
    }

    .content {
        overflow-x: hidden;
    }

    .form-group .control-label {
        text-align: left;
    }
</style>

<div class="login-page bg-40">
    <div class="login-box">
        <div class="login-logo mb-2">
            {{ config('admin.name') }}
        </div>
        <div class="card">
            <div class="card-body login-card-body shadow-100">
                <p class="login-box-msg mt-1 mb-1">{{ __('custom.welcome_register') }}</p>

                <form id="login-form" method="POST" action="{{ admin_url('auth/login/sms_validation') }}">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                    {{--                    手机号码--}}
                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                        <input
                            id="mobile_value"
                            type="text"
                            class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}"
                            name="mobile"
                            placeholder="{{ trans('admin.mobile') }}"
                            value="{{ old('mobile') }}"
                            pattern="1[34578]\d{9}$"
                            required
                            autofocus
                        >

                        <div class="form-control-position">
                            <i class="feather icon-phone"></i>
                        </div>

                        <label for="email">{{ trans('admin.mobile') }}</label>

                        <div class="help-block with-errors"></div>
                        @if($errors->has('mobile'))
                            <span class="invalid-feedback text-danger" role="alert">
                                            @foreach($errors->get('mobile') as $message)
                                    <span class="control-label" for="inputError"><i class="feather icon-x-circle"></i> {{$message}}</span>
                                    <br>
                                @endforeach
                                        </span>
                        @endif
                    </fieldset>

                    {{--                    输入图形验证码--}}
                    <button id="send" type="button" class="btn btn-success float-right login-btn clear-radius-left"
                            disabled>
                        {{ __('admin.send') }}
                        &nbsp;
                        <i class="feather icon-mail"></i>
                    </button>
                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                        <input
                            id="captcha_value"
                            type="text"
                            class="form-control {{ $errors->has('captcha') ? 'is-invalid' : '' }} clear-radius-right"
                            name="captcha"
                            placeholder="{{ trans('admin.captcha') }}"
                            value="{{ old('captcha') }}"
                            required
                            autofocus
                        >
                        <div class="form-control-position">
                            <i class="feather icon-code"></i>
                        </div>
                        <label for="email">{{ trans('admin.captcha') }}</label>
                        <div class="help-block with-errors"></div>
                        @if($errors->has('captcha'))
                            <span class="invalid-feedback text-danger" role="alert">
                                            @foreach($errors->get('captcha') as $message)
                                    <span class="control-label" for="inputError"><i class="feather icon-x-circle"></i> {{$message}}</span>
                                    <br>
                                @endforeach
                                        </span>
                        @endif
                    </fieldset>

                    {{--                    图形验证码--}}
                    <fieldset class="form-label-group form-group position-relative">
                        <img id="captcha" src="">
                    </fieldset>

                    {{--                    手机验证码--}}
                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                        <input
                            minlength="5"
                            maxlength="20"
                            id="code"
                            type="text"
                            class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}"
                            name="code"
                            placeholder="{{ trans('admin.sms_code') }}"
                            required
                            autocomplete="current-code"
                        >

                        <div class="form-control-position">
                            <i class="feather icon-lock"></i>
                        </div>
                        <label for="code">{{ trans('admin.sms_code') }}</label>

                        <div class="help-block with-errors"></div>
                        @if($errors->has('code'))
                            <span class="invalid-feedback text-danger" role="alert">
                                            @foreach($errors->get('code') as $message)
                                    <span class="control-label" for="inputError"><i class="feather icon-x-circle"></i> {{$message}}</span>
                                    <br>
                                @endforeach
                                            </span>
                        @endif

                    </fieldset>

                    <a href="/customer/auth/login" class="btn btn-white float-left login-btn">
                        {{ __('admin.login_traditional') }}
                        &nbsp;
                    </a>

                    <button type="submit" class="btn btn-primary float-right login-btn">

                        {{ __('admin.register') }}
                        &nbsp;
                        <i class="feather icon-arrow-right"></i>
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    Dcat.ready(function () {
        // ajax表单提交
        $('#login-form').form({
            validate: true,
            success: function (data) {
                if (!data.status) {
                    Dcat.error(data.message);

                    return false;
                }

                Dcat.success(data.message);

                location.href = data.redirect;

                return false;
            }
        });
    });
</script>
