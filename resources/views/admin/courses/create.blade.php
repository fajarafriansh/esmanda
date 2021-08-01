@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.course.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.courses.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="teachers">{{ trans('cruds.course.fields.teachers') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('teachers') ? 'is-invalid' : '' }}" name="teachers[]" id="teachers" multiple>
                    @foreach($teachers as $id => $teacher)
                        <option value="{{ $id }}" {{ in_array($id, old('teachers', [])) ? 'selected' : '' }}>{{ $teacher }}</option>
                    @endforeach
                </select>
                @if($errors->has('teachers'))
                    <div class="invalid-feedback">
                        {{ $errors->first('teachers') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.course.fields.teachers_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.course.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.course.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.course.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.course.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="course_image">{{ trans('cruds.course.fields.course_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('course_image') ? 'is-invalid' : '' }}" id="course_image-dropzone">
                </div>
                @if($errors->has('course_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('course_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.course.fields.course_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="start_date">{{ trans('cruds.course.fields.start_date') }}</label>
                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date') }}">
                @if($errors->has('start_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.course.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('pablished') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="pablished" value="0">
                    <input class="form-check-input" type="checkbox" name="pablished" id="pablished" value="1" {{ old('pablished', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="pablished">{{ trans('cruds.course.fields.pablished') }}</label>
                </div>
                @if($errors->has('pablished'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pablished') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.course.fields.pablished_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.courseImageDropzone = {
    url: '{{ route('admin.courses.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="course_image"]').remove()
      $('form').append('<input type="hidden" name="course_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="course_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($course) && $course->course_image)
      var file = {!! json_encode($course->course_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="course_image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection