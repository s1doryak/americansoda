/**
 * Trumbowyg default options
 * @see https://alex-d.github.io/Trumbowyg/documentation/#button-pane
 */
$.trumbowygDefaultOptions = {
    lang: $('html').attr('lang'),
    defaultLinkTarget: '_blank',
    autogrow: true,
    btns: [
        ['link'],
        ['formatting'],
        ['justifyLeft', 'justifyCenter', 'justifyRight'],
        ['unorderedList', 'orderedList'],
        ['strong', 'em', 'del'],
        ['removeformat'],
    ]
};

/**
 * SVG icons
 * @see https://alex-d.github.io/Trumbowyg/documentation/#svg-icons
 * @type {string}
 */
$.trumbowyg.svgPath = '/vendor/material-admin/img/trumbowyg/icons.svg';
