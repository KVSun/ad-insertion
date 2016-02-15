import {default as polyfill} from './std-js/polyfills.es6';
import {reportError, parseResponse} from './std-js/functions.es6';
import {default as handleJSON} from './std-js/json_response.es6';
import {supports, supportsAsClasses} from "./std-js/support_test.es6";
import {default as popState} from "./std-js/popstate.es6";
import {default as $, zQ} from './std-js/zq.es6';
import * as mutations from './mutations.es6';

polyfill();

supportsAsClasses('svg', 'audio', 'video', 'picture', 'canvas', 'menuitem',
'details', 'dialog', 'dataset', 'HTMLimports', 'classList', 'connectivity',
'visibility', 'notifications', 'ApplicationCache', 'indexedDB',
'localStorage', 'sessionStorage', 'CSSgradients', 'transitions',
'animations', 'CSSvars', 'CSSsupports', 'CSSmatches', 'querySelectorAll',
'workers', 'promises', 'ajax', 'FormData');

zQ.prototype.bootstrap = mutations.bootstrap;

popState();

$(self).load(event => {
	$(document.body).bootstrap().watch(
		mutations.watcher,
		mutations.config,
		mutations.attributeTree
	);
});
