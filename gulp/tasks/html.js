import webpHtmlNosvg from "gulp-webp-html-nosvg"
import versionNumber from "gulp-version-number"
export const html = () => {
    return app.gulp.src(app.path.src.html)
    .pipe(app.plugins.replace(/@img\//g, 'img/'))
    .pipe(app.plugins.replace(/@js\//g, 'js/'))
    .pipe(app.plugins.ifPlugin(app.isBuild, webpHtmlNosvg()))
    .pipe(app.plugins.ifPlugin(app.isBuild, versionNumber({
        'value': '%DT%',
        'append': {
            'key': '_v',
            'cover': 0,
            'to':['css', 'js']
        },
        'output': {
            'file': 'gulp/version.json'
        }
    })))
    .pipe(app.gulp.dest(app.path.build.html))
    .pipe(app.plugins.ifPlugin(app.isDev, app.plugins.browsersync.stream()));
}