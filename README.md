# 3DHangman

Live demo:
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
<br />
Always make sure that apache can use <code>.htaccess:</code><br />
```
Directory /var/www/>
        Options Indexes FollowSymLinks
        AllowOverride all
        Require all granted
</Directory>
```

### Testing branch (Won't work as a submodule)
A new testing branch has been created in order to test some of the functions. <br />
Currently it is not merged with the master one so you have to checkout it.<br />
ci-phpunit-test is a submodule that is used in order to facilitate the test. <br />
Instructions after you have cloned the application: <br />
```
git checkout testing
git submodule init
git submodule update
cd application/ci-phpunit-test/application
mv tests ../../
cd ../../
rm -rf application/ci-phpunit-test
```
So, we only need the <code>tests</code> folder from that project and needs to be palced in our <code>application</code> folder.
