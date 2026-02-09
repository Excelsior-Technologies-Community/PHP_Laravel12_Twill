<section style="padding:20px; margin-bottom:20px;">
    @if ($block->image('image'))
        <img 
            src="{{ $block->image('image', 'default') }}" 
            alt="Block Image"
            style="max-width:100%; height:auto;"
        >
    @endif
</section>
