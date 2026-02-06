<x-layouts::auth>
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Olvidé mi contraseña')" :description="__('Verifica tu correo electronico para reestablecimiento de contraseña')" />

        <!-- Estatus de sesión -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Dirección de correo electronico -->
            <flux:input
                name="email"
                :label="__('Correo electronico')"
                type="email"
                required
                autofocus
                placeholder="Ingresa tu correo"
            />

            <flux:button variant="primary" type="submit" class="w-full" data-test="email-password-reset-link-button">
                {{ __('Confirmar reestablecimiento de contraseña') }}
            </flux:button>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-400">
            <span>{{ __('¿Ya tienes cuenta?, regresa a  ') }}</span>
            <flux:link :href="route('login')" wire:navigate>{{ __('Inicia sesión') }}</flux:link>
        </div>
    </div>
</x-layouts::auth>
