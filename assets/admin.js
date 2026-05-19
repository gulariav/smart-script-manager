(function () {
    function activateTab(container, targetId) {
        var buttons = container.querySelectorAll('[data-ssm-tab]');
        var panels = container.querySelectorAll('.ssm-tab-panel');

        buttons.forEach(function (button) {
            var isActive = button.getAttribute('data-ssm-tab') === targetId;
            button.classList.toggle('is-active', isActive);
            button.setAttribute('aria-selected', isActive ? 'true' : 'false');
        });

        panels.forEach(function (panel) {
            var isActive = panel.id === targetId;
            panel.classList.toggle('is-active', isActive);
            panel.hidden = !isActive;
        });
    }

    function escapeHtml(text) {
        return text
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function syncEditor(editor) {
        var textarea = editor.querySelector('[data-ssm-lined-editor]');
        var gutter = editor.querySelector('[data-ssm-lines]');

        if (!textarea || !gutter) {
            return;
        }

        var lineCount = textarea.value.split('\n').length;
        var lines = '';
        var index;

        for (index = 1; index <= lineCount; index += 1) {
            lines += '<div class="ssm-code-editor__line">' + escapeHtml(String(index)) + '</div>';
        }

        gutter.innerHTML = lines;
        gutter.scrollTop = textarea.scrollTop;
    }

    document.addEventListener('DOMContentLoaded', function () {
        var tabGroups = document.querySelectorAll('[data-ssm-tabs]');
        var editors = document.querySelectorAll('[data-ssm-editor]');

        tabGroups.forEach(function (container) {
            container.addEventListener('click', function (event) {
                var button = event.target.closest('[data-ssm-tab]');

                if (!button) {
                    return;
                }

                activateTab(container, button.getAttribute('data-ssm-tab'));
            });
        });

        editors.forEach(function (editor) {
            var textarea = editor.querySelector('[data-ssm-lined-editor]');

            if (!textarea) {
                return;
            }

            syncEditor(editor);

            textarea.addEventListener('input', function () {
                syncEditor(editor);
            });

            textarea.addEventListener('scroll', function () {
                syncEditor(editor);
            });
        });
    });
}());
