/*! Main | https://wow-cms.com | (c) 2019 - 2022 WoW-CMS | MIT License */

document.addEventListener('DOMContentLoaded', (event) => {
  if (typeof tail.select === 'function') {
    tail.select('.tail-single', {
      deselect: true,
      hideSelected: true,
      search: true
    });
  
    tail.select('.tail-multiple', {
      hideSelected: true,
      multiShowCount: false,
      multiContainer: true,
      search: true
    });
  }

  if (typeof PureCounter === 'function') {
    new PureCounter();
  }
});

document.querySelectorAll('.bc-show-group').forEach((group) => {
  let inputs = group.querySelectorAll('input[type="radio"]')
  let values = [...inputs].map((item) => {
    return item.value;
  });

  inputs.forEach((element) => {
    let idPrefix = element.getAttribute('name') + '_';

    if (element.checked) {
      let showElement = document.getElementById(idPrefix + element.value);

      if (showElement) {
        showElement.hidden = false;
      }
    }

    element.addEventListener('change', (e) => {
      let filtered = values.filter((value, index, arr) => {
        return value !== e.target.value && value !== '';
      });

      filtered.forEach((item, index) => {
        let hiddenElement = document.getElementById(idPrefix + item);

        if (hiddenElement === null) return;

        hiddenElement.hidden = true;
      });

      if (e.target.checked) {
        let showElement = document.getElementById(idPrefix + e.target.value);

        if (showElement === null) return;

        showElement.hidden = false;
      }
    });
  });
});

const avatarInput = document.querySelector('input#avatar_input');

if (avatarInput) {
  avatarInput.addEventListener('change', (event) => {
    let selectedFile = event.target.files[0];
    let fileType = selectedFile.type;

    if (!selectedFile || !fileType.match('image.*')) return;

    let fileReader = new FileReader();

    fileReader.addEventListener('load', (event) => {
      let buffer = event.target.result;
      let blob = new Blob([new Uint8Array(buffer)], { type: fileType });
      let url = window.URL.createObjectURL(blob);

      let img = document.querySelector('img#avatar_img');

      if (img === null) return;

      img.src = url;
    }, false);

    fileReader.readAsArrayBuffer(selectedFile);
  }, false);
}
