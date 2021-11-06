<!-- Modal -->
<div class="modal fade" id="newCourse" tabindex="-1" aria-labelledby="newCourseLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.courses.store', $course->id) }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newCourseLabel">New Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Course Name">
                    </div>
                    <div class="form-group">
                        <textarea name="description" class="form-control" placeholder="Course Details" rows="10"></textarea>
                    </div>
                    {{--<div class="form-group">
                        <input type="file" name="image">
                    </div>--}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>