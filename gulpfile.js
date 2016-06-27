var gulp       = require('gulp');
var watch      = require('gulp-watch');
var concat     = require('gulp-concat');
var uglify     = require('gulp-uglify');
var sass       = require('gulp-sass');
var prefix     = require('gulp-autoprefixer');
var plumber    = require('gulp-plumber');
// var sourcemaps = require('gulp-sourcemaps');
// var livereload = require('gulp-livereload');
// var local      = false;

/**
 * Generates CSS from SASS
 * @return {[type]} [description]
 */
gulp.task('sass', function () {
    theTask = gulp.src('./src/scss/base.scss')
        //.pipe(sourcemaps.init())
        .pipe(plumber())
        .pipe(sass({
            outputStyle: 'compressed'
        }))
        .pipe(prefix('last 2 version'))
        .pipe(gulp.dest('./assets/css'));
});

/**
 * Copy images
 * @return {[type]} [description]
 */
gulp.task('img', function () {
    theTask = gulp.src('./src/img/**/*')
        .pipe(gulp.dest('./assets/img'));

    // if (local)
    //     theTask.pipe(livereload());
});

/**
 * Copy CSS
 * @return {[type]} [description]
 */
gulp.task('css', function () {
    theTask = gulp.src('./src/css/**/*')
        .pipe(gulp.dest('./assets/css'));
});

/**
 * Copy JS
 * @return {[type]} [description]
 */
gulp.task('js', function () {
    theTask = gulp.src('./src/js/**/*.js')
        .pipe(uglify())
        .pipe(concat('app.js'))
        .pipe(gulp.dest('./assets/js'));
});

/**
 * Copy fonts
 * @return {[type]} [description]
 */
gulp.task('font', function () {
    theTask = gulp.src('./src/fonts/**/*')
        .pipe(gulp.dest('./assets/fonts'));
});

/**
 * Watch files and run tasks if they change
 * @return {[type]} [description]
 */
gulp.task('watch', function () {


    watch('./src/scss/**/*.{css,scss}', function (files, cb) {
        gulp.start('sass', cb);
    });

    watch('./src/img/**/*', ['img']);

    watch('./src/js/**/*', function (files, cb) {
        gulp.start('js', cb);
    });

    watch('./src/css/**/*', function (files, cb) {
        gulp.start('css', cb);
    });

    watch('./src/font/**/*', function (files, cb) {
        gulp.start('font', cb);
    });

    gulp.start('default');
});


/**
 * The default task (called when you run `gulp`)
 */
gulp.task('default', [ 'js', 'sass', 'css', 'font', 'img' ]);
