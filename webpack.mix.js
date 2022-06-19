const mix = require('laravel-mix');

mix
    //js & css for frontend
    // .js('resources/be/js/app.js', 'public/dist/be/js')
    .sass('resources/fe/sass/main.scss', 'public/dist/fe/css')
    .sass('resources/fe/sass/pages/home.scss', 'public/dist/fe/css')

    .setResourceRoot('../public/dist/')
    .options({
        processCssUrls: false
    })
    .webpackConfig({
        module: {
            rules: [
                {
                    test: /\.(ttf|eot|woff|woff2)$/,
                    use : {
                        loader : "file-loader",
                        options: {
                            name: "../fonts/.[ext]",
                        },
                    }
                }
            ]
        }
    });
