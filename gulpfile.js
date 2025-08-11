import * as sassCompiler from 'sass';
import gulpSass from 'gulp-sass';
import { src, dest, watch, series } from 'gulp';
import terser from 'gulp-terser';
import sharp from 'sharp';
import fs from 'fs';
import path from 'path';
import concat from 'gulp-concat';

const sass = gulpSass(sassCompiler);

// Tarea CSS
export function css() {
    return src('src/sass/app.scss', { sourcemaps: true })
        .pipe(sass({
            outputStyle: 'compressed'
        }).on('error', sass.logError))
        .pipe(dest('build/css', { sourcemaps: '.' }))
}

// Tarea JS
export function js(done) {
    src('src/js/**/*.js')
        .pipe(concat('app.js')) // Combina todos en uno solo
        .pipe(terser())
        .pipe(dest('build/js'))
        .on('end', done);
}
export function copyJpg() {
    return src('src/img/**/*.jpg')
        .pipe(dest('build/img'));
}

export function copySvg() {
    return src('src/img/**/*.svg')
        .pipe(dest('build/img'));
}

// Tarea de imágenes (ejemplo)
export async function crop(done) {
    const inputFolder = 'src/img'
    const outputFolder = 'build/img';
    if (!fs.existsSync(outputFolder)) {
        fs.mkdirSync(outputFolder, { recursive: true })
    }
    const images = fs.readdirSync(inputFolder).filter(file => {
        return /\.(jpg)$/i.test(path.extname(file));
    });
    try {
        images.forEach(file => {
            const inputFile = path.join(inputFolder, file)
            const outputFileWebp = path.join(outputFolder, file.replace(/\.jpg$/i, '.webp'))

            // Guardar versión WebP redimensionada
            sharp(inputFile)
                .toFormat('webp')
                .toFile(outputFileWebp)
        });

        done()
    } catch (error) {
        console.log(error)
    }
}

export function dev(done) {
    watch('src/sass/**/*.scss', css);
    watch('src/js/**/*.js', js);
    watch('src/img/**/*.jpg', series(copyJpg, crop, copySvg)); // Copia y luego convierte
    done(); 
}

export default series(css, js, copyJpg, crop, copySvg, dev); // Ejecuta todo en orden