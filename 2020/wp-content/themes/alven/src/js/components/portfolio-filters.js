const portfolio = () => {
    const portfolio = document.getElementById('portfolio');
    const filters = document.getElementById('portfolio-filters');

    if (!portfolio || !filters) return;

    const btns = filters.querySelectorAll('.btn-filter');
    const links = portfolio.querySelectorAll('li');
    let filterName = '';

    const filter = btn => {
        filterName = btn.dataset.filter;

        links.forEach(link => {
            link.dataset[filterName].split(',').includes(btn.dataset[filterName])
                ? link.classList.remove('off')
                : link.classList.add('off');
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

export default portfolio;
