@props(['id' => 'create', 'method' => 'POST'])

<form id="{{ $id }}" action="" enctype="multipart/form-data" method="post"
      accept-charset="utf-8" class="needs-validation modal-form" novalidate>
    @if($method === 'PATCH')
        {{ method_field('PATCH') }}
    @endif
    <div id="status" class="modal-form__status"></div>
    <div class="form-row modal-form__body">
        {{ $slot }}
    </div>
    @isset($footer)
        <div class="modal-form__footer">
            {{ $footer }}
        </div>
    @endisset
</form>
