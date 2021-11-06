<!-- Modal -->
<div class="modal fade" id="editCourse" tabindex="-1" aria-labelledby="editCourseLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.courses.update', $course->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCourseLabel">Edit Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Course Name" value="{{ $course->name }}">
                    </div>
                    <div class="form-group">
                        <textarea name="description" class="form-control" placeholder="Course Details" rows="7">{{ $course->description }}</textarea>
                    </div>
                    {{--<div class="form-group">
                        <input type="file" name="image">
                    </div>--}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>