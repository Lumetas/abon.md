<!DOCTYPE html>
<html lang="en">
<head>
    @csrf
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>abon.md</title>
    <link rel="stylesheet" href="{{ asset('css/colorscheme.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>
<body>
    <textarea id="my-text-area">{{ $content ?? '' }}</textarea>

    <script src="{{ asset('js/easymde.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editor = document.querySelector('.EasyMDEContainer .CodeMirror');
            if (editor) {
                editor.CodeMirror.focus();
            }
        });

        window.abonEditor.save = async function () {
            fetch('{{ $saveUrl }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                content: window.abonEditor.getContent()
            })
        })

        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                this.showToast('Сохранено успешно');
            } else {
                this.showToast('Ошибка при сохранении', false);
            }
            
        });
        }
    </script>
</body>
</html>
