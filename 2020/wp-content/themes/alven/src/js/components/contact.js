import { gsap } from 'gsap';
import { ScrollToPlugin } from 'gsap/ScrollToPlugin.js';

gsap.registerPlugin(ScrollToPlugin);

const contact = () => {
    const contact = document.getElementById('contact');

    if (!contact) return;

    const forms = contact.querySelectorAll('.form-to-open');

    const openForm = (form, btn) => {
        gsap.to(form, 0.3, { minHeight: form.querySelector('.form').clientHeight, height: 'auto', y: -45 });

        forms.forEach(elt => {
            if (elt.classList.contains('on'))
                gsap.to(elt, 0.3, {
                    height: 0,
                    minHeight: 0,
                    y: 0,
                    onComplete: () => {
                        elt.classList.remove('on');
                        elt.parentNode.querySelector('.open-form').classList.remove('off');
                    }
                });
        });

        form.classList.add('on');
        btn.classList.add('off');
    };

    const handleForm = btn => {
        const form = btn.parentNode.querySelector('.form-to-open');

        if (form.classList.contains('form-open-error')) {
            openForm(form, btn);
        }

        btn.addEventListener(
            'click',
            () => {
                openForm(form, btn);
            },
            false
        );
    };

    contact.querySelectorAll('.open-form').forEach(btn => {
        handleForm(btn);
    });
};

export default contact;
