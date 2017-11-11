var gulp           = require('gulp'),
    gutil          = require('gulp-util' ),
    sass           = require('gulp-sass'),
    browserSync    = require('browser-sync'),
    concat         = require('gulp-concat'),
    uglify         = require('gulp-uglify'),
    cleanCSS       = require('gulp-clean-css'),
    rename         = require('gulp-rename'),
    del            = require('del'),
    imagemin       = require('gulp-imagemin'),
    cache          = require('gulp-cache'),
    autoprefixer   = require('gulp-autoprefixer'),
    ftp            = require('vinyl-ftp'),
    notify         = require("gulp-notify"),
    rigger         = require('gulp-rigger'),
    rsync          = require('gulp-rsync'),
    runSequence    = require('run-sequence');

gulp.task('js', function() {
    return gulp.src([
        'resources/js/*.js'
    ])
    .pipe(concat('scripts.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('tmp/js'))
    .pipe(browserSync.reload({stream: true}));
});

gulp.task('browser-sync', function() {
    browserSync({
        server: {
            baseDir: 'tmp'
        },
        notify: true
    });
});

gulp.task('sass', function() {
    return gulp.src('resources/sass/*.scss')
        .pipe(sass({outputStyle: 'expand'}).on("error", notify.onError()))
        .pipe(rename({suffix: '.min', prefix : ''}))
        .pipe(autoprefixer(['last 15 versions']))
        .pipe(cleanCSS())
        .pipe(gulp.dest('tmp/css'))
        .pipe(browserSync.reload({stream: true}));
});

gulp.task('imagemin', function() {
    return gulp.src('resources/img/**/*.*')
        .pipe(imagemin())
        .pipe(gulp.dest('tmp/img'));
});

gulp.task('fonts', function() {
    return gulp.src('resources/fonts/*.*')
        .pipe(gulp.dest('tmp/fonts'));
});

gulp.task('watch', function() {
    runSequence(
        ['html', 'sass', 'js', 'imagemin', 'fonts'],
        'browser-sync'
    );
    gulp.watch('resources/sass/*.*', ['sass']);
    gulp.watch(['resources/js/*.js'], ['js']);
    gulp.watch(['resources/templates/**/*.html'], ['html']);
    gulp.watch('tmp/*.html', browserSync.reload);
});

gulp.task('html', function() {
    var buildFiles = gulp.src([
        'resources/templates/*.html'
    ])
    .pipe(rigger())
    .pipe(gulp.dest('tmp'))
    .pipe(browserSync.reload({stream: true}));
});

gulp.task('build', ['html', 'sass', 'js', 'imagemin', 'fonts'], function() {

    var buildFiles = gulp.src([
        'tmp/*.html',
    ])
        .pipe(rigger())
        .pipe(gulp.dest('public'));

    var buildPublic = gulp.src([
        'tmp/**/**/*',
    ]).pipe(gulp.dest('public'));


});

gulp.task('clear', function () { return cache.clearAll(); });

gulp.task('default', ['watch']);
