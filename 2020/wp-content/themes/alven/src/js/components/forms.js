const forms = () => {
    const fields = document.querySelectorAll('.js-field');

    if (!fields.length) return;

    fields.forEach(field => {
        field.addEventListener(
            'focusin',
            () => {
                field.querySelector('label').classList.add('off');
            },
            false
        );

        field.addEventListener(
            'focusout',
            () => {
                if (!field.querySelector('.form-elt').value) field.querySelector('label').classList.remove('off');
            },
            false
        );
    });
};

export default forms;
