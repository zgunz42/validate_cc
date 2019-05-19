const mix = require('laravel-mix');
const path = require('path');
const glob = require('glob-all');
const PurgecssPlugin = require('purgecss-webpack-plugin');
const merge = require('lodash/merge');
const tailwindcss = require('tailwindcss');

const config = {
  resolve: {
    alias: {
      '@': path.resolve('resources/js')
    }
  }
};

// Custom PurgeCSS extractor for Tailwind that allows special characters in
// class names.
//
// https://github.com/FullHuman/purgecss#extractor
class TailwindExtractor {
  static extract(content) {
    return content.match(/[A-Za-z0-9-_:\/]+/g) || [];
  }
}

mix.js('resources/js/app.js', 'public/js');

mix.postCss('resources/css/main.css', 'public/css', [tailwindcss('tailwind.config.js')]);

if (!mix.inProduction()) {
  mix.webpackConfig(config);
} else {
  mix.version();
  mix.webpackConfig(merge(config, {
    plugins: [
      new PurgecssPlugin({

        // Specify the locations of any files you want to scan for class names.
        paths: glob.sync([
          path.join(__dirname, "resources/views/**/*.blade.php"),
          path.join(__dirname, "resources/js/**/*.vue")
        ]),
        extractors: [
          {
            extractor: TailwindExtractor,

            // Specify the file extensions to include when scanning for
            // class names.
            extensions: ["html", "js", "php", "vue"]
          }
        ]
      })
    ]
  }));
}
