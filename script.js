document.addEventListener('keydown', function(event) {
	
	if ((event.ctrlKey || event.metaKey) && (event.code === "KeyM")) {
		// Отменяем стандартное действие (открытие диалога печати)
		event.preventDefault();
		// Вызываем вашу функцию

		document.querySelector(".preview.no-disable").click();
	}
});

