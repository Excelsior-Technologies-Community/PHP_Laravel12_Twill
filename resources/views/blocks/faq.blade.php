<div class="faq-section">
    <h2>{{ $block->input('title') }}</h2>
    <div class="faq-items">
        @foreach($block->children('faq_items') as $item)
            <div class="faq-item">
                <h3 class="faq-question">{{ $item->input('question') }}</h3>
                <div class="faq-answer">{!! $item->input('answer') !!}</div>
            </div>
        @endforeach
    </div>
</div>