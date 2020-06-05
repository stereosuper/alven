import { forEach } from '@stereorepo/sac';

const portfolio = () => {
    const portfolio = document.getElementById('portfolio');
    const filters = document.getElementById('portfolio-filters');

    if (!portfolio || !filters) return;

    const btns = filters.querySelectorAll('.btn-filter');
    const links = portfolio.querySelectorAll('li');
    let filterNames = [];
    let filterName = '';
    let filter = '';

    const sortPortfolio = () => {
        forEach(links, link => {
            if (!filterNames.length) {
                link.classList.remove('off');
                return;
            }

            link.classList.add('off');

            forEach(filterNames, filter => {
                if (!link.dataset[filter.name].split(',').includes(filter.filter)) return;
                link.classList.remove('off');
            });
        });
    };

    const addFilter = () => {
        filterNames.push({ name: filterName, filter: filter });
        sortPortfolio();
    };

    const getFilter = btn => {
        filterName = btn.dataset.filter;
        filter = btn.dataset[filterName];
    };

    const handleFilter = btn => {
        getFilter(btn);

        if (btn.classList.contains('on')) {
            filterNames = filterNames.filter(x => x.filter !== filter);
            sortPortfolio();

            btn.classList.remove('on');
            btn.blur();

            return;
        }

        addFilter();
        btn.classList.add('on');
    };

    forEach(btns, btn => {
        if (btn.classList.contains('on')) {
            getFilter(btn);
            addFilter();
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
