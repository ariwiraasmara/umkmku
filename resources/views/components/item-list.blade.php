{{--! Copyright @ Syahri Ramadhan Wiraasmara (ARI) --}}
<div {{ $attributes->merge(['onclick' => $vartoclick,'class' => 'border-b border-gray-600 py-2 mb-2']) }}>
    {{ $slot }}
</div>