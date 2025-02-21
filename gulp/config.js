/**
 * @Author: Roni Laukkarinen
 * @Date:   2021-02-26 13:23:08
 * @Last Modified by:   Roni Laukkarinen
 * @Last Modified time: 2021-12-16 22:16:26
 */
const assetDir = 'assets/';

module.exports = {
  cleancss: {
    opts: {
      compatibility: '-properties.merging',
      level: {
        1: {
          optimizeFont: false,
          optimizeFontWeight: false,
          optimizeOutline: false,
          specialComments: false,
          removeQuotes: false,
          removeWhitespace: false,
          removeEmpty: false,
          tidyAtRules: false,
          tidyBlockScopes: false,
          tidySelectors: false,
          cleanupCharsets: false,
          replaceMultipleZeros: false,
        },
        2: {
          mergeAdjacentRules: false,
          mergeIntoShorthands: false,
          mergeMedia: false,
          mergeNonAdjacentRules: false,
          mergeSemantically: false,
          overrideProperties: false,
          removeEmpty: false,
          removeDuplicateRules: false,
          reduceNonAdjacentRules: false,
          removeDuplicateFontRules: false,
          removeDuplicateMediaBlocks: false,
          removeUnusedAtRules: false,
          restructureRules: false,
          urlQuotes: false
        }
      }
    }
  },
  rename: {
    min: {
      suffix: '.min'
    }
  },
  browsersync: {
    // Important! If src is wrong, styles will not inject to the browser
    src: [assetDir + 'css/**/*'],
    opts: {
      logLevel: 'debug',
      injectChanges: true,
      proxy: 'https://rollemaa.test',
      browser: 'Google Chrome',
      open: false,
      notify: true,
      // Generate with: mkdir -p /var/www/certs && cd /var/www/certs && mkcert localhost 192.168.x.xxx ::1
      // https: {
      //   key: "/var/www/certs/localhost-key.pem",
      //   cert: "/var/www/certs/localhost.pem",
      // }
    },
  },
  styles: {
    src: assetDir + 'scss/*.scss',
    development: assetDir + 'css/dev/',
    production: assetDir + 'css/prod/',
    watch: {
      development: assetDir + 'scss/**/*.scss',
      production: assetDir + 'css/dev/*.css',
    },
    stylelint: {
      src: assetDir + 'scss/**/*.scss',
      opts: {
        fix: false,
        reporters: [{
          formatter: 'string',
          console: true,
          failAfterError: false,
          debug: false
        }]
      },
    },
    opts: {
      development: {
        verbose: true,
        bundleExec: false,
        outputStyle: 'expanded',
        debugInfo: true,
        errLogToConsole: true,
        includePaths: [assetDir + 'node_modules/'],
        quietDeps: true,
      },
      production: {
        verbose: false,
        bundleExec: false,
        outputStyle: 'compressed',
        debugInfo: false,
        errLogToConsole: false,
        includePaths: [assetDir + 'node_modules/'],
        quietDeps: true,
      }
    }
  }
};
