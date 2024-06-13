<div>
    <form  wire:submit.prevent="save">
        <div class="form-group">
            <label>Old Password</label>
            <input type="password" class="form-control" wire:model.live="old_password">
            @error('old_password')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label>New Password</label>
            <input type="password" class="form-control" wire:model.live="new_password">
             @error('new_password')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" class="form-control" wire:model.live="confirm_password">
             @error('confirm_password')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <button class="btn btn-primary" type="submit">Save
            Changes</button>
    </form>
</div>
