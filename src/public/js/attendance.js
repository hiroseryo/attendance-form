document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('.buttons form');

    forms.forEach(function(form) {
        form.addEventListener('submit', function() {
            const button = form.querySelector('button');
            button.disabled = true;
        });
    });
});