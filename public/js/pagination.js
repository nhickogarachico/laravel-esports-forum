var buttonPositions = ['Top', 'Bottom']

var initializeGoToPage = (position) => {
    var goToPageButton = document.getElementById(`goToPageButton${position}`)
    var goToPageContainer = document.querySelector(`.goToPageContainer${position}`)
    var goToPageInput = document.querySelector(`.goToPageInput${position}`)
    var goToPageSubmitButton = document.querySelector(`#goToPageSubmitButton${position}`)

    goToPageButton.addEventListener('click', () => {
        goToPageContainer.style.display = 'block'
    })

    document.addEventListener("click", (e) => {
        const withinBoundaries = e.composedPath().includes(goToPageButton);
        if (!withinBoundaries) goToPageContainer.style.display = 'none';
    });

    goToPageSubmitButton.addEventListener('click', () => {
        window.location.href = `?pageNumber=${goToPageInput.value}`;
    })
}

if (document.getElementById('goToPageButtonTop') || document.getElementById('goToPageButtonBottom')) {

    buttonPositions.map((position) => {
        initializeGoToPage(position)
    })


}