@props(['weight', 'newWeight'])
<div>
    <div>
        Weight:   {{ $weight }}<br />
        NewWeight:   {{ $newWeight }}

    </div>
    <div>
        Email:   {{ $slot }}
    </div>
</div>
