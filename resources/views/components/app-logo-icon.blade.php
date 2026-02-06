<div {{ $attributes->merge(['class' => 'flex items-center justify-center']) }}>
    <img src="{{ asset('build/assets/img/iconBlack.png') }}"
         alt="Logo"
         class="h-full w-auto object-contain block dark:hidden">

    <img src="{{ asset('build/assets/img/iconWhite.png') }}"
         alt="Logo"
         class="h-full w-auto object-contain hidden dark:block">
</div>
