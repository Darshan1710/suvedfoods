import { escapeAttribute } from "@wordpress/escape-html";
const el = wp.element.createElement;
const icons = {};
icons.speafIcon = el('img', {src: escapeAttribute( sp_easy_accordion_free.url + 'admin/GutenbergBlock/src/easy-accordion-icon.svg' )})
export default icons;