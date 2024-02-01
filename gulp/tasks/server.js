export const server = (done) => {
    app.plugins.browsersync.init({
        proxy: "sleep.ua"
    });
}