document.addEventListener('DOMContentLoaded', () => {
    // Route Explorer Tabs Logic
    const regionBtns = document.querySelectorAll('.route-region-btn');
    const portLists = document.querySelectorAll('.port-list');

    regionBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const targetRegion = btn.getAttribute('data-region');

            // Update buttons
            regionBtns.forEach(b => {
                b.classList.remove('active');
                b.setAttribute('aria-selected', 'false');
            });
            btn.classList.add('active');
            btn.setAttribute('aria-selected', 'true');

            // Update panels
            portLists.forEach(panel => {
                if (panel.id === `ports-${targetRegion}`) {
                    panel.classList.add('active');
                } else {
                    panel.classList.remove('active');
                }
            });
        });
    });
});
