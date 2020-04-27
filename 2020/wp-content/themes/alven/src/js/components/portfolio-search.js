const portfolio = () => {
    const portfolio = document.getElementById('portfolio');
    const search = document.getElementById('form-startup');

    if (!portfolio || !search) return;

    const input = search.querySelector('#search-startup');
    const links = portfolio.querySelectorAll('li');

    const filter = () => {
        links.forEach(link => {
            link.dataset.name.includes(input.value) ? link.classList.remove('s-off') : link.classList.add('s-off');
        });
    };

    input.addEventListener('input', filter, false);
    search.addEventListener(
        'submit',
        e => {
            e.preventDefault();
            filter();
        },
        false
    );
};

export default portfolio;
