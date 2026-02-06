@props([
    'sidebar' => false,
])

@if($sidebar)
    <flux:sidebar.brand name="Inteligreen" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center rounded-md overflow-hidden">
            <img src="{{ asset('build/assets/img/iconBlack.png') }}"
                 alt="Logo Inteligreen"
                 class="h-full w-full object-contain block dark:hidden">

            <img src="{{ asset('build/assets/img/iconWhite.png') }}"
                 alt="Logo Inteligreen"
                 class="h-full w-full object-contain hidden dark:block">
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand name="Inteligreen" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center rounded-md overflow-hidden">
            <img src="{{ asset('build/assets/img/iconBlack.png') }}"
                 alt="Logo Inteligreen"
                 class="h-full w-full object-contain block dark:hidden">

            <img src="{{ asset('build/assets/img/iconWhite.png') }}"
                 alt="Logo Inteligreen"
                 class="h-full w-full object-contain hidden dark:block">
        </x-slot>
    </flux:brand>
@endif
