const contact = () => {
    const contact = document.getElementById('contact');

    if (!contact) return;

    const forms = contact.querySelectorAll('.form-to-open');
    let form;

    contact.querySelectorAll('.open-form').forEach(btn => {
        form = btn.parentNode.querySelector('.form-to-open');

        if (form.classList.contains('form-open-error')) {
            form.classList.add('on');
            form.parentNode.querySelector('.open-form').classList.add('off');
        }

        btn.addEventListener(
            'click',
            () => {
                forms.forEach(form => {
                    form.classList.remove('on');
                    form.parentNode.querySelector('.open-form').classList.remove('off');
                });
                form.classList.add('on');
                btn.classList.add('off');
            },
            false
        );
    });
};

export default contact;
