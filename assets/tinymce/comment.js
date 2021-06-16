tinymce.init({
  selector: '.textarea-comment',
  element_format : 'html',
  schema: 'html5-strict',
  entity_encoding : 'raw',
  branding: false,
  menubar: false,
  statusbar: false,
  plugins: ['preview searchreplace autolink directionality image link advlist lists emoticons'],
  toolbar: 'bold italic underline strikethrough | numlist bullist | emoticons image link | removeformat',
  toolbar_location: 'bottom',
  toolbar_mode: 'floating',
  invalid_elements: 'h1,h2,h3,h4,h5,h6,pre,code',
  invalid_styles: 'color background-color font-size',
  image_description: false,
  custom_colors: false,
  paste_as_text: true
});