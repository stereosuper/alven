import { forEach } from '@stereorepo/sac';

const portfolio = () => {
    const portfolio = document.getElementById('portfolio');
    const filters = document.getElementById('portfolio-filters');

    if (!portfolio || !filters) return;

    const btns = filters.querySelectorAll('.btn-filter');
    const links = portfolio.querySelectorAll('li');
    let filterName = '';

    const sortPortfolio = btn => {
        filterName = btn.dataset.filter;

        forEach(links, link => {
            link.dataset[filterName].split(',').includes(btn.dataset[filterName])
                ? link.classList.remove('off')
                : link.classList.add('off');
        });
    };

    const handleFilter = btn => {
        if (btn.classList.contains('on')) {
            forEach(links, link => {
                link.classList.remove('off');
            });

            btn.classList.remove('on');
            btn.blur();

            return;
        }

        sortPortfolio(btn);

        forEach(btns, elt => {
            elt.classList.remove('on');
        });
        btn.classList.add('on');
    };

    forEach(btns, btn => {
        if (btn.classList.contains('on')) {
            sortPortfolio(btn);
        }

        btn.addEventListener(
            'click',
            () => {
                handleFilter(btn);
            },
            false
        );
    });
};

export default portfolio;
