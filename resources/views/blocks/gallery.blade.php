<div class="gallery">
    <h2>{{ $block->input('title') }}</h2>
    <div class="gallery-grid">
        @foreach($block->medias('images') as $image)
            <div class="gallery-item">
                <img src="{{ $image->url('gallery') }}" alt="{{ $image->alt_text ?? '' }}">
            </div>
        @endforeach
    </div>
</div>