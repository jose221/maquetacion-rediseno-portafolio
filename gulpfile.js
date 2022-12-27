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
const htmlmin = require('gulp-htmlmin');
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
        {
            bundle_name: '/index.js',
            bundle_path: './src/js',
            src: [
                './build/js/libs/alpine-intersect.js',
                './build/js/libs/alpinejs.js',
                './build/js/libs/HttpClient.js',
                './build/js/libs/validation.js',
                './build/js/app.js',
            ]
        }

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
    //gulp.watch(configuration.paths.src,htmlMinify);

    gulp.watch(configuration.paths.src.js, gulp.series(scripts,bundles, manifest));
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
function bundles() {
    return merge(
        configuration.files_to_concatenate.map(function (currentValue, index) {
            del.sync(currentValue.bundle_path+currentValue.bundle_name);
            return gulp.src(currentValue.src)
                .pipe(uglify())
                .pipe(concat(currentValue.bundle_name))
                .pipe(rename({ suffix: '.min' }))
                //.pipe(
                //  babel({
                //     presets: [['@babel/preset-env', {modules: false}]],
                //})
                //)
                //.pipe(rev())
                .pipe(gulp.dest(currentValue.bundle_path))

                ;
        })
    );
}
function htmlMinify(){
    return gulp.src(['./build/*.html','./build/*.php'])
        .pipe(htmlmin({
            collapseWhitespace: true,
            ignoreCustomFragments: [ /<%[\s\S]*?%>/, /<\?[=|php]?[\s\S]*?\?>/ ]
        }))
        .pipe(gulp.dest('./src'));
}
function moveFiles(){
    return gulp.src(['./build/lang/*.php'])
        .pipe(gulp.dest('./src/lang'));
}

exports.live = gulp.series(cleanJsCSS,htmlMinify,moveFiles, images, productionStyles, productionScripts,bundles, css, manifest);
exports.default = gulp.series(cleanJsCSS,htmlMinify, moveFiles, images, styles, scripts,bundles,  css, manifest, watch);
