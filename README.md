# 3DHangman

Live demo (<b>available soon</b>):
<a href = 'http://3dhangman.virtualcollaboration.co.uk'>Click here</a> <br />

### Docker
clone the repo and then from the root folder (3dhangman) run:<br />
<code>docker build -t 3dhangman_docker .</code> </br>
If successful, you can run it: <br />
<code>docker run -p 1908:80  3dhangman_docker</code><br />
<b> Please make sure you run it on port 1908, otherwise you will have to specify your port on line 17 in the Dockerfile.</b><br />
Use your browser in order to view the game: http://127.0.0.1:1908/3dhangman

### Additional Information:
You need to set the right <b>base_url</b> in Codeigniter: <br />
<code>vim application/config/config.php</code> <br />
and change the <code>$config['base_url']</code> variable to: <br />
<code>$config['base_url'] = 'http://your_url/3dhangman'</code>
<br />
I removed <code>index.php</code> from the URL, for further information please have a look in <code>.htaccess</code> which is in the root folder.
