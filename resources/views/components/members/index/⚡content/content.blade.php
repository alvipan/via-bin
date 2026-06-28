@placeholder
    @include('components.members.index.placeholder')
@endplaceholder

<div>
    <div class="hidden md:block">
        @include('components.members.index.table')
    </div>

    <div class="md:hidden">
        @include('components.members.index.card')
    </div>
</div>
