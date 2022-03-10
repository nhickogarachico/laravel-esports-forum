var sortMenuButton = document.getElementById('sortMenuButton');
var sortMenuContainer = document.getElementById('sortMenuContainer');

sortMenuButton.addEventListener('click', () => {
    sortMenuContainer.style.display = 'block';
})

document.addEventListener("click", (e) => {
    const withinBoundaries = e.composedPath().includes(sortMenuButton);
    if (!withinBoundaries) sortMenuContainer.style.display = 'none';
});