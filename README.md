# Hobbies-API-PHP

This is my first API with PHP !

## Technologies & tools

![PHP](https://img.shields.io/badge/php-777BB4?style=for-the-badge&logo=php&logoColor=ffffff)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=ffffff)
![WAMP](https://img.shields.io/badge/wamp-4B4B4B?style=for-the-badge&logo=data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAyMS4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8c3R5bGUgdHlwZT0idGV4dC9jc3MiPg0KCS5zdDB7ZmlsbDojRkYwMDk5O30NCjwvc3R5bGU+DQo8Zz4NCgk8cGF0aCBjbGFzcz0ic3QwIiBkPSJNNDI1LjYsMzEzLjVjMCw2MS42LTQ5LjksMTExLjUtMTExLjUsMTExLjVIMTk3LjljLTYxLjYsMC0xMTEuNS00OS45LTExMS41LTExMS41di0zOS44SDE5djQ1LjcNCgkJQzE5LDQxNC43LDk2LjMsNDkyLDE5MS42LDQ5MmgxMjguOGM5NS4zLDAsMTcyLjYtNzcuMywxNzIuNi0xNzIuNnYtNDUuN2gtNjcuNFYzMTMuNXoiLz4NCgk8cGF0aCBjbGFzcz0ic3QwIiBkPSJNODYuNCwxOTkuNUM4Ni40LDEzNy45LDEzNi4zLDg4LDE5Ny45LDg4aDExNi4yYzYxLjYsMCwxMTEuNSw0OS45LDExMS41LDExMS41djQxSDQ5M3YtNDYuOQ0KCQlDNDkzLDk4LjMsNDE1LjcsMjEsMzIwLjQsMjFIMTkxLjZDOTYuMywyMSwxOSw5OC4zLDE5LDE5My42djQ2LjloNjcuNFYxOTkuNXoiLz4NCgk8cGF0aCBjbGFzcz0ic3QwIiBkPSJNMzIzLDEyMi42djE4Ni42YzAsOC45LTcuMiwxNi4xLTE2LjEsMTYuMWMtOC45LDAtMTYuMS03LjItMTYuMS0xNi4xdi02OC43aC02OS42djY4LjcNCgkJYzAsOC45LTcuMiwxNi4xLTE2LjEsMTYuMWgwYy04LjksMC0xNi4xLTcuMi0xNi4xLTE2LjFWMTIyLjZjLTM5LjEsNi41LTY4LjksNDAuNC02OC45LDgxLjN2MTA1LjJjMCw0NS41LDM2LjksODIuNCw4Mi40LDgyLjRoNS44DQoJCWMxMS4yLDAsMjEuOC0yLjIsMzEuNS02LjNjNS43LTIuNCwxMS4xLTUuNCwxNi4xLTguOWM1LDMuNSwxMC40LDYuNSwxNi4xLDguOWM5LjcsNCwyMC40LDYuMywzMS41LDYuM2g1LjgNCgkJYzQ1LjUsMCw4Mi40LTM2LjksODIuNC04Mi40VjIwMy45QzM5MS45LDE2MywzNjIuMSwxMjkuMSwzMjMsMTIyLjZ6Ii8+DQo8L2c+DQo8L3N2Zz4NCg==)
![Insomnia](https://img.shields.io/badge/insomnia-%234000BF.svg?style=for-the-badge&logo=insomnia&logoColor=white)
![VSCode](https://img.shields.io/badge/visual_studio_code-%23007ACC.svg?style=for-the-badge&logo=visual-studio-code&logoColor=white)
![Git](https://img.shields.io/badge/git-%23F05032.svg?style=for-the-badge&logo=git&logoColor=white)

## About it

With this API you will have access to a list of some of __my hobbies__ (_Lucky you !_).  

- I have assessed my own __level__ of "mastering" each hobby (_Shocking news ! so...I'm not excellent at everything I do and like ?! No._)
- each hobby belongs to one ore more __categories__

Database structure and seeding file are available in "data".

## Routes  

Here are the routes I will progressively add :

|ROUTE|METHOD|DESCRIPTION|achieved ?|
|---|---|---|:---:|
|/hobbies|GET|get the list of my hobbies| YES |
|/hobbies|POST|add a hobby| YES |
|/hobbies/:id|GET|get one of my hobbies with its id| YES |
|/hobbies/:id|PATCH|update a hobby| |
|/hobbies/:id|DELETE|delete a hobby| |
|/categories|GET|get the list of my hobby categories| YES |
|/categories|POST|add a category| |
|/categories/:id|GET|get one category with its id| YES |
|/categories/:id|PATCH|update a category| |
|/categories/:id|DELETE|delete a category| |
|/categories/:id/hobbies|GET|get the list of all the hobbies from one category| |
|/levels|GET|get the list of the levels of mastering of my hobbies| YES |
|/levels|POST|add a level| |
|/levels/:id|GET|get one level with its id| YES |
|/levels/:id|PATCH|update a level| |
|/levels/:id|DELETE|delete a level| |
|/levels/:id/hobbies|GET|get the list of all the hobbies from one level of mastering| |

## What Next ?

- Organize in MVC Architecture
- Documentation of the API
- Develop basic front application to use the API 
