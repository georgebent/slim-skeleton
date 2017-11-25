var gulp           = require('gulp'),
    sass           = require('gulp-sass'),
    browserSync    = require('browser-sync'),
    concat         = require('gulp-concat'),
    uglify         = require('gulp-uglify'),
    cleanCSS       = require('gulp-clean-css'),
    rename         = require('gulp-rename'),
    imagemin       = require('gulp-imagemin'),
    cache          = require('gulp-cache'),
    autoprefixer   = require('gulp-autoprefixer'),
    notify         = require("gulp-notify"),
    rigger         = require('gulp-rigger'),
    runSequence    = require('run-sequence');

gulp.task('html', function() {
    var buildFiles = gulp.src([
        'resources/templates/*.html'
    ])
    .pipe(rigger())
    .pipe(gulp.dest('public'));
});

gulp.task('js', function() {
    return gulp.src([
        'resources/js/*.js'
    ])
    .pipe(concat('scripts.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('public/js'));
});

gulp.task('sass', function() {
    return gulp.src('resources/sass/*.scss')
        .pipe(sass({outputStyle: 'expand'}).on("error", notify.onError()))
        .pipe(rename({suffix: '.min', prefix : ''}))
        .pipe(autoprefixer(['last 15 versions']))
        .pipe(cleanCSS())
        .pipe(gulp.dest('public/css'));
    });

gulp.task('imagemin', function() {
    return gulp.src('resources/img/**/*.*')
        .pipe(imagemin())
        .pipe(gulp.dest('public/img'));
});

gulp.task('fonts', function() {
    return gulp.src('resources/fonts/*.*')
        .pipe(gulp.dest('public/fonts'));
});

gulp.task('browser-sync', function() {
    browserSync.init({
        proxy: "http://localhost:3003/",
        notify: true
    });
});

gulp.task('watch', function() {
    runSequence(
        ['html', 'sass', 'js', 'imagemin', 'fonts']
    );
    gulp.watch('resources/sass/*.*', ['sass']);
    gulp.watch(['resources/js/*.js'], ['js']);
    gulp.watch(['resources/templates/**/*.html'], ['html']);
});

gulp.task('build', ['html', 'sass', 'js', 'imagemin', 'fonts']);

gulp.task('clear', function () { return cache.clearAll(); });

gulp.task('default', ['watch']);
