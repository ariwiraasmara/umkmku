<div>
    {{-- Do your work, then step back. --}}
    <span x-text="$wire.hello"></span>, <span x-text="$wire.x"></span>, <span x-text="$wire.y"></span>
    <div x-data>
        <h1 x-text="$wire.count"></h1>
 
        <button x-on:click="$wire.increment()">Increment</button>
    </div>
</div>