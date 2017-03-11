var fs = require('fs'),
    gulp = require("gulp"),
    sass = require("gulp-sass"),
    composer = require('gulp-composer'),
    sourcemaps = require('gulp-sourcemaps');


//************ CSS ************//

gulp.task('compile-css:frontend:dev', function () {
    gulp.src('./web/static/scss/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(function (file) {
            return file.base.replace('/scss', '/css');
        }))
});

gulp.task('compile-css:frontend', function () {
    gulp.src('./web/static/scss/**/*.scss')
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(gulp.dest(function (file) {
            return file.base.replace('/scss', '/css');
        }))
});

//************ COMPOSER ************//

gulp.task("composer", function () {
    composer('install --no-dev', {async: false, "working-dir": "./"});
});

gulp.task('watch', function () {
    gulp.watch('web/static/scss/**/*.scss', ['compile-css:frontend:dev']);
});
