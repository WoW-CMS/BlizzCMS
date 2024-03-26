/*! Media Preview | https://wow-cms.com | (c) 2019 - 2023 WoW-CMS | MIT License */

document.querySelectorAll('input.mfp-input').forEach((mfp) => {
  mfp.addEventListener('change', (event) => {
    let selectedFile = event.target.files[0];
    let fileType = selectedFile.type;

    if (!selectedFile || !fileType.match('image.*|video.*')) return;

    if (!('container' in event.target.dataset)) return;

    let container = document.getElementById(event.target.dataset.container);

    if (container === null) return;

    container.innerHTML = '';

    let cover = document.createElement('div');

    cover.classList.add('uk-cover-container', 'uk-height-small');
    container.appendChild(cover);

    let fileReader = new FileReader();

    fileReader.addEventListener('load', (event) => {
      let buffer = event.target.result;
      let blob = new Blob([new Uint8Array(buffer)], { type: fileType });
      let url = window.URL.createObjectURL(blob);

      if (fileType.match('image.*')) {
        let img = document.createElement('img');

        img.src = url;
        img.setAttribute('alt', 'Preview');
        img.setAttribute('uk-cover', '');
        cover.appendChild(img);
      }

      if (fileType.match('video.*')) {
        let video = document.createElement('video');

        video.src = url;
        video.setAttribute('controls', '');
        video.setAttribute('uk-cover', '');
        cover.appendChild(video);
      }
    }, false);

    fileReader.readAsArrayBuffer(selectedFile);
  }, false);
});
