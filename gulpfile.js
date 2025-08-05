import * as sassCompiler from 'sass';
import gulpSass from 'gulp-sass';
import { src, dest, watch, series } from 'gulp';
import terser from 'gulp-terser';
import sharp from 'sharp';
import fs from 'fs';
import path from 'path';

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
    src('src/js/app.js')
        .pipe(terser())
        .pipe(dest('build/js'))
        .on('end', done);
}

// Tarea de imágenes (ejemplo)
export async function crop(done) {
    const inputFolder = 'src/img'
    const outputFolder = 'src/img/thumb';
    const width = 250;
    const height = 180;
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
                .resize(width, height, {
                    position: 'centre'
                })
                .toFormat('webp')
                .toFile(outputFileWebp)
        });

        done()
    } catch (error) {
        console.log(error)
    }
}

// Modo desarrollo
export function dev(done) {
    watch('src/sass/**/*.scss', css);
    watch('src/js/**/*.js', js);
    done(); // Importante para Gulp 4+
}

export default series(css, js, dev); // Orden de ejecución