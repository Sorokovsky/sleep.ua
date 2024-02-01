import dartSass from 'sass';
import gulpSass from 'gulp-sass';
import rename from 'gulp-rename';
import cleanCss from 'gulp-clean-css';
import webpcss from 'gulp-webpcss';
import autoprefixer from 'gulp-autoprefixer';
import groupCssMediaQueries from 'gulp-group-css-media-queries';
const sasss = gulpSass(dartSass);
export const sass = () => {
    return app.gulp.src(app.path.src.sass, {sourcemaps: true})
        .pipe(app.plugins.replace(/@img\//g, '../img/'))
        .pipe(sasss({
            outputStyle: 'expanded'
        }))
        .pipe(app.plugins.ifPlugin(app.isBuild, groupCssMediaQueries()))
        .pipe(app.plugins.ifPlugin(app.isBuild, webpcss({
            webpClass: '.webp',
            nowebpClass: '.no-webp'
        })))
        .pipe(autoprefixer({
            grid: true,
            overrideBrowserslist: ['last 3 versions'],
            cascade: true
        }))
        .pipe(app.plugins.ifPlugin(app.isBuild, cleanCss()))
        .pipe(rename({
            extname: '.min.css'
        }))
        .pipe(app.gulp.dest(app.path.build.css))
        .pipe(app.plugins.ifPlugin(app.isDev, app.plugins.browsersync.stream()));
}