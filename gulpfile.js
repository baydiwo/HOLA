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

gulp.task('sass', function() {
    return gulp.src([
        'src/scss/style.scss'
    ])
    .pipe(plumber())
    .pipe(prefix({
        browsers: ['last 2 versions'],
        cascade: true
    }))
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(gulp.dest('assets/css'));
});

gulp.task('js_copy', function() {
    return gulp.src('src/js/vendor/*.js')
        .pipe(gulp.dest('assets/js/vendor'))
});

gulp.task('font', function() {
    return gulp.src('src/fonts/**/*')
        .pipe(gulp.dest('assets/fonts'))
});

gulp.task('js', ['js_copy'], function() {
    return gulp.src([
        'src/js/app.js'
    ])
    .pipe(plumber())
    .pipe(concat('app.js'))
    //.pipe(uglify())
    .pipe(gulp.dest('assets/js/'))
});

gulp.task('css', function () {
    return gulp.src('./src/css/**/*')
        .pipe(gulp.dest('assets/css'));
});

gulp.task('default', ['sass', 'js','css' , 'font']);

gulp.task('watch', function() {
    gulp.watch('src/scss/*.scss', ['sass']);
    gulp.watch('src/js/**/*.js', ['js']);
    gulp.watch('src/css/**/*', ['css']);
});
