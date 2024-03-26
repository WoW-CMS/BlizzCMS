if (typeof tinymce.init === 'function') {
  tinymce.init({
    selector: 'textarea.tmce-comment',
    license_key: 'gpl',
    element_format: 'html',
    schema: 'html5-strict',
    entity_encoding: 'raw',
    branding: false,
    height: 200,
    menubar: false,
    statusbar: false,
    convert_urls: false,
    plugins: 'preview searchreplace autolink directionality link advlist lists emoticons',
    toolbar: 'bold italic underline strikethrough | numlist bullist | emoticons link | removeformat',
    toolbar_location: 'bottom',
    toolbar_mode: 'floating',
    invalid_elements: 'h1,h2,h3,h4,h5,h6,pre,code',
    invalid_styles: 'color background-color font-size'
  });
}
