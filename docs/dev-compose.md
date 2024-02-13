Developing with Platy+ 2
================================

This walkthrough assumes you're not developing with VSCode.  
If you do, see the guide on [developing with devcontainers](./dev-vscode.md).

1 - Run the application
--------------------------------
```shell
$ docker compose up && docker compose logs -f
```

2 - Access systems
--------------------------------

| name | exposed port(s) | access |
|---|---|---|
| front end | [3000](http://localhost:3000/) | `docker exec -it platyplus2-front-server-1 sh` |
| back end | [8080](http://localhost:8080/) | `docker exec -it platyplus2-web-server-1 sh` |
| database | 33006 | `docker exec -it platyplus2-mysql-server-1 mysql -u root --password=secret` |

3 - Writing code
--------------------------------

The folders `./nextjs`, `./src`, and `./nginx.conf` are mounted in the `docker compose` containers.  
Any development you do should be immediately reflected in the running application.

Take care that these containers are running as root, you might run into file permission problems
on your development machine. Fix these with `sudo chown $(whoami) <file_or_dir>`.
Perform `npm install` commands only inside these containers, or any modules with native compilation can be trouble.