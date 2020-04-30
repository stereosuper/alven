const search = () => {
    const form = document.getElementById('form-search-header');

    if (!form) return;

    const field = form.querySelector('#search-header');
    const input = field.querySelector('input');

    const openForm = () => {
        field.classList.add('on');
    };

    const closeForm = () => {
        if (!input.value) field.classList.remove('on');
    };

    form.addEventListener('mouseenter', openForm, false);
    form.addEventListener('focusin', openForm, false);

    form.addEventListener('mouseleave', closeForm, false);
    form.addEventListener('focusout', closeForm, false);

    form.addEventListener(
        'submit',
        e => {
            if (!input.value) e.preventDefault();
        },
        false
    );
};

export default search;
