@props(['title' => ''])
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">{{ $title }}</h5>
        </div>
        <div class="card-body">
            <x-alert.alert />
            {{ $slot }}

        </div>
    </div>
</div>
