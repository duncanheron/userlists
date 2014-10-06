var gulp = require('gulp');
var phpunit = require('gulp-phpunit');
var notify = require('gulp-notify');

/*gulp.task('tests', function(){
	var options = {debug: false, notify: true};

	return gulp.src('app/tests/*.php')
		.pipe(phpunit('', options))
		.on("error", notify.onError({
        	message: "Error: tests failed",
        	title: "Error running test"
      	}));
})*/

gulp.task('tests', function() {
    var options = {debug: false, notify: true};
    gulp.src('app/tests/*.php')
        .pipe(phpunit('', options))
        .on('error', notify.onError({
            title: "Failed Tests!",
            message: "Error(s) occurred during testing..."
        }));
});

gulp.task('default', function(){
	gulp.run('tests');
	gulp.watch('app/controllers/*.php', function(){
		gulp.run('tests');
	});
})