<h2 wire:click="handleClick" @class([$class, "bg-red-400 hover:bg-red-500 cursor-pointer" => $editMode])>
    {{ $output }}
</h2>
