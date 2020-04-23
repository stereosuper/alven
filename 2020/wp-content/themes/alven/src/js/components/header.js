const header = () => {
    const burger = document.getElementById('burger');
    const close = document.getElementById('close');
    const nav = document.getElementById('nav');

    if (!burger || !nav || !close) return;

    burger.addEventListener(
        'click',
        () => {
            nav.classList.add('on');
        },
        false
    );

    close.addEventListener(
        'click',
        () => {
            nav.classList.remove('on');
        },
        false
    );
};

export default header;
