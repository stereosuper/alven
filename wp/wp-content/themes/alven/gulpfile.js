var gulp            = require('gulp'),
    sass            = require('gulp-sass'),
    autoprefixer    = require('gulp-autoprefixer'),
    cssnano         = require('gulp-cssnano'),
    rename          = require('gulp-rename'),
    uglify          = require('gulp-uglify'),
    concat          = require('gulp-concat'),
    plumber         = require('gulp-plumber'),
    browserSync     = require('browser-sync').create();



gulp.task('styles', function() {

    // Sass watch, autoprefixr, minify and rename
    return gulp.src('scss/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer('last 2 version'))
        .pipe(rename({suffix: '.min'}))
        .pipe(cssnano())
        .pipe(gulp.dest('css'))

        // reload for styles
        .pipe(browserSync.stream());
});

// JS concat and minify
gulp.task('scripts', function() {
    gulp.src(['js/*.js'])
        .pipe(plumber())
        .pipe(concat('scripts.min.js'))
        /*
        .pipe(uglify())
        */
        .pipe(gulp.dest('minjs'))
        .pipe(browserSync.stream());
});

gulp.task('watch', function() {


    gulp.watch('scss/*.scss', ['styles']);

    gulp.watch('js/*.js', ['scripts']);

    // reload for php files
    gulp.watch(['**/*.php']).on('change', browserSync.reload);

});

gulp.task('browser-sync', function() {
    browserSync.init({
        proxy: "alven-site.dev"
    });
});

gulp.task('default', ['watch', 'styles', 'scripts', 'browser-sync'], function() {

});