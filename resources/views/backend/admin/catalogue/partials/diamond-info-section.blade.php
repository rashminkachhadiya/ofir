@php
    $rows = !empty($rows) ? array_values($rows) : [[]];
    $totalRows = count($rows);
@endphp

<div class="jewel-repeat-section" data-section="diamond">
    <h5 class="form-section-title">Diamond Info</h5>
    <div id="diamond-info-rows" class="jewel-repeat-rows" data-name-prefix="diamond_info">
        @foreach($rows as $index => $row)
            @include('backend.admin.catalogue.partials.diamond-info-row', [
                'index' => $index,
                'row' => $row,
                'shapeOptions' => $shapeOptions,
                'totalRows' => $totalRows,
            ])
        @endforeach
    </div>
    <button type="button" class="btn btn-sm btn-outline-primary jewel-add-row" data-target="diamond-info-rows">
        <i class="fa fa-plus" aria-hidden="true"></i> Add More
    </button>
</div>
