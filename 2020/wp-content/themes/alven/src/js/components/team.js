const team = () => {
    const team = document.getElementById('team');

    if (!team) return;

    const members = team.querySelectorAll('.team-member');
    const nbMembers = members.length;
    const desc = document.createElement('div');
    let index;

    desc.className = 'container wrapper-desc';

    members.forEach(member => {
        member.addEventListener(
            'click',
            () => {
                index = (Math.floor([].indexOf.call(members, member) / 5) + 1) * 5 - 1;
                index = index > nbMembers ? nbMembers - 1 : index;

                desc.innerHTML = '';
                desc.appendChild(member.parentElement.querySelector('.team-desc').cloneNode(true));

                members[index].parentElement.after(desc);
            },
            false
        );
    });
};

export default team;
