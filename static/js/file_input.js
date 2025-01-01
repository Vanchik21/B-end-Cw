const file = document.querySelector('#file');
const chosenFiles = document.querySelector('.chosen-files');

function showChosenFiles() {
    let fullPath = file.value;
    let startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
    let filename = fullPath.substring(startIndex);
    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
        filename = filename.substring(1);
    }
    chosenFiles.textContent = filename;
}

file.addEventListener('change', showChosenFiles);