@if ($paginator->hasPages())
    <nav style="display: flex; justify-content: center; align-items: center; gap: 0.5rem; margin-top: 1.5rem;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span style="padding: 0.5rem 1rem; color: #ccc; cursor: not-allowed; font-size: 0.875rem;">
                &laquo; Sebelumnya
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                style="padding: 0.5rem 1rem; color: #B8985F; text-decoration: none; font-size: 0.875rem; font-weight: 500; border: 1px solid #B8985F; border-radius: 6px; transition: all 0.2s;"
                onmouseover="this.style.background='#B8985F'; this.style.color='white';"
                onmouseout="this.style.background='transparent'; this.style.color='#B8985F';">
                &laquo; Sebelumnya
            </a>
        @endif

        {{-- Pagination Elements --}}
        <div style="display: flex; gap: 0.25rem;">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span style="padding: 0.5rem 0.75rem; color: #666; font-size: 0.875rem;">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span
                                style="padding: 0.5rem 0.75rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border-radius: 6px; font-size: 0.875rem; font-weight: 600;">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                                style="padding: 0.5rem 0.75rem; color: #666; text-decoration: none; font-size: 0.875rem; border: 1px solid #e5e7eb; border-radius: 6px; transition: all 0.2s;"
                                onmouseover="this.style.borderColor='#B8985F'; this.style.color='#B8985F';"
                                onmouseout="this.style.borderColor='#e5e7eb'; this.style.color='#666';">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                style="padding: 0.5rem 1rem; color: #B8985F; text-decoration: none; font-size: 0.875rem; font-weight: 500; border: 1px solid #B8985F; border-radius: 6px; transition: all 0.2s;"
                onmouseover="this.style.background='#B8985F'; this.style.color='white';"
                onmouseout="this.style.background='transparent'; this.style.color='#B8985F';">
                Selanjutnya &raquo;
            </a>
        @else
            <span style="padding: 0.5rem 1rem; color: #ccc; cursor: not-allowed; font-size: 0.875rem;">
                Selanjutnya &raquo;
            </span>
        @endif
    </nav>
@endif