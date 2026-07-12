@props(['tableId' => 'manage_all', 'tableClass' => 'align-middle mb-0 table table-borderless table-striped table-hover table-color w-100'])

<div class="row">
    <div class="col-12">
        <div class="main-card mb-3 card admin-datatable-card">
            <div class="card-body">
                <p class="admin-datatable-scroll-hint d-lg-none mb-2" aria-hidden="true">
                    &larr; {{ __('Swipe / scroll horizontally to see all columns') }} &rarr;
                </p>
                <div class="admin-datatable-wrap">
                    <table id="{{ $tableId }}" {{ $attributes->merge(['class' => $tableClass]) }}>
                        {{ $slot }}
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
