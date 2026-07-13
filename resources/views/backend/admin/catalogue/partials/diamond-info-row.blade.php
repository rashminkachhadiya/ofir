@php
    $row = $row ?? [];
    $index = $index ?? 0;
    $isNumericIndex = is_numeric($index);
    $entryNumber = $isNumericIndex ? ((int) $index + 1) : null;
@endphp

<div class="jewel-repeat-row" data-index="{{ $index }}">
    <div class="jewel-repeat-row__toolbar">
        <span class="jewel-repeat-row__label">@if($entryNumber)Entry {{ $entryNumber }}@endif</span>
        <button type="button"
                class="btn btn-sm btn-outline-danger jewel-remove-row"
                title="Remove"
                @if($isNumericIndex && (int) $index === 0 && ($totalRows ?? 1) <= 1) style="display:none;" @endif>
            <i class="fa fa-trash" aria-hidden="true"></i> Remove
        </button>
    </div>
    <div class="form-jewel-grid">
        <x-admin.form-jewel-field label="Shape">
            {!! Form::select(
                'diamond_info[' . $index . '][shape]',
                $shapeOptions,
                old('diamond_info.' . $index . '.shape', $row['shape'] ?? ''),
                ['class' => 'form-control jewel-select2', 'data-control' => 'select2']
            ) !!}
            @error('diamond_info.' . $index . '.shape')
                <span class="jewel-field-error">{{ $message }}</span>
            @enderror
        </x-admin.form-jewel-field>
        <x-admin.form-jewel-field label="Carat">
            <input type="text"
                   class="form-control"
                   name="diamond_info[{{ $index }}][carat]"
                   value="{{ old('diamond_info.' . $index . '.carat', $row['carat'] ?? '') }}"
                   placeholder="Carat">
            @error('diamond_info.' . $index . '.carat')
                <span class="jewel-field-error">{{ $message }}</span>
            @enderror
        </x-admin.form-jewel-field>
        <x-admin.form-jewel-field label="Pcs">
            <input type="text"
                   class="form-control"
                   name="diamond_info[{{ $index }}][pcs]"
                   value="{{ old('diamond_info.' . $index . '.pcs', $row['pcs'] ?? '') }}"
                   placeholder="Pcs">
            @error('diamond_info.' . $index . '.pcs')
                <span class="jewel-field-error">{{ $message }}</span>
            @enderror
        </x-admin.form-jewel-field>
        <x-admin.form-jewel-field label="Colour">
            <input type="text"
                   class="form-control"
                   name="diamond_info[{{ $index }}][colour]"
                   value="{{ old('diamond_info.' . $index . '.colour', $row['colour'] ?? '') }}"
                   placeholder="Colour">
            @error('diamond_info.' . $index . '.colour')
                <span class="jewel-field-error">{{ $message }}</span>
            @enderror
        </x-admin.form-jewel-field>
        <x-admin.form-jewel-field label="Cleaerty">
            <input type="text"
                   class="form-control"
                   name="diamond_info[{{ $index }}][cleaerty]"
                   value="{{ old('diamond_info.' . $index . '.cleaerty', $row['cleaerty'] ?? '') }}"
                   placeholder="Cleaerty">
            @error('diamond_info.' . $index . '.cleaerty')
                <span class="jewel-field-error">{{ $message }}</span>
            @enderror
        </x-admin.form-jewel-field>
    </div>
</div>
