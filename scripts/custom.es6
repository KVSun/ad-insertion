import polyfill from './std-js/polyfills.es6';
import {reportError, parseResponse} from './std-js/functions.es6';
import handleJSON from './std-js/json_response.es6';
import {supportsAsClasses} from "./std-js/support_test.es6";
// import popState from "./std-js/popstate.es6";
import {default as $, zQ} from './std-js/zq.es6';
import * as mutations from './mutations.es6';

zQ.prototype.bootstrap = mutations.bootstrap;

polyfill();
// popState();

supportsAsClasses('svg', 'audio', 'video', 'picture', 'canvas', 'menuitem',
'details', 'dialog', 'dataset', 'HTMLimports', 'classList', 'connectivity',
'visibility', 'notifications', 'ApplicationCache', 'indexedDB',
'localStorage', 'sessionStorage', 'CSSgradients', 'transitions',
'animations', 'CSSvars', 'CSSsupports', 'CSSmatches', 'querySelectorAll',
'workers', 'promises', 'ajax', 'FormData');

$(document.body).bootstrap().watch(
	mutations.watcher,
	mutations.config,
	mutations.attributeTree
);
