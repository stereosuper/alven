const slider = () => {
    const slider = document.getElementById('slider');
    const nav = document.getElementById('slider-nav');

    if (!slider || !nav) return;

    const slides = slider.querySelectorAll('.slide');
    const btns = nav.querySelectorAll('button');

    btns.forEach(btn => {
        btn.addEventListener(
            'click',
            () => {
                slides.forEach(slide => {
                    slide.classList.remove('on');
                });
                slider.querySelector('[data-startup="' + btn.dataset.slide + '"').classList.add('on');

                btns.forEach(elt => {
                    elt.classList.remove('on');
                });
                btn.classList.add('on');
                btn.blur();
            },
            false
        );
    });
};

export default slider;
