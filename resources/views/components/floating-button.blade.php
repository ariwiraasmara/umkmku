<button {{ $attributes->merge([
    'type' => 'button', 
    'class' => 'inline-flex items-center p-4 m-3 bg-gray-800 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 fixed bottom-0 right-0']) }}>
    {{ $slot }}
</button>
