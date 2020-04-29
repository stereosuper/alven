const contact = () => {
    const contact = document.getElementById('contact');

    if (!contact) return;

    const forms = contact.querySelectorAll('.form-to-open');

    const handleForm = btn => {
        const form = btn.parentNode.querySelector('.form-to-open');

        if (form.classList.contains('form-open-error')) {
            form.classList.add('on');
            btn.classList.add('off');
        }

        btn.addEventListener(
            'click',
            () => {
                forms.forEach(elt => {
                    elt.classList.remove('on');
                    elt.parentNode.querySelector('.open-form').classList.remove('off');
                });

                form.classList.add('on');
                btn.classList.add('off');
            },
            false
        );
    };

    contact.querySelectorAll('.open-form').forEach(btn => {
        handleForm(btn);
    });
};

export default contact;
