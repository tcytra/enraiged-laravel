import axios from 'axios';
//import { trans, getActiveLanguage, loadLanguageAsync } from 'laravel-vue-i18n';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

//window.ai18n = loadLanguageAsync;
//window.i18n = trans;
//window.lang = getActiveLanguage;
