/**
 * @Author: Roni Laukkarinen
 * @Date:   2021-02-19 16:41:37
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2021-12-16 22:16:52
 */
// Dependencies
const {
  watch,
  series
} = require('gulp');
const bs = require('browser-sync').create();
const config = require('../config.js');
const {
  handleError
} = require('../helpers/handle-errors.js');

// Task
function watchfiles() {
  bs.init(config.browsersync.src, config.browsersync.opts);
  watch(config.styles.watch.development, series('devstyles')).on('error', handleError());
  watch(config.styles.watch.production, series('prodstyles')).on('error', handleError());
};

exports.watch = watchfiles;
