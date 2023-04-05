<x-modal title="Create Tasks">
    <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-2">
            <label for="">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Name" required>
        </div>
        <div class="form-group mb-2">
            <label for="">Phone <span class="text-danger">*</span></label>
            <input type="number" class="form-control" name="phone" placeholder="Phone" required>
        </div>
        <div class="form-group mb-2">
            <label for="">Image</label>
            <input type="file" class="form-control" name="image" placeholder="Enter Image">
        </div>
        <div class="form-group mb-2">
            <label for="">Description</label>
            <textarea class="form-control" name="description" rows="8" placeholder="Description"></textarea>
        </div>
        <div class="form-group mb-2">
            <input type="submit" value="Save" class="btn btn-primary">
        </div>
    </form>
</x-modal>
