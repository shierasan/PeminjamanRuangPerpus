@if ($paginator->hasPages())
    <nav style="display: flex; justify-content: center; align-items: center; gap: 1rem; margin-top: 1.5rem;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span
                style="padding: 0.5rem 1.5rem; color: #ccc; cursor: not-allowed; font-size: 0.875rem; border: 1px solid #e5e7eb; border-radius: 6px;">
                &laquo; Sebelumnya
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                style="padding: 0.5rem 1.5rem; color: #B8985F; text-decoration: none; font-size: 0.875rem; font-weight: 500; border: 1px solid #B8985F; border-radius: 6px; transition: all 0.2s;"
                onmouseover="this.style.background='#B8985F'; this.style.color='white';"
                onmouseout="this.style.background='transparent'; this.style.color='#B8985F';">
                &laquo; Sebelumnya
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                style="padding: 0.5rem 1.5rem; color: #B8985F; text-decoration: none; font-size: 0.875rem; font-weight: 500; border: 1px solid #B8985F; border-radius: 6px; transition: all 0.2s;"
                onmouseover="this.style.background='#B8985F'; this.style.color='white';"
                onmouseout="this.style.background='transparent'; this.style.color='#B8985F';">
                Selanjutnya &raquo;
            </a>
        @else
            <span
                style="padding: 0.5rem 1.5rem; color: #ccc; cursor: not-allowed; font-size: 0.875rem; border: 1px solid #e5e7eb; border-radius: 6px;">
                Selanjutnya &raquo;
            </span>
        @endif
    </nav>
@endif