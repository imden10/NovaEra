const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));

function compileSass() {
    return gulp.src('./wp-content/themes/cat/scss/style.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./wp-content/themes/cat/style'));
}

function watchSass() {
    gulp.watch('./wp-content/themes/cat/scss/**/*.scss', compileSass);
}

function build() {
    return compileSass();
}

exports.default = gulp.series(compileSass, watchSass);
exports.build = build;
