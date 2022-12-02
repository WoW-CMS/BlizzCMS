if (typeof tinymce.init === 'function') {
  tinymce.init({
    selector: 'textarea.tmce-content',
    element_format: 'html',
    schema: 'html5-strict',
    entity_encoding: 'raw',
    branding: false,
    menubar: false,
    statusbar: false,
    convert_urls: false,
    plugins: 'preview searchreplace autolink directionality image link media advlist lists emoticons table',
    toolbar: 'bold italic underline strikethrough | fontsizeselect formatselect | forecolor casechange | emoticons | image link media | alignment | numlist bullist | table | removeformat',
    toolbar_mode: 'floating',
    invalid_elements: 'pre,code',
    invalid_styles: 'background-color',
    fontsize_formats: '8px 10px 12px 14px 16px',
    setup: (editor) => {
      editor.ui.registry.addGroupToolbarButton('alignment', {
        icon: 'align-left',
        tooltip: 'Alignment',
        items: 'alignleft aligncenter alignright alignjustify'
      });
    }
  });
}
