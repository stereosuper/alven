const history = () => {
    const history = document.getElementById('history');
    const filters = document.getElementById('periods');

    if (!history || !filters) return;

    const btns = filters.querySelectorAll('button');

    const filter = btn => {
        history.querySelectorAll('.dates').forEach(list => {
            list.dataset.period === btn.dataset.field ? list.classList.remove('off') : list.classList.add('off');
        });

        btns.forEach(elt => {
            elt.classList.remove('on');
        });
        btn.classList.add('on');
    };

    btns.forEach(btn => {
        btn.addEventListener(
            'click',
            () => {
                filter(btn);
            },
            false
        );
    });
};

export default history;
