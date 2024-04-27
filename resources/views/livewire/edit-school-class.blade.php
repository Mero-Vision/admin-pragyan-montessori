<div>
    <form wire:submit.prevent="save" class="px-3">
        <input class="form-control" type="text" wire:model.live="class_id" id="class_id">
        <div class="mb-3">
            <label for="emailaddress1" class="form-label text-light">Class Name</label>
            <input class="form-control" type="text" wire:model.live="class_name" id="class_name">
            @error('class_name')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password1" class="form-label text-light">Select Class Teacher</label>
            <select class="form-control" wire:model.live="class_teacher" style="height: 38px;">
                @foreach ($teachers as $teacher)
                    <option value="{{$teacher->id}}">{{ $teacher->teacher_name }}</option>
                @endforeach
            </select>
             @error('class_teacher')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-2 text-center">
            <button class="btn btn-danger" type="submit">Save</button>
        </div>
    </form>
</div>
