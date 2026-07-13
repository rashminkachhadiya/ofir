@php
    $rows = !empty($rows) ? array_values($rows) : [[]];
    $totalRows = count($rows);
@endphp

<div class="jewel-repeat-section" data-section="gem">
    <h5 class="form-section-title">Gem Info</h5>
    <div id="gem-info-rows" class="jewel-repeat-rows" data-name-prefix="gem_info">
        @foreach($rows as $index => $row)
            @include('backend.admin.catalogue.partials.gem-info-row', [
                'index' => $index,
                'row' => $row,
                'shapeOptions' => $shapeOptions,
                'gemOptions' => $gemOptions,
                'totalRows' => $totalRows,
            ])
        @endforeach
    </div>
    <button type="button" class="btn btn-sm btn-outline-primary jewel-add-row" data-target="gem-info-rows">
        <i class="fa fa-plus" aria-hidden="true"></i> Add More
    </button>
</div>
