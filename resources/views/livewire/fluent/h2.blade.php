<h2 wire:click="handleClick" @class([$class, "bg-red-400 cursor-pointer" => $editMode])>
    {{ $output }}
</h2>
