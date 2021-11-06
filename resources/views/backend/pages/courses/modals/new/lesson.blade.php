<!-- Modal -->
<div class="modal fade" id="newLesson" tabindex="-1" aria-labelledby="newLessonLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ url('admin/courses/lesson/store') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newLessonLabel">New Lesson</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <select name="modules" class="form-control" required>
              @foreach($course->modules as $module)
                <option value="{{ $module->id }}">{{ $module->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Lesson title" required>
          </div>
          <div class="form-group">
            <textarea name="description" class="form-control" placeholder="Lesson Details" rows="7"></textarea>
          </div>
          <div class="form-group">
            <input type="text" name="video_url" class="form-control" placeholder="Eg. https://vimeo.com/3984883773">
          </div>
          {{--<div class="form-group">
            <input type="file" name="image">
          </div>--}}
        </div>
        <input type="hidden" name="duration">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Create</button>
        </div>
      </div>
    </form>
  </div>
</div>