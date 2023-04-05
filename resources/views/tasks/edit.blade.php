<x-modal title="Update task">
    <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group mb-2">
            <label for="">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $task->name }}" required>
        </div>
        <div class="form-group mb-2">
            <label for="">Phone <span class="text-danger">*</span></label>
            <input type="number" class="form-control" name="phone" placeholder="Phone" value="{{ $task->phone }}" required>
        </div>
        <div class="form-group mb-2">
            <label for="">Photo</label>
            <img src="{{ $task->image }}" alt="{{ $task->name }}" class="img-fluid" id="preview"/>

            <label>Upload new one to replace:</label>
            <input type="file" class="form-control" name="image" placeholder="Enter Image" id="image" onchange="viewPreview(event)">
        </div>
        <div class="form-group mb-2">
            <label for="">Description</label>
            <textarea class="form-control" name="description" rows="8" placeholder="Description">{{ $task->description }}</textarea>
        </div>
        <div class="form-group mb-2">
            <input type="submit" value="Update" class="btn btn-primary">
        </div>
    </form>
</x-modal>
<script>
function viewPreview(abcdefg) {
    abcdefg.preventDefault();
    console.log(abcdefg);
    document.getElementById('preview').src = URL.createObjectURL(abcdefg.target.files[0]);
}
</script>
