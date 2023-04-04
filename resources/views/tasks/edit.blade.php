<x-modal title="Update course">
    <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group mb-2">
            <label for="">Select Category <span class="text-danger">*</span></label>
            <select name="category_id" class="form-control">
                <option value=""> >>-- Please Select One --<<</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-2">
            <label for="">Heading</label>
            <input type="text" class="form-control" name="heading" placeholder="Course Name" value="{{ $course->heading }}" required>
        </div>
        <div class="form-group mb-2">
            <label for="">Amount <span class="text-danger">*</span></label>
            <input type="number" class="form-control" name="amount" placeholder="Course Amount" value="{{ $course->amount }}" required>
        </div>
        <div class="form-group mb-2">
            <label for="">Photo <span class="text-danger">*</span></label>
            <img src="{{ $course->photo }}" alt="{{ $course->name }}" class="img-fluid" id="preview"/>

            <label>Upload new one to replace:</label>
            <input type="file" class="form-control" name="photo" placeholder="Enter Image" id="image" onchange="viewPreview(event)">
        </div>
        <div class="form-group mb-2">
            <label for="">Description</label>
            <textarea class="form-control" name="description" rows="8" placeholder="Description">{{ $course->description}}</textarea>
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
