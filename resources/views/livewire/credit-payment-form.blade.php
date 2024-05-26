<div>
    <form id="paymentForm" wire:submit.prevent="save">
        <div class="row">
            <p>Select a Payment Method</p>
            @foreach ($paymentOptions as $paymentOption)
                <div class="col-md-3">
                    <div class="payment-option">
                        <input type="radio" id="{{ $paymentOption->payment_name }}" name="payment_option"
                            value="{{ $paymentOption->id }}" wire:model.live="payment_option_id">
                        <label for="{{ $paymentOption->payment_name }}"
                            class="card">{{ $paymentOption->payment_name }}</label>

                    </div>
                </div>
            @endforeach
            @error('payment_option_id')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <p>PAID AMOUNT<span class="login-danger">*</span></p>
                <input class="form-control" type="number" name="paid_amount" wire:model.live="paid_amount">
                @error('paid_amount')
                    <p class="text-danger">{{ $message }}</p>
                @enderror


            </div>

            <div class="col-md-6"
                style="background-color: #e3f2fd; border-radius: 10px; padding: 20px; font-family: 'Arial', sans-serif; font-size: 14px;">
                <p>Paid Amount: Rs. {{ $creditPayment }}</p>
                <hr style="border: 1px solid #bbb;">
                <p>Due Amount: Rs. {{ $dueAmount }}</p>
            </div>


        </div>
        @if (session()->has('message'))
            <div class="alert alert-danger text-dark">
                {{ session('message') }}
            </div>
        @endif

        <button class="btn btn-primary mt-3" type="submit">Pay Credit Amount</button>


    </form>
</div>
