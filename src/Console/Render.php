php artisan markdox:render

// goes throw all the crawlable files
// saves their html in /public/{path}

// maybe github app registers a listener for app/docs repo

publish to master on app/docs
app/site repo gets an action triggered
action calls php artisan markdox:render
commits & publishes a PR to app/site
which triggers deployment