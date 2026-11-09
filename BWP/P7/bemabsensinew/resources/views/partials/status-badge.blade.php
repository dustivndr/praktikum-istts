@php
    $badgeClass = match ($status) {
        'Open Recruitment', 'Lengkap', 'Sudah Check-out' => 'bg-success text-white',
        'Coming Soon', 'Belum Check-out' => 'bg-warning text-dark',
        default => 'bg-danger text-white',
    };
@endphp
<span class="badge {{ $badgeClass }}">{{ $status }}</span>
