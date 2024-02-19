Developing with Platy+ 2
================================

This walkthrough assumes you're developing with VSCode.  
If you want to use another editor, see the guide on [developing with docker compose](./dev-compose.md).

1 - Run the application
--------------------------------

In VSCode, press `F1` or click the `Remote Window` button in the bottom left.
Click `Dev Containers: Reopen in Container`.

You'll be asked which container you want to work in, pick your choice.

> [!TIP]
> You can open multiple VSCode windows that each connect to a different devcontainer simultaneously.
> e.g. You can develop on the front-end and back-end containers at the same time.

2 - Access systems
--------------------------------

| name | exposed port(s) |
|---|---|---|
| front end | [3000](http://localhost:3000/) |
| back end | [8080](http://localhost:8080/) |
| database | 33006 |

In the `database` devcontainer, run `mysql -u root --password=secret` for a SQL session.

3 - Stop developing
--------------------------------

In VSCode, close the remote connection, press `F1`, and select `Docker Containers: Compose Stop`