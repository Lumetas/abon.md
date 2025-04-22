<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $book }} - abon.md</title>
  <link href="{{ asset('css/colorscheme.css') }}" rel="stylesheet">
  <style>
    * {
      --sidebar-bg: var(--toolbar-background);
      --sidebar-text: var(--text-color);
      --sidebar-border: var(--inline-code-background);
      --sidebar-accent: var(--link-color);
      --sidebar-hover: var(--selection-color);
      --tab-bg: var(--inline-code-background);
      --tab-active-bg: var(--background);
      --tab-text: var(--text-color);
      --tab-close: var(--muted-text);
      --tab-close-hover: var(--bold-color);
      --btn-primary: var(--link-color);
      --btn-danger: var(--bold-color);
      --btn-text: var(--background);
      --input-bg: var(--inline-code-background);
      --input-text: var(--text-color);
      --input-border: var(--muted-text);
      --input-focus: var(--link-color);
      --empty-state: var(--muted-text);
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: sans-serif;
      display: flex;
      height: 100vh;
      overflow: hidden;
      background-color: var(--background);
      color: var(--text-color);
    }

    /* Сайдбар */
    .sidebar {
      width: 300px;
      background: var(--sidebar-bg);
      border-right: 1px solid var(--sidebar-border);
      height: 100vh;
      transition: transform 0.3s;
      display: flex;
      flex-direction: column;
    }

    .sidebar-header {
      padding: 15px;
      font-weight: bold;
      border-bottom: 1px solid var(--sidebar-border);
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: var(--sidebar-bg);
    }

    .sidebar-content {
      padding: 15px;
      overflow-y: auto;
      flex: 1;
    }

    /* Темы (аккордеон) */
    .theme-accordion {
      margin-top: 10px;
    }

    .theme-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 8px 0;
      cursor: pointer;
      border-bottom: 1px solid var(--sidebar-border);
    }

    .theme-header:hover {
      color: var(--sidebar-accent);
    }

    .theme-name {
      font-weight: bold;
    }

    .theme-actions {
      display: flex;
      gap: 5px;
    }

    .notes-list {
      margin-left: 15px;
      padding: 5px 0;
      max-height: 0;
      overflow: hidden;
      opacity:0;
      transition:0.3s;
    }

    .theme-item.active .notes-list {
      max-height: 1000px;
      opacity:1;
    }

    .note-item {
      padding: 5px 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .note-item a {
      color: var(--sidebar-text);
      text-decoration: none;
      flex: 1;
      padding: 3px 0;
    }

    .note-item a:hover {
      color: var(--sidebar-accent);
    }

    /* Основное содержимое */
    .main-content {
      flex: 1;
      display: flex;
      flex-direction: column;
      height: 100vh;
    }

    /* Вкладки */
    .tabs-container {
      display: flex;
      background: var(--tab-bg);
      overflow-x: auto;
    }

    .tab {
      padding: 10px 15px;
      cursor: pointer;
      border-right: 1px solid var(--sidebar-border);
      position: relative;
      white-space: nowrap;
      color: var(--tab-text);
    }

    .tab.active {
      background: var(--tab-active-bg);
    }

    .tab-close {
      margin-left: 8px;
      color: var(--tab-close);
    }

    .tab-close:hover {
      color: var(--tab-close-hover);
    }

    /* Iframe */
    .iframe-container {
      flex: 1;
      position: relative;
    }

    .iframe-container iframe {
      width: 100%;
      height: 100%;
      border: none;
      background: var(--background);
    }

    .empty-state {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
      color: var(--muted-text);
    }

    /* Формы и кнопки */
    .form-group {
      margin-bottom: 15px;
    }

    .form-input {
      padding: 8px;
      background: var(--input-bg);
      border: 1px solid var(--input-border);
      border-radius: 4px;
      color: var(--input-text);
      width: 60%;
    }

    .form-input:focus {
      outline: none;
      border-color: var(--input-focus);
    }

    .btn {
      padding: 5px 10px;
      border-radius: 4px;
      cursor: pointer;
      border: none;
      font-weight: bold;
    }

    .btn-primary {
      background: var(--btn-primary);
      color: var(--btn-text);
    }

    .btn-danger {
      background: var(--btn-danger);
      color: var(--btn-text);
    }

    .btn-sm {
      padding: 3px 6px;
      font-size: 0.8rem;
    }

    /* Мобильная версия */
    .mobile-menu-btn {
      display: none;
      padding: 10px;
      cursor: pointer;
      background: var(--sidebar-bg);
      color: var(--sidebar-text);
      border: none;
    }

    @media (max-width: 768px) {
      .sidebar {
        position: absolute;
        z-index: 1000;
        transform: translateX(-100%);
        width: 280px;
      }

      .sidebar.open {
        transform: translateX(0);
      }

      .mobile-menu-btn {
        display: block;
      }
    }
  </style>
</head>
<body>
  <!-- Сайдбар -->
  <div class="sidebar" id="sidebar">
    <div class="sidebar-header">
      <span>{{ $book }}</span>
      <button class="btn btn-danger" onclick="window.history.back()">Back</button>
    </div>

    <div class="sidebar-content">
      <!-- Форма добавления темы -->
      <form id="add-theme-form" class="form-group">
        <input type="text" name="name" placeholder="New theme name" required class="form-input">
        <button type="submit" class="btn btn-primary mt-2">Add Theme</button>
      </form>

      <!-- Список тем -->
      <div id="themes-container" class="theme-accordion">
        @foreach($themes as $theme)
          <div class="theme-item" data-theme="{{ $theme }}">
            <div class="theme-header">
              <span class="theme-name">{{ $theme }}</span>
              <div class="theme-actions">
                <button class="btn btn-danger btn-sm delete-theme" data-theme="{{ $theme }}">×</button>
              </div>
            </div>

            <div class="notes-list">
              @foreach(Storage::disk('local')->files("vaults/".auth()->id()."/{$book}/{$theme}") as $note)
                @if(Str::endsWith($note, '.md'))
                  <div class="note-item" data-note="{{ basename($note, '.md') }}">
                    <a href="#" class="open-note"
                       data-book="{{ $book }}"
                       data-theme="{{ $theme }}"
                       data-note="{{ basename($note, '.md') }}">
                      {{ basename($note, '.md') }}
                    </a>
                    <button class="btn btn-danger btn-sm delete-note"
                            data-book="{{ $book }}"
                            data-theme="{{ $theme }}"
                            data-note="{{ basename($note, '.md') }}">×</button>
                  </div>
                @endif
              @endforeach

              <div class="form-group mt-2">
                <input type="text" placeholder="Note name" class="form-input note-name-input">
                <button class="btn btn-primary create-note mt-2"
                        data-book="{{ $book }}"
                        data-theme="{{ $theme }}">Create Note</button>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <!-- Основное содержимое -->
  <div class="main-content">
    <!-- Кнопка меню для мобильных -->
    <button class="mobile-menu-btn" id="mobileMenuBtn">☰ Menu</button>

    <!-- Вкладки (только для десктопа) -->
    <div class="tabs-container" id="tabsContainer"></div>

    <!-- Контейнер для iframe -->
    <div class="iframe-container">
      <iframe id="mainIframe"></iframe>
      <div id="emptyState" class="empty-state">
        <p>Select a note to edit</p>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      // Инициализация аккордеона

      // Мобильное меню
      $('#mobileMenuBtn').click(function() {
        $('#sidebar').toggleClass('open');
      });

      // Переключение тем (аккордеон)
      $(document).on('click', '.theme-header', function() {
        $(this).parent().toggleClass('active');
      });

      // Добавление темы
      $('#add-theme-form').submit(function(e) {
        e.preventDefault();
        const themeName = $(this).find('input[name="name"]').val().trim();

        if (!themeName) return;

        $.ajax({
          url: '{{ route("books.themes.store", $book) }}',
          method: 'POST',
          data: {
            _token: '{{ csrf_token() }}',
            name: themeName
          },
          success: function(response) {
            if (response) {
              const themeHtml = `
                <div class="theme-item active" data-theme="${themeName}">
                  <div class="theme-header">
                    <span class="theme-name">${themeName}</span>
                    <div class="theme-actions">
                      <button class="btn btn-danger btn-sm delete-theme" data-theme="${themeName}">×</button>
                    </div>
                  </div>
                  <div class="notes-list">
                    <div class="form-group mt-2">
                      <input type="text" placeholder="Note name" class="form-input note-name-input">
                      <button class="btn btn-primary create-note mt-2"
                              data-book="{{ $book }}"
                              data-theme="${themeName}">Create Note</button>
                    </div>
                  </div>
                </div>
              `;
              $('#themes-container').prepend(themeHtml);
              $('#add-theme-form')[0].reset();
            }
          },
          error: function(xhr) {
            alert('Error: ' + (xhr.responseJSON?.message || 'Failed to add theme'));
          }
        });
      });

      // Удаление темы
      $(document).on('click', '.delete-theme', function(e) {
        e.stopPropagation();
        const themeName = $(this).data('theme');

        if (confirm(`Delete theme "${themeName}" and all its notes?`)) {
          $.ajax({
            url: `{{ route("books.themes.destroy", ["book" => $book, "theme" => "THEME_PLACEHOLDER"]) }}`.replace('THEME_PLACEHOLDER', themeName),
            method: 'DELETE',
            data: {
              _token: '{{ csrf_token() }}'
            },
            success: function(response) {
              if (response) {
                $(`[data-theme="${themeName}"]`).remove();
                closeAllTabsForTheme(themeName);
              }
            },
            error: function(xhr) {
              alert('Error: ' + (xhr.responseJSON?.message || 'Failed to delete theme'));
            }
          });
        }
      });

      // Создание заметки (через открытие несуществующего файла)
      $(document).on('click', '.create-note', function() {
        const theme = $(this).data('theme');
        const book = $(this).data('book');
        const noteName = $(this).siblings('.note-name-input').val().trim();

        if (!noteName) return;

        const url = `{{ route('notes.show', ['book' => 'BOOK_PLACEHOLDER', 'theme' => 'THEME_PLACEHOLDER', 'note' => 'NOTE_PLACEHOLDER']) }}`
          .replace('BOOK_PLACEHOLDER', book)
          .replace('THEME_PLACEHOLDER', theme)
          .replace('NOTE_PLACEHOLDER', noteName);

        // Открываем заметку в iframe (файл будет создан автоматически при сохранении)
        openNoteInIframe(book, theme, noteName, url);

        // Добавляем заметку в список
        const noteHtml = `
          <div class="note-item" data-note="${noteName}">
            <a href="#" class="open-note"
               data-book="${book}"
               data-theme="${theme}"
               data-note="${noteName}">
              ${noteName}
            </a>
            <button class="btn btn-danger btn-sm delete-note"
                    data-book="${book}"
                    data-theme="${theme}"
                    data-note="${noteName}">×</button>
          </div>
        `;

        $(`[data-theme="${theme}"] .notes-list`).prepend(noteHtml);
        $(`[data-theme="${theme}"] .note-name-input`).val('');
      });

      // Удаление заметки
      $(document).on('click', '.delete-note', function() {
        const book = $(this).data('book');
        const theme = $(this).data('theme');
        const note = $(this).data('note');

        if (confirm(`Delete note "${note}"?`)) {
          $.ajax({
            url: `{{ route('notes.delete', ['book' => 'BOOK_PLACEHOLDER', 'theme' => 'THEME_PLACEHOLDER', 'note' => 'NOTE_PLACEHOLDER']) }}`
              .replace('BOOK_PLACEHOLDER', book)
              .replace('THEME_PLACEHOLDER', theme)
              .replace('NOTE_PLACEHOLDER', note + '.md'),
            method: 'DELETE',
            data: {
              _token: '{{ csrf_token() }}'
            },
            success: function(response) {
              if (response) {
                $(`[data-note="${note}"]`).remove();
                closeTabIfOpen(book, theme, note);
              }
            },
            error: function(xhr) {
              alert('Error: ' + (xhr.responseJSON?.message || 'Failed to delete note'));
            }
          });
        }
      });

      // Открытие заметки
      $(document).on('click', '.open-note', function(e) {
        e.preventDefault();
        const book = $(this).data('book');
        const theme = $(this).data('theme');
        const note = $(this).data('note');

        const url = `{{ route('notes.show', ['book' => 'BOOK_PLACEHOLDER', 'theme' => 'THEME_PLACEHOLDER', 'note' => 'NOTE_PLACEHOLDER']) }}`
          .replace('BOOK_PLACEHOLDER', book)
          .replace('THEME_PLACEHOLDER', theme)
          .replace('NOTE_PLACEHOLDER', note);

        openNoteInIframe(book, theme, note, url);
      });

      // Функция для открытия заметки в iframe
      function openNoteInIframe(book, theme, note, url) {
        // На мобильных - просто открываем в основном iframe
        if (window.innerWidth <= 768) {
          $('#mainIframe').attr('src', url);
          $('#emptyState').hide();
          $('#sidebar').removeClass('open');
          return;
        }

        // На десктопе - работаем с вкладками
        const tabId = `tab-${book}-${theme}-${note}`.replace(/\s+/g, '-');
        let $tab = $(`#${tabId}`);

        if ($tab.length === 0) {
          $tab = $(`
            <div class="tab active" id="${tabId}"
                 data-book="${book}"
                 data-theme="${theme}"
                 data-note="${note}">
              ${note}
              <span class="tab-close">×</span>
            </div>
          `);

          $('#tabsContainer').append($tab);
          $('#tabsContainer .tab').not($tab).removeClass('active');
        } else {
          $('#tabsContainer .tab').removeClass('active');
          $tab.addClass('active');
        }

        $('#mainIframe').attr('src', url);
        $('#emptyState').hide();
      }

      // Закрытие вкладки
      $(document).on('click', '.tab-close', function(e) {
        e.stopPropagation();
        const $tab = $(this).parent();
        $tab.remove();

        const $lastTab = $('#tabsContainer .tab').last();
        if ($lastTab.length) {
          $lastTab.addClass('active');
          const book = $lastTab.data('book');
          const theme = $lastTab.data('theme');
          const note = $lastTab.data('note');

          const url = `{{ route('notes.show', ['book' => 'BOOK_PLACEHOLDER', 'theme' => 'THEME_PLACEHOLDER', 'note' => 'NOTE_PLACEHOLDER']) }}`
            .replace('BOOK_PLACEHOLDER', book)
            .replace('THEME_PLACEHOLDER', theme)
            .replace('NOTE_PLACEHOLDER', note);

          $('#mainIframe').attr('src', url);
        } else {
          $('#mainIframe').attr('src', '');
          $('#emptyState').show();
        }
      });

      // Переключение между вкладками
      $(document).on('click', '.tab', function() {
        if ($(this).hasClass('active')) return;

        $('#tabsContainer .tab').removeClass('active');
        $(this).addClass('active');

        const book = $(this).data('book');
        const theme = $(this).data('theme');
        const note = $(this).data('note');

        const url = `{{ route('notes.show', ['book' => 'BOOK_PLACEHOLDER', 'theme' => 'THEME_PLACEHOLDER', 'note' => 'NOTE_PLACEHOLDER']) }}`
          .replace('BOOK_PLACEHOLDER', book)
          .replace('THEME_PLACEHOLDER', theme)
          .replace('NOTE_PLACEHOLDER', note);

        $('#mainIframe').attr('src', url);
      });

      // Закрытие вкладки если она открыта
      function closeTabIfOpen(book, theme, note) {
        const tabId = `tab-${book}-${theme}-${note}`.replace(/\s+/g, '-');
        $(`#${tabId}`).remove();

        if ($('#tabsContainer .tab').length === 0) {
          $('#mainIframe').attr('src', '');
          $('#emptyState').show();
        }
      }

      // Закрытие всех вкладок для темы
      function closeAllTabsForTheme(theme) {
        $(`#tabsContainer .tab[data-theme="${theme}"]`).remove();

        if ($('#tabsContainer .tab').length === 0) {
          $('#mainIframe').attr('src', '');
          $('#emptyState').show();
        } else {
          const $lastTab = $('#tabsContainer .tab').last();
          $lastTab.addClass('active');
          const book = $lastTab.data('book');
          const note = $lastTab.data('note');

          const url = `{{ route('notes.show', ['book' => 'BOOK_PLACEHOLDER', 'theme' => 'THEME_PLACEHOLDER', 'note' => 'NOTE_PLACEHOLDER']) }}`
            .replace('BOOK_PLACEHOLDER', book)
            .replace('THEME_PLACEHOLDER', theme)
            .replace('NOTE_PLACEHOLDER', note);

          $('#mainIframe').attr('src', url);
        }
      }
    });
  </script>
</body>
</html>
