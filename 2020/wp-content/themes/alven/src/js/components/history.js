import { forEach } from '@stereorepo/sac';

const history = () => {
    const history = document.getElementById('history');
    const filters = document.getElementById('periods');

    if (!history || !filters) return;

    const btns = filters.querySelectorAll('button');

    const filter = btn => {
        if (btn.classList.contains('on')) {
            forEach(history.querySelectorAll('.dates'), list => {
                list.classList.remove('off');
            });

            btn.classList.remove('on');

            return;
        }

        forEach(history.querySelectorAll('.dates'), list => {
            list.dataset.period === btn.dataset.field ? list.classList.remove('off') : list.classList.add('off');
        });

        forEach(btns, elt => {
            elt.classList.remove('on');
        });
        btn.classList.add('on');
    };

    forEach(btns, btn => {
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
