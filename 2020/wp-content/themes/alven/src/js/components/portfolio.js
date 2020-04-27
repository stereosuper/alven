const portfolio = () => {
    const portfolio = document.getElementById('portfolio');
    const filters = document.getElementById('portfolio-filters');

    if (!portfolio || !filters) return;

    const btns = filters.querySelectorAll('button');
    let filterName = '';

    btns.forEach(btn => {
        btn.addEventListener(
            'click',
            () => {
                filterName = btn.dataset.filter;

                portfolio.querySelectorAll('li').forEach(link => {
                    link.dataset[filterName].split(',').includes(btn.dataset[filterName])
                        ? link.classList.remove('off')
                        : link.classList.add('off');
                });

                btns.forEach(elt => {
                    elt.classList.remove('on');
                });
                btn.classList.add('on');
            },
            false
        );
    });
};

export default portfolio;
