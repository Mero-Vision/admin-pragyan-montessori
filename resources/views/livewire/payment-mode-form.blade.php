<div>
    <form wire:submit.prevent="save" class="px-3">
        <div class="">
            <label for="emailaddress1" class="form-label text-dark">Payment Option Name</label>
            <input class="form-control" type="text" wire:model.live="payment_option">
            @error('payment_option')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <br>
        <div class="mt-2">
            <button class="btn btn-danger" type="submit">Save</button>
        </div>
    </form>
</div>
