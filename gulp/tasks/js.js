import webpack from 'webpack-stream';
export const js = () => {
    return app.gulp.src(app.path.src.js, {sourcemaps: true})
        .pipe(app.plugins.ifPlugin(app.isBuild, webpack({
            mode:  'production',
            output: {
                filename: 'script.min.js'
            }
        })))
        .pipe(app.plugins.ifPlugin(app.isBuild, app.gulp.dest(app.path.build.js)))
        .pipe(app.plugins.ifPlugin(app.isDev, app.gulp.src(app.path.src.js, {sourcemaps: true}))
        .pipe(app.plugins.ifPlugin(app.isDev, webpack({
            mode: 'development',
            output: {
                filename: 'script.min.js'
            }
        })))
        .pipe(app.plugins.ifPlugin(app.isDev, app.gulp.dest(app.path.build.js)))
        .pipe(app.plugins.ifPlugin(app.isDev, app.plugins.browsersync.stream())));
}