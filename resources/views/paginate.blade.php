<div class="border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
    {{-- Small Screen Pagination --}}
    <div class="flex flex-col sm:hidden">
      <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
          <span class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-gray-300 ring-inset cursor-not-allowed">
            <span class="sr-only">Previous</span>
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
            </svg>
          </span>
        @else
          <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-700 ring-1 ring-gray-300 ring-inset hover:bg-gray-50">
            <span class="sr-only">Previous</span>
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
            </svg>
          </a>
        @endif
  
        {{-- Define window for small screens (fewer adjacent pages) --}}
        @php
          $currentPage = $paginator->currentPage();
          $lastPage = $paginator->lastPage();
          $adjacentSmall = 1;
          $startSmall = max(1, $currentPage - $adjacentSmall);
          $endSmall   = min($lastPage, $currentPage + $adjacentSmall);
        @endphp
  
        {{-- Show first page and ellipsis if needed --}}
        @if ($startSmall > 1)
          <a href="{{ $paginator->url(1) }}" class="relative inline-flex items-center px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-gray-300 ring-inset hover:bg-gray-50">1</a>
          @if ($startSmall > 2)
            <span class="relative inline-flex items-center px-3 py-2 text-sm font-semibold text-gray-700 ring-1 ring-gray-300 ring-inset">...</span>
          @endif
        @endif
  
        {{-- Page links window for small screens --}}
        
        @for ($page = $startSmall; $page <= $endSmall; $page++)
          @if ($page == $currentPage)
            <span aria-current="page" class="relative z-10 inline-flex items-center bg-custom-kcolor px-3 py-2 text-sm font-semibold text-white">{{ $page }}</span>
          @else
            <a href="{{ $paginator->url($page) }}" class="relative inline-flex items-center px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-gray-300 ring-inset hover:bg-gray-50">{{ $page }}</a>
          @endif
        @endfor
        
        {{-- Show last page and ellipsis if needed --}}
        @if ($endSmall < $lastPage)
          @if ($endSmall < $lastPage - 1)
            <span class="relative inline-flex items-center px-3 py-2 text-sm font-semibold text-gray-700 ring-1 ring-gray-300 ring-inset">...</span>
          @endif
          <a href="{{ $paginator->url($lastPage) }}" class="relative inline-flex items-center px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-gray-300 ring-inset hover:bg-gray-50">{{ $lastPage }}</a>
        @endif
  
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
          <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-700 ring-1 ring-gray-300 ring-inset hover:bg-gray-50">
            <span class="sr-only">Next</span>
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
          </a>
        @else
          <span class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-gray-300 ring-inset cursor-not-allowed">
            <span class="sr-only">Next</span>
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
          </span>
        @endif
      </nav>
    </div>
  
    {{-- Large Screen Pagination --}}
    <div class="hidden sm:flex sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700">
          Showing
          <span class="font-medium">{{ $paginator->firstItem() }}</span>
          to
          <span class="font-medium">{{ $paginator->lastItem() }}</span>
          of
          <span class="font-medium">{{ $paginator->total() }}</span>
          results
        </p>
      </div>
      <div>
        <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
          {{-- Previous Page Link --}}
          @if ($paginator->onFirstPage())
            <span class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-gray-300 ring-inset cursor-not-allowed">
              <span class="sr-only">Previous</span>
              <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
              </svg>
            </span>
          @else
            <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-700 ring-1 ring-gray-300 ring-inset hover:bg-gray-50">
              <span class="sr-only">Previous</span>
              <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
              </svg>
            </a>
          @endif
  
          {{-- Define window for large screens --}}
          @php
            $adjacentLarge = 2;
            $startLarge = max(1, $currentPage - $adjacentLarge);
            $endLarge   = min($lastPage, $currentPage + $adjacentLarge);
          @endphp
  
          {{-- Show first page and ellipsis if needed --}}
          @if ($startLarge > 1)
            <a href="{{ $paginator->url(1) }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-gray-300 ring-inset hover:bg-gray-50">1</a>
            @if ($startLarge > 2)
              <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-gray-300 ring-inset">...</span>
            @endif
          @endif
  
          {{-- Page links window for large screens --}}
          @for ($page = $startLarge; $page <= $endLarge; $page++)
            @if ($page == $currentPage)
              <span aria-current="page" class="relative z-10 inline-flex items-center bg-custom-kcolor px-4 py-2 text-sm font-semibold text-white">{{ $page }}</span>
            @else
              <a href="{{ $paginator->url($page) }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-gray-300 ring-inset hover:bg-gray-50">{{ $page }}</a>
            @endif
          @endfor
  
          {{-- Show last page and ellipsis if needed --}}
          @if ($endLarge < $lastPage)
            @if ($endLarge < $lastPage - 1)
              <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-gray-300 ring-inset">...</span>
            @endif
            <a href="{{ $paginator->url($lastPage) }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-gray-300 ring-inset hover:bg-gray-50">{{ $lastPage }}</a>
          @endif
  
          {{-- Next Page Link --}}
          @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-700 ring-1 ring-gray-300 ring-inset hover:bg-gray-50">
              <span class="sr-only">Next</span>
              <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
              </svg>
            </a>
          @else
            <span class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-gray-300 ring-inset cursor-not-allowed">
              <span class="sr-only">Next</span>
              <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
              </svg>
            </span>
          @endif
        </nav>
      </div>
    </div>
  </div>
  