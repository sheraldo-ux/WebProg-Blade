@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <title>Document</title>
</head>

<body class="h-full" style="background-color: #eae8e0">
  <x-header />
  {{-- Page content --}}
  @section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
          <span class="block sm:inline">{{ session('success') }}</span>
        </div>
      @endif

      @auth
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
          <h2 class="text-2xl font-bold mb-4">Contribute News</h2>
          <form action="{{ route('news.store') }}" method="POST">
            @csrf
            <div class="mb-4">
              <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
              <input type="text" name="title" id="title"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                required>
            </div>

            <div class="mb-4">
              <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
              <div class="mt-1 flex flex-col space-y-2">
                <input type="hidden" name="content" id="hidden-content">
                <div id="editor" contenteditable="true"
                  class="block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 min-h-[150px] p-2 overflow-y-auto"
                  required></div>

                <!-- Formatting Menu -->
                <div class="flex space-x-2 bg-gray-100 p-2 rounded">
                  <button type="button" onclick="formatDoc('bold')"
                    class="px-3 py-1 bg-white rounded hover:bg-gray-50 format-btn" data-format="bold">
                    <strong class="text-gray-500">B</strong>
                  </button>
                  <button type="button" onclick="formatDoc('italic')"
                    class="px-3 py-1 bg-white rounded hover:bg-gray-50 format-btn" data-format="italic">
                    <i class="text-gray-500">I</i>
                  </button>
                  <button type="button" onclick="formatDoc('underline')"
                    class="px-3 py-1 bg-white rounded hover:bg-gray-50 format-btn" data-format="underline">
                    <u class="text-gray-500">U</u>
                  </button>
                  <button type="button" onclick="formatDoc('insertOrderedList')"
                    class="px-3 py-1 bg-white rounded hover:bg-gray-50 format-btn" data-format="orderedList">
                    <span class="text-gray-500">1.</span>
                  </button>
                  <button type="button" onclick="formatDoc('insertUnorderedList')"
                    class="px-3 py-1 bg-white rounded hover:bg-gray-50 format-btn" data-format="unorderedList">
                    <span class="text-gray-500">•</span>
                  </button>
                </div>

                <div id="preview" class="prose max-w-none p-4 bg-gray-50 rounded-md hidden"></div>
                <button type="button" onclick="togglePreview()"
                  class="self-start text-sm text-indigo-600 hover:text-indigo-500">
                  Toggle Preview
                </button>
              </div>
            </div>

            <button type="submit"
              class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
              Submit News
            </button>
          </form>
        </div>
      @else
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8">
          <div class="flex">
            <div class="ml-3">
              <p class="text-sm text-yellow-700">
                Please <a href="{{ route('view_login') }}"
                  class="font-medium underline text-yellow-700 hover:text-yellow-600">login</a> to contribute news.
              </p>
            </div>
          </div>
        </div>
      @endauth

      <div class="space-y-8">
        @foreach ($news as $item)
          <article class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $item->title }}</h2>
            <div class="text-sm text-gray-500 mb-4">
              Posted by {{ $item->user->username }} on {{ $item->created_at->format('F j, Y') }}
            </div>
            <div class="prose max-w-none news-content">
              {!! $item->content !!}
            </div>
          </article>
        @endforeach
      </div>
    </div>

    {{-- Enable pagination with centered style and page number --}}
    <div class="flex flex-col items-center mb-4">
      <div class="inline-flex shadow-sm rounded-md overflow-hidden w-60">
        {{ $news->links() }}
      </div>
      <div class="text-sm text-gray-700 mt-2">
          Page {{ $news->currentPage() }} of {{ $news->lastPage() }}
      </div>
    </div>

    @push('scripts')
      <script>
        let previewMode = false;
        const formatButtons = document.querySelectorAll('.format-btn');

        let consecutiveEnters = 0;
        let isSelecting = false;
        let scrollPosition = 0;

        // Replace the previous mousedown/selectstart handlers with these
        document.addEventListener('mousedown', function(e) {
          const isNewsContent = e.target.closest('.news-content, #editor');
          if (isNewsContent) {
            isSelecting = true;
            scrollPosition = window.scrollY;
          }
        });

        document.addEventListener('mousemove', function(e) {
          if (isSelecting) {
            window.scrollTo(0, scrollPosition);
          }
        });

        document.addEventListener('mouseup', function() {
          isSelecting = false;
        });

        // Prevent default selection behavior
        document.addEventListener('selectstart', function(e) {
          const isNewsContent = e.target.closest('.news-content, #editor');
          if (!isNewsContent) {
            e.preventDefault();
          }
        });

        // Initialize editor
        document.addEventListener('DOMContentLoaded', function() {
          // Handle form submission
          const form = editor.closest('form');
          hiddenInput.value = content;

          // Submit the form
          this.submit();
        });

        // Add selection change listener
        document.addEventListener('selectionchange', updateToolbar);
        });

        // Format document - modify to handle list insertion and removal
        function formatDoc(command) {
          if (command === 'insertOrderedList' || command === 'insertUnorderedList') {
            const selection = window.getSelection();
            const range = selection.getRangeAt(0);

            // Get the current block element
            let currentBlock = range.startContainer;
            while (currentBlock && currentBlock.nodeType !== 1) {
              currentBlock = currentBlock.parentNode;
            }

            // Check if we're already in a list
            const inList = currentBlock && (currentBlock.tagName === 'LI' || currentBlock.closest('li'));

            if (inList) {
              // Get the list item and its content
              const listItem = currentBlock.tagName === 'LI' ? currentBlock : currentBlock.closest('li');
              const list = listItem.parentElement;

              // Create a new paragraph with the list item's content
              const newParagraph = document.createElement('p');
              newParagraph.innerHTML = listItem.innerHTML;

              // Replace the list item with the paragraph
              if (list.children.length === 1) {
                // If it's the only item, replace the whole list
                list.parentNode.replaceChild(newParagraph, list);
              } else {
                list.parentNode.insertBefore(newParagraph, list.nextSibling);
                listItem.remove();
              }

              // Set cursor to the new paragraph
              const newRange = document.createRange();
              newRange.selectNodeContents(newParagraph);
              newRange.collapse(false);
              selection.removeAllRanges();
              selection.addRange(newRange);
            } else {
              // If we're not in a list, create one
              // Insert a new paragraph before creating the list if we're not at the start of a block
              if (!isAtStartOfBlock(range)) {
                document.execCommand('insertParagraph', false, null);
              }
              document.execCommand(command, false, null);
            }
          } else {
            document.execCommand(command, false, null);
          }

          editor.focus();
          updateToolbar();
        }

        // Function to check if cursor is at start of block
        function isAtStartOfBlock(range) {
          const startContainer = range.startContainer;
          if (startContainer.nodeType === 3) { // Text node
            return range.startOffset === 0 && (!startContainer.previousSibling);
          }
          return range.startOffset === 0;
        }

        // Update toolbar state
        function updateToolbar() {
          formatButtons.forEach(button => {
            const format = button.dataset.format;
            const isActive = queryFormat(format);

            if (isActive) {
              button.classList.add('bg-gray-200');
              button.querySelector('*').classList.remove('text-gray-500');
              button.querySelector('*').classList.add('text-gray-900');
            } else {
              button.classList.remove('bg-gray-200');
              button.querySelector('*').classList.remove('text-gray-900');
              button.querySelector('*').classList.add('text-gray-500');
            }
          });
        }

        // Query current format state
        function queryFormat(format) {
          switch (format) {
            case 'bold':
              return document.queryCommandState('bold');
            case 'italic':
              return document.queryCommandState('italic');
            case 'underline':
              return document.queryCommandState('underline');
            case 'orderedList':
              return document.queryCommandState('insertOrderedList');
            case 'unorderedList':
              return document.queryCommandState('insertUnorderedList');
            default:
              return false;
          }
        }

        // Modify keyboard event handler for lists
        editor.addEventListener('keydown', function(e) {
          if (e.key === 'Enter') {
            const selection = window.getSelection();
            const range = selection.getRangeAt(0);
            const currentNode = range.startContainer;
            const listItem = currentNode.closest('li');

            if (listItem) {
              // If we're in a list item
              if (listItem.textContent.trim() === '') {
                consecutiveEnters++;

                if (consecutiveEnters === 2) {
                  e.preventDefault();
                  consecutiveEnters = 0;

                  const list = listItem.parentElement;
                  // Remove the empty list item
                  listItem.remove();

                  // If it was the last item, remove the whole list
                  if (list.children.length === 0) {
                    list.remove();
                  }

                  // Insert a new paragraph
                  document.execCommand('insertParagraph', false, null);
                  updateToolbar();
                }
              } else {
                consecutiveEnters = 0;
              }
            } else {
              consecutiveEnters = 0;
            }
          } else if (e.key === 'Backspace') {
            const selection = window.getSelection();
            const range = selection.getRangeAt(0);
            const currentNode = range.startContainer;
            const listItem = currentNode.closest('li');

            if (listItem) {
              // If we're at the start of a list item
              if (isAtStartOfBlock(range)) {
                e.preventDefault();

                const list = listItem.parentElement;
                const newParagraph = document.createElement('p');
                newParagraph.innerHTML = listItem.innerHTML;

                if (list.children.length === 1) {
                  // If it's the only item, replace the whole list
                  list.parentNode.replaceChild(newParagraph, list);
                } else {
                  // Get the next sibling before removing the list item
                  const nextSibling = listItem.nextElementSibling;
                  listItem.remove();

                  // Insert the new paragraph in the correct position
                  if (nextSibling) {
                    list.insertBefore(newParagraph, nextSibling);
                  } else {
                    list.appendChild(newParagraph);
                  }
                }

                // Set cursor to the new paragraph
                const newRange = document.createRange();
                newRange.selectNodeContents(newParagraph);
                newRange.collapse(false);
                selection.removeAllRanges();
                selection.addRange(newRange);

                updateToolbar();
              }
            }
          } else {
            consecutiveEnters = 0;
          }
        });

        // Preview functionality
        function togglePreview() {
          const preview = document.getElementById('preview');
          previewMode = !previewMode;

          if (previewMode) {
            preview.innerHTML = editor.innerHTML;
            preview.classList.remove('hidden');
          } else {
            preview.classList.add('hidden');
          }
        }

        // Update preview in real-time
        editor.addEventListener('input', function() {
          if (previewMode) {
            document.getElementById('preview').innerHTML = editor.innerHTML;
          }
          updateToolbar();
        });

        // When editor gets focus or content changes
        editor.addEventListener('focus', updateToolbar);
        editor.addEventListener('input', updateToolbar);

        // Make sure the editor always has focus where clicked
        editor.addEventListener('click', function() {
          editor.focus();
        });
      </script>

      <style>
        #editor:empty:before {
          content: 'Enter your content here...';
          color: #9CA3AF;
        }

        #editor {
          min-height: 150px;
        }

        #editor ul,
        .prose ul {
          list-style-type: disc;
          padding-left: 2em;
          margin: 1em 0;
        }

        #editor ol,
        .prose ol {
          list-style-type: decimal;
          padding-left: 2em;
          margin: 1em 0;
        }

        .prose li {
          margin: 0.5em 0;
        }

        .news-content ul {
          list-style-type: disc !important;
          padding-left: 2em !important;
          margin: 1em 0 !important;
        }

        .news-content ol {
          list-style-type: decimal !important;
          padding-left: 2em !important;
          margin: 1em 0 !important;
        }

        .news-content li {
          display: list-item !important;
          margin: 0.5em 0 !important;
        }

        .news-content li::marker {
          display: inline !important;
        }

        /* Pagination Styles */
        .pagination {
            @apply inline-flex shadow-sm rounded-md;
        }
        .pagination > * {
            @apply px-3 py-2 bg-white border text-sm font-medium;
            min-width: 4rem;
            text-align: center;
        }
        .pagination span.current {
            @apply bg-indigo-50 text-indigo-600 border-indigo-500;
        }
        .pagination a {
            @apply text-gray-700 hover:bg-gray-50;
        }
      </style>
    @endpush
  @endsection

</html>
