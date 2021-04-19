'use strict';

var gulp = require('gulp'),
    rename = require('gulp-rename'),
    notify = require('gulp-notify'),
    autoprefixer = require('gulp-autoprefixer'),
    sass = require('gulp-sass'),
    plumber = require('gulp-plumber'),
    livereload = require('gulp-livereload');

var scss_settings = {
    outputStyle: 'expanded',
    linefeed: 'crlf',
    indentType: 'tab',
    indentWidth: 1
};

// css
gulp.task('css', function () {
    console.log('--css');
    return gulp
            .src("./assets/sass/**/*.scss")
            .pipe(
                    plumber({
                        errorHandler: function (error) {
                            console.log('=================ERROR=================');
                            console.log(error.message);
                            this.emit('end');
                        }
                    })
                    )
            .pipe(sass(scss_settings))
            .pipe(autoprefixer({
                browsers: ['last 10 versions'],
                cascade: false
            }))
            .pipe(rename('style.css'))
            .pipe(gulp.dest('./'))
            .pipe(notify('Compile style.css Done!'));
});

function css() {
    console.log('---watch')

    return gulp
            .src("./assets/sass/style.scss")
            .pipe(
                    plumber({
                        errorHandler: function (error) {
                            console.log('=================ERROR=================');
                            console.log(error.message);
                            this.emit('end');
                        }
                    })
                    )
            .pipe(sass(scss_settings))
            .pipe(autoprefixer({
                browsers: ['last 10 versions'],
                cascade: false
            }))
            .pipe(rename('style.css'))
            .pipe(gulp.dest('./'))
            .pipe(notify('Compile style.css Done!'))
            .pipe(livereload());
    
}

function watchFiles() {
    console.log('---watch')
    gulp.watch("./assets/sass/**/*", css);
}

// default
const watch = gulp.parallel(watchFiles);


gulp.task('default', watch);
