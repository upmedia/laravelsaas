@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Subscription
                </div>
                <div class="panel-body">
                    <form action="{{ route('subscription.store') }}" method="post" id="payment-form" class="form-horizontal">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('plan') ? ' has-error' : '' }}">
                            <label for="plan" class="col-md-4 control-label">Plan</label>
                            <div class="col-md-6">
                                <select name="plan" id="plan" class="form-control">
                                    @foreach ($plans as $plan)
                                        <option value="{{ $plan->gateway_id }}"{{ request('plan') === $plan->slug || old('plan') === $plan->gateway_id ? ' selected="selected"' : '' }}>
                                            {{ $plan->name }} (&pound;{{ $plan->price }})
                                        </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('plan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('plan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <<div class="form-group{{ $errors->has('coupon') ? ' has-error' : '' }}">
                            <label for="coupon" class="col-md-4 control-label">Coupon plan</label>
                            <div class="col-md-6">
                                <input type="text" name="coupon" id="coupon" class="form-control" value="{{ old('coupon') }}">

                                @if ($errors->has('coupon'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('coupon') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" id="pay">
                                    Pay
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
