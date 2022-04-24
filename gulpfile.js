const gulp = require("gulp");
const babel = require('gulp-babel');
var sass = require('gulp-sass')(require('sass'));
const merge = require('merge-stream');
const concat = require('gulp-concat');
const rename = require("gulp-rename");
const uglify = require('gulp-uglify');
const cleanCSS = require('gulp-clean-css');
const webp = require('gulp-webp');
const del = require('del');
const rev = require('gulp-rev');
const extend = require('gulp-extend');

var configuration = {
    paths: {
        src: {
            img: './build/img/**/*.+(png|jpg|gif|svg|webp)',
            scss: './build/scss/**/*.scss',
            js: "./build/js/**/*.js"
        },
        dist: {
            img: './src/img',
            scss: './src/css',
            base: './src/js',
            js: './src/js'
        }
    },

    /* JS base de todo el proyecto */
    files_to_concatenate: [


    ]

}

function scripts() {
    return gulp
        .src(configuration.paths.src.js)
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest(configuration.paths.dist.js))
}



function productionStyles() {
    return gulp
        .src(configuration.paths.src.scss)
        .pipe(sass({
            outputStyle: "compressed"
        }).on('error', sass.logError))
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest(configuration.paths.dist.scss))
}
/**
 * function styles() {
    return gulp
        .src(configuration.paths.src.scss)
        .pipe(sass().on('error', sass.logError))
        .pipe(rename({ suffix: '.min' }))
        .pipe(rev())
        .pipe(gulp.dest(configuration.paths.dist.scss))
        .pipe(rev.manifest('tmp/rev-manifest-style.json', {
            merge: true, base: 'assets'
        }))
        .pipe(gulp.dest(configuration.paths.dist.scss))
}**/
function styles() {
    return gulp
        .src(configuration.paths.src.scss)
        .pipe(sass().on('error', sass.logError))
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest(configuration.paths.dist.scss))
}
/**function productionScripts() {
    return gulp
        .src(configuration.paths.src.js)
        .pipe(
            babel({
                presets: [['@babel/preset-env', {modules: false}]],
            })
        )
        .pipe(uglify())
        .pipe(rename({ suffix: '.min' }))
        .pipe(rev())
        .pipe(gulp.dest(configuration.paths.dist.js))
        .pipe(rev.manifest('tmp/rev-manifest-prod-script.json', {
            merge: true, base: 'assets'
        }))
        .pipe(gulp.dest(configuration.paths.dist.js))
}**/
function productionScripts() {
    return gulp
        .src(configuration.paths.src.js)
        .pipe(uglify())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest(configuration.paths.dist.js))
}

function imageNormal() {
    return gulp
        .src(configuration.paths.src.img)
        .pipe(gulp.dest(configuration.paths.dist.img))
}

function imageWebp() {
    return gulp
        .src(configuration.paths.src.img)
        .pipe(webp())
        .pipe(gulp.dest(configuration.paths.dist.img))
}

async function images() {
    imageNormal();
    imageWebp();
}

function css() {
    return gulp
        .src("./build/css/**/*.css")
        .pipe(cleanCSS({ compatibility: 'ie8' }))
        .pipe(rename({ suffix: '.min' }))
        /**.pipe(rev())
        .pipe(gulp.dest("./src/css"))
        .pipe(rev.manifest('tmp/rev-manifest-css.json', {
            merge: true, base: 'assets'
        }))**/
        .pipe(gulp.dest("./src/css"))
}

function watch() {
    gulp.watch(configuration.paths.src.img, images);

    gulp.watch(configuration.paths.src.js, gulp.series(scripts, manifest));
    gulp.watch(configuration.paths.src.scss, gulp.series(styles, manifest));
    gulp.watch("./build/css/**/*.css", gulp.series(css, manifest));
}

async function manifest() {
    gulp.src(['./srcs/tmp/*.json'])
        .pipe(extend('manifest.json')) // gulp-extend
        .pipe(gulp.dest('./build/src'));
}

async function cleanJsCSS() {
    del.sync('./src/css/**');
    del.sync('./src/js/**');
    del.sync('./src/tmp/**');
    del.sync('./src/rev-manifest.json');
}

exports.live = gulp.series(cleanJsCSS, images, productionStyles, productionScripts, css, manifest);
exports.default = gulp.series(cleanJsCSS, images, styles, scripts,  css, manifest, watch);
