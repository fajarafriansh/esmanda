@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.question.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.questions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="question">{{ trans('cruds.question.fields.question') }}</label>
                <textarea class="form-control {{ $errors->has('question') ? 'is-invalid' : '' }}" name="question" id="question" required>{{ old('question') }}</textarea>
                @if($errors->has('question'))
                    <div class="invalid-feedback">
                        {{ $errors->first('question') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.question_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="question_image">{{ trans('cruds.question.fields.question_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('question_image') ? 'is-invalid' : '' }}" id="question_image-dropzone">
                </div>
                @if($errors->has('question_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('question_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.question_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="score">{{ trans('cruds.question.fields.score') }}</label>
                <input class="form-control {{ $errors->has('score') ? 'is-invalid' : '' }}" type="number" name="score" id="score" value="{{ old('score', '1') }}" step="1" required>
                @if($errors->has('score'))
                    <div class="invalid-feedback">
                        {{ $errors->first('score') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.question.fields.score_helper') }}</span>
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
    Dropzone.options.questionImageDropzone = {
    url: '{{ route('admin.questions.storeMedia') }}',
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
      $('form').find('input[name="question_image"]').remove()
      $('form').append('<input type="hidden" name="question_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="question_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($question) && $question->question_image)
      var file = {!! json_encode($question->question_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="question_image" value="' + file.file_name + '">')
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