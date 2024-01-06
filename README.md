# Random Stuff

### To run on local environment
Run: `docker compose up -d`

On host, follow next instructions:

run: `yarn install`
run: `yarn dev`

*Trobbleshoting:*

If you experience erro at main app container start:

Ex: "permission denied”, in short, the permission denied error. 

Run: `sudo chmod +x docker-compose/run.sh` on host.

[Finally, open localhost on port 8004](http://127.0.0.1:8004)

Instructions for beginners:
Laravel works with MVC architecture.

See routes in *routes/web.php*
The route is the entry point for requests.

Route forward requests to controllers, you can find in *app/Http/Controllers* directory.
Also, controlle
rs returns the final response for the browser.