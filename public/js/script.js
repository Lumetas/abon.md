// Инициализация редактора с отключенным тулбаром
const easymde = new EasyMDE({
    element: document.getElementById('my-text-area'),
    toolbar: [
        "bold", "italic", "heading", "|",
        "quote", "unordered-list", "ordered-list", "|",
        "link", "image", "|",
        "preview", "|",
        "guide"
    ],
    // toolbar: false, // Полностью отключаем тулбар
    status: false, // Отключаем статус бар
    spellChecker: false, // Отключаем проверку орфографии
    autosave: {
        enabled: false // Отключаем автосохранение (будем сохранять вручную)
    },
    indentWithTabs: false,
    tabSize: 4,
    minHeight: '500px',
    placeholder: 'Начните писать здесь...'
});
//для управления редактором
window.abonEditor = {
    getContent: () => easymde.value(),
    setContent: (str) => easymde.value(str),
    clear: () => easymde.value(''),
    focus: () => easymde.codemirror.focus(),

    // Функция сохранения
    save: async function() {
        try {
            const response = await fetch('{{ route("editor.save") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    content: this.getContent()
                })
            });

            const data = await response.json();
            if (data.status === 'success') {
                this.showToast('Сохранено успешно');
            }
            return data;
        } catch (error) {
            console.error('Ошибка сохранения:', error);
            this.showToast('Ошибка при сохранении', false);
            return { status: 'error', message: error.message };
        }
    },

    // Вспомогательная функция для уведомлений
    showToast: (message, success = true) => {
        const toast = document.createElement('div');
        toast.style.position = 'fixed';
        toast.style.bottom = '20px';
        toast.style.right = '20px';
        toast.style.padding = '10px 20px';
        toast.style.background = success ? '#4CAF50' : '#F44336';
        toast.style.color = 'white';
        toast.style.borderRadius = '4px';
        toast.style.zIndex = '10000';
        toast.textContent = message;

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.remove();
        }, 1500);
    }
};

// Обработка горячих клавиш
document.addEventListener('keydown', function(event) {
    // Ctrl+S - сохранение
    if ((event.ctrlKey || event.metaKey) && event.code === 'KeyS') {
        event.preventDefault(); // Предотвращаем стандартное сохранение страницы
        window.abonEditor.save();
        return false;
    }

    // Ctrl+M - переключение preview (если нужно)
    if ((event.ctrlKey || event.metaKey) && event.code === 'KeyM') {
        event.preventDefault();
        easymde.togglePreview()
        return false;

    }
});

// Фокус на редакторе при загрузке
document.addEventListener('DOMContentLoaded', function() {
    easymde.codemirror.focus();

    // Автосохранение каждые 30 секунд (опционально)
    setInterval(() => {
        window.abonEditor.save();
    }, 30000);
});

// Экспорт для использования в других модулях
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { easymde, abonEditor };
}

function addButtonInToolBar(fa, callback){
    const saveBtn = document.createElement('button');
    let i = document.createElement('i');
    i.classList = fa;
    saveBtn.appendChild(i);
    saveBtn.onclick = callback;
    document.querySelector('.editor-toolbar').appendChild(saveBtn);
}

function addSeperatorInToolBar() {
    let i = document.createElement('i');
    i.classList = "separator";
    i.innerHTML = "|";
    document.querySelector('.editor-toolbar').appendChild(i);
}

addSeperatorInToolBar();
addButtonInToolBar("fa fa-save", function(){window.abonEditor.save();});